<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

class RolesController extends InertiaApplicationController
{
    /**
     * Filter role and permission
     */
    public function __construct()
    {
        $this->middleware('permission:role.view|role.create|role.edit|role.status|role.delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role.edit|permission:role.status', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $currentPage = isset($request->page) ? (int) [$request->page] : 1;

        if (! empty($request->search)) {
            $q = $request->search;
            $roles = Role::with(['permissions' => function ($query) {
                $query->select('id', 'name');
            }])->where('name', 'LIKE', '%'.$q.'%')->orderBy('id', 'desc')->paginate(10);

            return Inertia::render('Dashboard/Role/Index', ['roles' => $roles]);
        }

        $key = CacheHelper::getRoleCacheKey($currentPage);

        $roles = Cache::remember($key, 10, function () {
            return Role::with(['permissions' => function ($query) {
                $query->select('id', 'name');
            }])->orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Role/Index', ['roles' => $roles]);
    }


    public function create()
    {
        $permissions = Permission::orderBy('group_name')->get();

        $permissionWithGroup = $permissions->groupBy(function ($data) {
            return $data->group_name;
        });

        $all_group = User::getpermissionGroups()->pluck('name');

        return Inertia::render('Dashboard/Role/Create', [
            'permissionWithGroup' => $permissionWithGroup,
            'permissions' => $permissions->pluck('name'),
            'all_group' => $all_group,
            'total_permissions' => $permissions->count(),
            'total_group' => $all_group->count(),
        ]);
    }

    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');

        if (! empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return Redirect::route('admin.role.index')->with(['success' => true, 'message' => 'successfully Created']);
    }


    public function show(Role $role)
    {
        $role->load('permissions');

        return Inertia::render('Dashboard/Role/Show', compact('role'));
    }


    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('group_name')->get();

        $role->load(['permissions' => function ($query) {
            $query->orderBy('name');
        }]);

        $permissionWithGroup = $permissions->groupBy(function ($data) {
            return $data->group_name;
        });

        $all_group = User::getpermissionGroups()->pluck('name');

        return Inertia::render('Dashboard/Role/Edit', [
            'permissionWithGroup' => $permissionWithGroup,
            'permissions' => $permissions->pluck('name'),
            'all_group' => $all_group,
            'total_permissions' => $permissions->count(),
            'total_group' => $all_group->count(),
            'role' => $role,
            'permissionArr' => $role->permissions->pluck('name'),
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role)
    {
        $permissions = $request->input('permissions');

        if (empty($permissions) || ! $role->isEditable) {
            return Redirect::back()->with(['success' => false, 'message' => 'Role is not Updateable']);
        } else {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message' => 'successfully Updated']);
        }

        return Redirect::route('admin.role.index')->with(['success' => true, 'message' => 'successfully Updated']);
    }


    public function destroy(Role $role)
    {
        if (! $role->isDelatable) {
            return $this->failedWithMessage('Role is not delatable');
        }

        $role->delete();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message' => 'successfully Deleted']);
        }

        return Redirect::route('admin.role.index')->with(['success' => true, 'message' => 'successfully Deleted']);
    }
}
