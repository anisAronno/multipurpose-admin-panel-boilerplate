<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Models\Option;

class LanguageStoreController extends Controller
{
    public function __invoke(StoreLanguageRequest $request)
    {

        session()->put('language', $request->language ?? Option::getOption('language'));

        return back();
    }
}
