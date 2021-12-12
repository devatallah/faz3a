<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function locale ()
{
    return Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}

function locales ()
{
    $arr = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __('' . $value['name']);
    }
    return $arr;
}

function languages ()
{
//    $langs = \App\Models\Language::query()->where('status', 1)->get()->pluck('name' ,'lang')->toArray();
    if (app()->getLocale() == 'en') {
        return ['ar' => 'arabic', 'en' => 'english'];
    } else {
        return ['ar' => 'العربية', 'en' => 'النجليزية'];

    }
}

function logo ()
{
    $logo = \App\Models\Setting::query()->where('key', 'logo')->first()->getAttribute('value');
    return $logo;
}

function perPage ()
{
    $per_page = \App\Models\Setting::query()->where('key', 'per_page')->first()->getAttribute('value');
    return $per_page;
}

function mainResponse ($status, $msg, $items, $validator, $code = 200, $pages = null)
{
//    dd($items);
    if (isset(json_decode(json_encode($items, true), true)['data'])) {
        $pagination = json_decode(json_encode($items, true), true);
        $items = $pagination['data'];
        $pages = [
            "current_page" => $pagination['current_page'],
            "first_page_url" => $pagination['first_page_url'],
            "from" => $pagination['from'],
            "last_page" => $pagination['last_page'],
            "last_page_url" => $pagination['last_page_url'],
            "next_page_url" => $pagination['next_page_url'],
            "path" => $pagination['path'],
            "per_page" => $pagination['per_page'],
            "prev_page_url" => $pagination['prev_page_url'],
            "to" => $pagination['to'],
            "total" => $pagination['total'],
        ];
    } else {
        $pages = [
            "current_page" => 0,
            "first_page_url" => '',
            "from" => 0,
            "last_page" => 0,
            "last_page_url" => '',
            "next_page_url" => null,
            "path" => '',
            "per_page" => 0,
            "prev_page_url" => null,
            "to" => 0,
            "total" => 0,
        ];
    }

    $aryErrors = [];
    foreach ($validator as $key => $value) {
        $aryErrors[] = ['field_name' => $key, 'messages' => $value];
    }
    /*    $aryErrors = array_map(function ($i) {
            return $i[0];
        }, $validator);*/

    $newData = ['status' => $status, 'message' => __($msg), 'items' => $items, 'pages' => $pages, 'errors' => $aryErrors];

    return response()->json($newData);
}

//function mainResponse($status, $msg, $items, $validator, $code = 200, $pages = null)
//{
///*    $pages = [
//        'current_page' => 0,
//        'first_page_url' => '',
//        'from' => 0,
//        'last_page' => 0,
//        'last_page_url' => '',
//        'next_page_url' => '',
//        'path' => '',
//        'per_page' => 0,
//        'prev_page_url' => '',
//        'to' => 0,
//        'total' => 0,
//    ];*/
///*    if (isset(json_decode(json_encode($items), true)['data'])){
//        $data = json_decode(json_encode($items), true);
//        $pages = [
//            'total' => $data['total'],
//            'per_page' => $data['per_page'],
//            'current_page' => $data['current_page'],
//            'last_page' => $data['last_page'],
//            'next_page_url' => $data['next_page_url'],
//            'prev_page_url' => $data['prev_page_url'],
//            'from' => $data['from'],
//            'to' => $data['to']
//        ];
//        $items = $data['data'];
//    }*/
//    $aryErrors = [];
//    foreach ($validator as $key => $value) {
//        $aryErrors[] = ['field_name' => $key, 'messages' => $value];
//    }
//    $newData = ['code' => 200, 'status' => $status, 'message' => __($msg), 'items' => $items/*, 'pages' => $pages*/, 'errors' => $aryErrors];
//    return response()->json($newData, 200);
//}

function latlng ($ip = '213.6.137.2')
{
    $url = 'http://ip-api.com/json/' . $ip;
    $headers = ['Accept' => 'application/json'];
    $http = new \GuzzleHttp\Client();
    $response = $http->get($url, [
        'headers' => $headers,
        'form_params' => [],
    ]);
    $data = json_decode((string)$response->getBody(), true);
    return ['lat' => $data['lat'], 'lng' => $data['lon']];
    /*    if (array_key_exists('countryCode', $data)) {
            //do your code
        }
        return 'no data';*/
}

