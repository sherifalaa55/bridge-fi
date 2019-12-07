<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;

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
        $response = [
            'code' => 400,
            "message" => $exception->getMessage(),
            "errors" => [
                "errorMessage" => $exception->getMessage(),
                "errorDetails" => $exception->getTrace()
            ]
        ];
        // Default response of 400
        $code = 400;

        if ($this->isHttpException($exception)) {
            $response["internalMessage"] = $exception->getMessage() ?: "Not Found";
            $code = $exception->getStatusCode();
        }

        if ($exception instanceof ValidationException) {
            // dd($exception->errors());
            $response["message"] = current(current($exception->errors()));
            $response["errors"]["errorMessage"] = "Invalid Data";
            $response["errors"]["errorDetails"] = $exception->errors();
        }

        if ($exception instanceof AuthenticationException) {
            $code = 403;
        }

        // Return a JSON response with the response array and status code
        $response["code"] = $code;
        if (strpos(url()->current(), 'api') !== false) { 
            return response()->json($response, 200);
        } else {
            return parent::render($request, $exception);
        }
    }
}
