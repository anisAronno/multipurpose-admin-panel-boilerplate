<?php

namespace App\Http\Controllers;

use App\Enums\SocialLoginFields;
use App\Enums\UserStatus;
use App\Helpers\FileHelpers;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class OptionController extends InertiaApplicationController
{
    /**
     * Filter role and permission
     */
    public function __construct()
    {
        $this->middleware('permission:options.view|options.create|options.edit|options.delete|options.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:options.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:options.edit|permission:options.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:options.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roleArr = Role::pluck('name');
        $socialLoginFields = SocialLoginFields::values();
        $userDefaultStatus = UserStatus::values();

        return Inertia::render('Settings/Index')->with(['roleArr' => $roleArr, 'socialLoginFields' => $socialLoginFields, 'userDefaultStatus' => $userDefaultStatus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOptionRequest $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
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

            if (! $path) {
                return $this->failedWithMessage('Update failed!');
            }

            FileHelpers::deleteFile($option->option_value);

            $option = $option::updateOption($option->option_key, $path);

            return Redirect::back()->with(['success' => true, 'message' => 'Succefully Updated', 'data' => $option]);
        }

        $option = $option::updateOption($option->option_key, $request->option_value);

        if ($option) {
            return Redirect::back()->with(['success' => true, 'message' => 'Succefully Updated', 'data' => $option]);
        }

        return $this->failedWithMessage('Update failed!');
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
        try {
            foreach ($request->all() as $key => $value) {
                $option::updateOption($key, $value);
            }

            return $this->successWithMessage('Successfully Updated');
        } catch (\Throwable $th) {
            return $this->failedWithMessage('Update failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        try {
            if ($option->option_value) {
                FileHelpers::deleteFile($option->option_value);
            }

            $option::updateOption($option->option_key, null);

            return Redirect::back()->with(['success' => true, 'message' => 'Succefully Updated', 'data' => $option]);
        } catch (\Throwable $th) {
            return $this->failedWithMessage('Delete failed!');
        }
    }
}
