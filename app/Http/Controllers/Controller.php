<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function jsonResponse($message = "", $data = null, $code = 200)
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "data" => $data
            ], 200);
    }

    public function errorResponse($userMessage, $internalMessage = "", $moreInfo = "", $code = 400)
    {
        return response()->json([
            "code" => $code,
            "message" => $userMessage,
            "errors" => [
                "errorMessage" => $internalMessage,
                "errorDetails" => $moreInfo,
            ]
            ], 200);
    }
}
