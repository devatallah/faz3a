<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ImageProduct;
use App\Models\Merchant;
use App\Models\Level;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Size;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index ()
    {
        $categories = Category::query()->where('status',1)->get();
        $merchants = Merchant::query()->where('status',1)->get();
        return view('merchant.products.index', compact('categories', 'sizes', 'merchants'));
    }

    public function create ()
    {
        $categories = Category::query()->with('sizes')->where('status',1)->get();
        $merchants = Merchant::query()->where('status',1)->get();
        return view('merchant.products.create', compact('categories', 'merchants'));
    }

    public function store (Request $request)
    {
        $rules = [
            'images' => 'required|array',
            'images.*' => 'required|image',
            'category_id' => 'required|numeric|exists:categories,id',
            'merchant_id' => 'required|numeric|exists:merchants,id',
            'size_ids' => 'required|array',
            'size_ids.*' => 'required|numeric|exists:sizes,id',
            'price' => 'required|numeric|min:1',
            'old_price' => 'nullable|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'is_available' => 'required|numeric|in:0,1',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ];
        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
            $rules['description_' . $key] = 'required|string|max:255';
        }
        $this->validate($request, $rules);
        $data = $request->only(['category_id', 'merchant_id', 'price', 'old_price', 'quantity', 'is_available']);
        $data['colors'] = json_encode($request->colors);
        $data['status'] = 0;
        foreach (locales() as $key => $language) {
            $data[$key] = ['name' => $request->get('name_' . $key),
                'description' => $request->get('description_' . $key)];
        }
        $product = Product::query()->create($data);
        $product->sizes()->toggle($request->size_ids);
        $images = [];
        foreach ($request->images as $image) {
            $image = $image->store('public');
            $images[] = ['product_id' => $product->id, 'image' => $image,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
        }
        ImageProduct::query()->insert($images);

        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_added'));
        return redirect('merchant/products');
    }

    public function edit ($id, Request $request)
    {
        $product = Product::query()->find($id);
        $sizes = Size::query()->where('status',1)->get();
        $categories = Category::query()->where('status',1)->get();
        $merchants = Merchant::query()->where('status',1)->get();
        return view('merchant.products.edit', compact('product','categories', 'sizes', 'merchants'));
    }

    public function update ($id, Request $request)
    {
        $product = Product::query()->find($id);
        $rules = [
            'images' => 'nullable|array',
            'images.*' => 'required|image',
            'category_id' => 'required|numeric|exists:categories,id',
            'merchant_id' => 'required|numeric|exists:merchants,id',
            'size_ids' => 'required|array',
            'size_ids.*' => 'required|numeric|exists:sizes,id',
            'price' => 'required|numeric|min:1',
            'old_price' => 'nullable|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'is_available' => 'required|numeric|in:0,1',
            'colors' => 'required|array',
            'colors.*' => 'required',
        ];

        foreach (locales() as $key => $language) {
            $rules['name_' . $key] = 'required|string|max:255';
            $rules['description_' . $key] = 'required|string|max:255';
        }
        $offer = Offer::query()->where('product_id', $id)
            ->where('start_date', '<=', Carbon::now()->format('Y-m-d'))
            ->where('end_date', '>=', Carbon::now()->format('Y-m-d'))->orderByDesc('id')->first();

        $this->validate($request, $rules);
        $data = $request->only(['category_id', 'merchant_id', 'old_price', 'quantity', 'is_available']);
        $data['price'] = @$offer->price ?? $request->old_price;
        $data['colors'] = json_encode($request->colors);
        $data['status'] = 0;
        foreach (locales() as $key => $language) {
            if ($request->get('name_' . $key)) {
                $data[$key]['name'] = $request->get('name_' . $key);
            }
            if ($request->get('description_' . $key)) {
                $data[$key]['description'] = $request->get('description_' . $key);
            }
        }
        $product->update($data);
        $product->sizes()->toggle($request->size_ids);

        if ($request->delete_ids){
            ImageProduct::query()->whereIn('id', $request->delete_ids)->where('product_id', $product->id)->delete();
        }
        if ($request->images) {
            $images = [];
            foreach ($request->images as $image) {
                $image = $image->store('public');
                $images[] = ['product_id' => $product->id, 'image' => $image,
                    'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
            }
            ImageProduct::query()->insert($images);
        }

        if ($request->ajax()) {
            return response()->json(['status' => true]);
        }
        Session::flash('success_message', __('common.item_edited'));
        return redirect()->back();
    }


    public function updateStatus (Request $request)
    {
        $rules = [
            'ids' => 'required',
            'status' => 'required|in:0,1,2',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['status' => false]);
        }
        try {
            Product::query()->whereIn('id', explode(',', $request->ids))
                ->update(['status' => $request->status]);
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function destroy ($id)
    {
        try {
            Product::query()->whereIn('id', explode(',', $id))->delete();
        } catch (\Exception $e) {
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true]);
    }

    public function indexTable (Request $request)
    {
        $products = Product::query()->where('merchant_id', auth()->id())
            ->join('product_translations as t', function ($join) {
            $join->on('t.product_id', '=', 'products.id')->where('t.locale', '=', app()->getLocale());
        })->select('products.*');
        return Datatables::of($products)
            ->filter(function ($query) use ($request) {
                if ($request->name) {
                    $query->whereTranslationLike('name', "%$request->name%");
                }
                if ($request->category_id) {
                    $query->where('category_id', $request->category_id);
                }
                if (($request->merchant_id)) {
                    $query->where('merchant_id', $request->merchant_id);
                }
                if (!is_null($request->status)) {
                    $query->where('status', $request->status);
                }
            })->addColumn('action', function ($product) {

                $string = '<a  href="' . url('/merchant/products/' . $product->id . '/edit') .
                    '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i>' . __("common.edit") . '</a>';
                if ($product->old_price){
                    $string .= ' <a  href="' . url('/merchant/product_notification/' . $product->id) .
                        '" class="product_notification btn btn-sm btn-info"><i class=""></i>' . __("common.send_notification") . '</a>';
                }

                $string .= ' <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $product->id .
                    '"><i class="fa fa-trash-o"></i>' . __("common.delete") . '</button>';

                return $string;
            })->make(true);
    }

}
