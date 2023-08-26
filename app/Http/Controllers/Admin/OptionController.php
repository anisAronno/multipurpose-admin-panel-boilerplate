<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SocialLoginFields;
use App\Enums\UserStatus;
use AnisAronno\MediaHelper\Facades\Media;
use App\Http\Controllers\InertiaApplicationController;
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
     * Summary of index
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        $roleArr = Role::pluck('name');
        $socialLoginFields = SocialLoginFields::values();
        $userDefaultStatus = UserStatus::values();

        return Inertia::render('Dashboard/Settings/Index')->with(['roleArr' => $roleArr, 'socialLoginFields' => $socialLoginFields, 'userDefaultStatus' => $userDefaultStatus]);
    }

    /**
     * Summary of socialSettings
     * @return \Inertia\Response
     */
    public function generalSettings()
    {
        return Inertia::render('Dashboard/Settings/GeneraleSettings');
    }

    /**
     * Summary of socialSettings
     * @return \Inertia\Response
     */
    public function socialSettings()
    {
        return Inertia::render('Dashboard/Settings/SocialeSettings');
    }

    /**
     * Summary of socialSettings
     * @return \Inertia\Response
     */
    public function modelControll()
    {
        return Inertia::render('Dashboard/Settings/ModelControll');
    }

    /**
     * Summary of update
     * @param UpdateOptionRequest $request
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        if ($request->image) {
            $path = Media::upload($request, 'image', 'settings');

            if (! $path) {
                return $this->failedWithMessage('Update failed!');
            }

            Media::delete($option->option_value);

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
     * Summary of bulkUpdate
     * @param UpdateOptionRequest $request
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
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
     * Summary of destroy
     * @param Option $option
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Option $option)
    {
        try {
            if ($option->option_value) {
                Media::delete($option->option_value);
            }

            $option::updateOption($option->option_key, null);

            return Redirect::back()->with(['success' => true, 'message' => 'Succefully Updated', 'data' => $option]);
        } catch (\Throwable $th) {
            return $this->failedWithMessage('Delete failed!');
        }
    }
}
