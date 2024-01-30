<?php

namespace App\Http\Controllers\Admin\Role;

use App\Helpers\CacheControl;
use App\Helpers\CacheKey;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use App\Models\User;
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

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $queryParams = $request->query();
        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $roleCacheKey = CacheKey::getRoleCacheKey();
        $key = $roleCacheKey . md5(serialize([$queryString]));

        $roles = Cache::remember($key, now()->addDay(), function () use ($request) {
            return Role::with(['permissions' => function ($query) {
                $query->select('id', 'name');
            }])
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
            })
            ->orderBy($request->input('orderBy', 'id'), $request->input('order', 'desc'))
            ->paginate(10)
            ->withQueryString();
        });

        CacheControl::updateCacheKeys($roleCacheKey, $key);

        return Inertia::render('Dashboard/Role/Index')->with(['roles' => RoleResource::collection($roles)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');

        if (! empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return Redirect::route('role.index')->with(['success' => true, 'message' => 'successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
      */
    public function show(Role $role)
    {
        $role->load('permissions');

        return Inertia::render('Dashboard/Role/Show', ['role' => new RoleResource($role) ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
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

        return Redirect::route('role.index')->with(['success' => true, 'message' => 'successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Role $role)
    {
        if (! $role->isDelatable) {
            return $this->failedWithMessage('Role is not delatable');
        }

        $role->delete();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message' => 'successfully Deleted']);
        }

        return Redirect::route('role.index')->with(['success' => true, 'message' => 'successfully Deleted']);
    }
}
