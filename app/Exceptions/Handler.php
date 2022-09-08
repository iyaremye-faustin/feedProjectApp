<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\ApiResponse;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponse;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function(Throwable $e){
            return $this->handleException($e);
        });

    }
    public function handleException(Throwable $e)
        {
            if ($e instanceof TokenMismatchException) { //for only web application not api requests
                return redirect()->back()->withInput(request()->input());
            }
            if ($e instanceof MethodNotAllowedHttpException) {
                return $this->errorResponse("",404,"Method not allowed");
            }

            if ($e instanceof ModelNotFoundException) {
                $model=$e->getModel();
                return $this->errorResponse("",404,"Does Not Exist any {$model} with that identifier");
            }
            if ($e instanceof NotFoundHttpException) {
                return $this->errorResponse("",404,"The URL or Object not Found");
            }
            if ($e instanceof AuthenticationException) {
                return $this->errorResponse("",401,"Authentication is required");
            }
            if ($e instanceof AuthorizationException) {
                return $this->errorResponse("",403,$e->getMessage());
            }
            if ($e instanceof QueryException) {
                $errorCode=$e->errorInfo[1];
                if ($errorCode==1451) {
                    return $this->errorResponse("",409,"You can not remove this resource permanently,It is related with another resource");
                }
            }

            if ($e instanceof ValidationException) {
                return $this->errorResponse("",401,$e->validator->errors()->getMessages());
            }
            if ($e instanceof HttpException) {
                return $this->errorResponse("",$e->getStatusCode(),$e->getMessage());
            }
            if (config('app.debug')==false) {
                return $this->errorResponse("",500,"Unexpected error occured,please try again later!");
            }
            return $this->errorResponse($e,500,"Unexpected error occured,please try again later!");
        }
}
