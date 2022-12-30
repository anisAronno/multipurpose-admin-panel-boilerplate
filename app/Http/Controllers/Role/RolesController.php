<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    /**
     * Filter role and permission
     */
    public function __construct()
    {
        $this->middleware('permission:role.view|role.create|role.edit|role.delete', ['only' => ['index','store']]);
        $this->middleware('permission:role.create', ['only' => ['create','store']]);
        $this->middleware('permission:role.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with(['permissions'=>function ($query) {
            $query->select('id', 'name');
        }])->paginate(3);
        return Inertia::render('Role/Index', [ 'roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('group_name')->get();
        $permissionWithGroup  = $permissions->groupBy(function ($data) {
            return $data->group_name;
        });

        $all_group  = User::getpermissionGroups()->pluck('name');

        return Inertia::render('Role/Create', [
            'permissionWithGroup'=>$permissionWithGroup,
            'permissions'=>$permissions->pluck('name'),
            'all_group'=>$all_group,
            'total_permissions'=>$permissions->count(),
            'total_group'=>$all_group->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        return Redirect::route('role.view');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return Inertia::render('Role/Single', compact('role', 'all_permissions', 'permission_groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return Inertia::render('Role/Edit', compact('role', 'all_permissions', 'permission_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $role->id
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }

        return Inertia::render('Role/Index', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return Redirect::route('role.view');
    }
}