function oneCardApi ($function, $params)
{
    $client = new SoapClient('https://www.ocstaging.net/webservice/OneCardPOSSystem.wsdl', array('soap_version' => SOAP_1_1, 'trace' => 1, 'exceptions' => true));
    try {
        $result = $client->__soapCall($function, [$params]);
        return json_decode(json_encode($result), true);
    } catch (Exception $e) {
        return ($e->getMessage());
    }
}

function check_number ($mobile)
{
    $persian = array('٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠');
    $num = range(9, 0);
    $mobile = str_replace(' ', '', $mobile);
    $mobile = str_replace($persian, $num, $mobile);
    $mobile = substr($mobile, -9);

    if (preg_match("/^[5][0-9]{8}$/", $mobile)) {
        $mobile = '966' . $mobile;

        return $mobile;
    } else {
        return FALSE;
    }
}

function send_sms ($mobile, $message)
{
    $mobiles = [];
    foreach ($mobile as $item) {
        $mobiles[] = check_number($item);
    }
    $mobiles = implode(',', $mobiles);
    if ($mobile) {
        $message = urlencode($message);
        $url = "http://www.jawalsms.net/httpSmsProvider.aspx?username=wasilcom&password=987654321&mobile=$mobiles&unicode=E&message=$message&sender=WasilCom";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLE_HTTP_NOT_FOUND, 1);
        $LastData = curl_exec($ch);
        curl_close($ch);
        return $LastData;


    }
}
function TopicNotification($title, $content, $product = []){
    ini_set("allow_url_fopen", "On");
    $data =
        [
            "to" => '/topics/riyalat',
            "notification" => [
                "title" => $title,
                "body" => $content,
                "product" => $product,
            ],
//                "data" => $customData
    ];
    $headers = [
        'Authorization: key=AIzaSyCOpSxmI-wsTbcBovjZw5dAst6LxDnLCTg',
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $result = curl_exec($ch);
    curl_close($ch);
    return json_decode( $result );

    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                "Accept: application/json\r\n" .
                "Authorization:key=AIzaSyCOpSxmI-wsTbcBovjZw5dAst6LxDnLCTg"
        )
    );

    $context  = stream_context_create( $options );
    $result = file_get_contents( "https://fcm.googleapis.com/fcm/send", false, $context );
    return json_decode( $result );
}


function fcmNotification ($token, $title, $content, $body, $type, $id, $device)
{
    $msg = [
        'title' => $title,
        'content' => $content,
        'body' => $body,
        'type' => $type,
        'id' => $id,
        'icon' => 'myicon',
        'sound' => 'mySound',
    ];
    if ($device == 'ios') {
        $fields = [
            'registration_ids' => $token,
            'notification' => $msg,
        ];
    } else {
        $fields = [
            'registration_ids' => $token,
            'notification' => $msg,
        ];
    }

    $headers = [
        "Authorization: key=AAAA9Y_AnZ0:APA91bFeG00sRiT3ZqS5aBpyChOThqd73DflPS_KDE1mBvby_AJuVqBE3Tk32PcJ8tRumG88PXfVaS-0EXVnpyI4Yk7xqCXc4J_aE0cEd4jHg5rEwbXi3YLD6BhGCfDDYNdzyG6zS6GV",
        'Content-Type: application/json'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function parseServer ($url, $data = null, $http_request_type = 'GET')
{
    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, "http://198.12.252.234:1337/parse/classes/Contracts");
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($http_request_type == 'POST'){
        curl_setopt($ch, CURLOPT_POST, 1);
    }
    if ($http_request_type == 'PUT' ||$http_request_type == 'DELETE'){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_request_type);
    }

    if ($data){
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Parse-Master-Key: KJDF89DFJ3H37JHFJDF8DFJDF',
        'X-Parse-REST-API-Key: KJDF89DFJ3H37JHFJDF8DFJDF',
        'X-Parse-Application-Id: KSDJFKDJ9DKFDJDKF',
        'Content-Type: application/json',
    ]);
    $server_output = curl_exec($ch);
    curl_close($ch);
    return json_decode($server_output, 1);
}



