<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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
        $this->middleware('permission:role.view|role.create|role.edit|role.status|role.delete', ['only' => ['index','store']]);
        $this->middleware('permission:role.create', ['only' => ['create','store']]);
        $this->middleware('permission:role.edit|permission:role.status', ['only' => ['edit','update']]);
        $this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::with(['permissions'=>function ($query) {
            $query->select('id', 'name');
        }])->paginate(3);

        Session::put('last_visited_url', $request->fullUrl());

        if (!$roles->items()) {
            return Redirect::to($roles->previousPageUrl());
        }

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

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'));
        }

        return Redirect::route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function show(Role $role)
  {
      $role->load('permissions');
      return Inertia::render('Role/Show', compact('role'));
  }

    /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('group_name')->get();

        $role->load(['permissions'=>function ($query) {
            $query->orderBy('name');
        }]);


        $permissionWithGroup  = $permissions->groupBy(function ($data) {
            return $data->group_name;
        });

        $all_group  = User::getpermissionGroups()->pluck('name');


        return Inertia::render('Role/Edit', [
            'permissionWithGroup'=>$permissionWithGroup,
            'permissions'=>$permissions->pluck('name'),
            'all_group'=>$all_group,
            'total_permissions'=>$permissions->count(),
            'total_group'=>$all_group->count(),
            'role'=>$role,
            'permissionArr'  => $role->permissions->pluck('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($permissions);
        }


        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'));
        }

        return Redirect::route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!in_array($role->id, [1,2])) {
            $role->delete();
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'));
        }
        
        return Redirect::back();
    }
}
