<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function fail($code = 200)
    {
        return response()->json(['success' => false], $code);
    }

    protected function failedWithMessage($message, $code = 200)
    {
        return response()->json(['success' => false, 'message' => $message], $code);
    }

    protected function success($code = 200)
    {
        return response()->json(['success' => true], $code);
    }

    protected function successWithMessage($message, $code = 200)
    {
        return response()->json(['success' => true, 'message' => $message], $code);
    }

    protected function successWithData($data, $code = 200)
    {
        return response()->json(['success' => true, 'data' => $data], $code);
    }
}
