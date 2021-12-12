<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guard = Arr::get($exception->guards(), 0);
        switch ($guard) {
            case 'admin':
                $login = '/admin/login';
                break;
            default:
                $login = '/login';
                break;
        }
        return $request->wantsJson()
            ? mainResponse(false, 'unauthenticated', [], [], 401)
            : redirect()->guest(url(locale().$login));
    }
    protected function prepareJsonResponse($request, Exception $e)
    {
//        dd($this->convertExceptionToArray($e));
        return mainResponse(false, $this->convertExceptionToArray($e)['message'], [], $this->convertExceptionToArray($e));
        /*        return new JsonResponse(
                    $this->convertExceptionToArray($e),
                    $this->isHttpException($e) ? $e->getStatusCode() : 500,
                    $this->isHttpException($e) ? $e->getHeaders() : [],
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
                );*/
    }

}
