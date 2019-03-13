<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

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

    protected function renderHttpException(HttpException $exception)
    {
        $status_code = $exception->getStatusCode();
        $message = $exception->getMessage();
        if (!$message) {
            switch ($status_code) {
              case 400:
                  $message = 'Bad Request';
                  break;
              case 401:
                  $message = 'Sorry, you are not authorized to access this page.';
                  break;
              case 403:
                  $message = 'Sorry, you are forbidden to access this page.';
                  break;
              case 404:
                  $message = 'Sorry, the page you are looking for could not be found.';
                  break;
              case 408:
                  $message = 'Time Out';
                  break;
              case 413:
                  $message = 'Request Entity Too Large';
                  break;
              case 414:
                  $message = 'Request URI too long';
                  break;
              case 419:
                  $message = 'Sorry, your session has expired. Please refresh and try again.';
                  break;
              case 500:
                  $message = 'Whoops, something went wrong on our servers.';
                  break;
              case 503:
                  $message = 'Sorry, we are doing some maintenance. Please check back soon.';
                  break;
              default:
                  $message = 'ERROR';
                  break;
            }
        }
        return response()->view("errors.common", ['error_message' => $message, 'status_code' => $status_code], $status_code);
    }
}
