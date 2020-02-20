<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     *
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

   
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ThrottleRequestsException) {
            return res('request_too_frequently', '请求太频繁了');
        }
//        if ($exception instanceof throwable) {
//            return response(['code' => 404, 'message' => 'error'], 200);
//        }

//        dd($exception);
        if ($exception instanceof NotFoundHttpException) {
            return res('route_error', '网址不存在,请核对');
        }

        return parent::render($request, $exception);
    }

    /**
     * convertValidationExceptionToResponse. 2019/11/20 9:05.
     *
     * @param  ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $message = $e->validator->getMessageBag()->first();
        return res('validate_param_error', $message);
    }
}
