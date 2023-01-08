<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelpers;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OptionController extends Controller
{
    /**
      * Filter role and permission
      */
    // public function __construct()
    // {
    //     $this->middleware('permission:options.view|options.create|options.edit|options.delete|options.status', ['only' => ['index','store']]);
    //     $this->middleware('permission:options.create', ['only' => ['create','store']]);
    //     $this->middleware('permission:options.edit|permission:options.status|', ['only' => ['edit','update']]);
    //     $this->middleware('permission:options.delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Settings/Index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::back()->with('message', 'Updated successfull');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
        return Inertia::back()->with('message', 'Updated successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return Inertia::back()->with('message', 'Updated successfull');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        return Inertia::back()->with('message', 'Updated successfull');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        if ($request->image) {
            $path = FileHelpers::upload($request, 'image', 'settings');
            if (!empty($path)) {
                FileHelpers::deleteFile($option->option_value);
                $option::setOption($option->option_key, $path);
                return Redirect::back()->with('message', 'Updated successfull');
            }
        }

        return Redirect::back()->with('message', 'Update failed!');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOptionRequest  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function bulkUpdate(UpdateOptionRequest $request, Option $option)
    {
        foreach ($request->all() as $key => $value) {
            $option::setOption($key, $value);
        }

        return Redirect::back()->with('message', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        if ($option->option_value) {
            FileHelpers::deleteFile($option->option_value);
        }

        $option::setOption($option->option_key, null);

        return Redirect::back()->with('message', 'Deleted successfull')->with(['options'=>$option]);
    }
}
