<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

class InertiaApplicationController extends Controller
{
    protected function fail($code = 200)
    {
        return Redirect::back()->with(['success' => false], $code);
    }

    protected function failedWithMessage($message, $code = 200)
    {
        return Redirect::back()->with(['success' => false, 'message' => $message], $code);
    }

    protected function success($code = 200)
    {
        return Redirect::back()->with(['success' => true], $code);
    }

    protected function successWithMessage($message, $code = 200)
    {
        return Redirect::back()->with(['success' => true, 'message' => $message], $code);
    }

    protected function successWithData($data, $code = 200)
    {
        return Redirect::back()->with(['success' => true, 'data' => $data], $code);
    }

}
