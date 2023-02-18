<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Resources\RoleWithPermissionResources;
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
        $orderBy    = in_array($request->get('orderBy'), ['date']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $roleCacheKey = CacheHelper::getRoleCacheKey();

        $user  = auth()->user();
        $key =  $roleCacheKey.md5(serialize([$orderBy, $order,  $page, $search, $startDate, $endDate,  ]));

        $roles = Cache::tags([$roleCacheKey, $user->token])->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $search,
            $startDate,
            $endDate,
            $user,
        ) {
            $roles = Role::with([ 'permissions']);

            if (! $user->haveAdministrativeRole()) {
                $roles->where('user_id', $user->id);
            }

            if (! empty($search)) {
                $roles->where('title', 'LIKE', '%'.$search.'%')->orWhere('description', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $roles->where('created_at', '>=', new \DateTime($startDate));
                $roles->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $roles->orderBy($orderBy, $order);
            }

            return $roles->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/Role/Index')->with(['roles' => RoleWithPermissionResources::collection($roles)]);
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

        return Inertia::render('Dashboard/Role/Show', ['role' => new RoleWithPermissionResources($role) ]);
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

        if (empty($permissions) || ! $role->is_editable) {
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
