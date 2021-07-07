<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * @param $data
     * @return ResponseFactory|Response
     */
    public function returnSuccess($data)
    {
        $response = [
            'status'  => true,
            'message' => 'Success',
            'data'    => $data,
        ];

        return response($response, 200);
    }

    /**
     * @param string $message
     * @return ResponseFactory|Response
     */
    public function returnFalse($message = 'Failed')
    {
        $response = [
            'status'  => false,
            'message' => $message
        ];

        return response($response, 404);
    }
}
