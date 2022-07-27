<?php

namespace App\Http\Controllers\API\V1\Backend;

use stdClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    public function sendSuccessResponse($data=[],$message="")
    {
        $response = new stdClass;
        $response->status = true;
        $response->data = $data;
        $response->message = $message;
        return response()->json($response);
    }

    public function sendErrorResponse($errors=[],$message="")
    {
        $response = new stdClass;
        $response->status = false;
        $response->errors = $errors;
        $response->message = $message;
        return response()->json($response);
    }
}
