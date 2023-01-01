<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\FileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
    * Filter role and permission
    */
    public function __construct()
    {
        $this->middleware('permission:user.view|user.create|user.edit|user.delete|user.status', ['only' => ['index','store']]);
        $this->middleware('permission:user.create', ['only' => ['create','store']]);
        $this->middleware('permission:user.edit|permission:user.status|', ['only' => ['edit','update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $user = User::with(['roles'])->orderBy('id')->paginate(3);

        Session::put('last_visited_url', $request->fullUrl());

        if (!$user->items()) {
            return Redirect::to($user->previousPageUrl());
        }

        return Inertia::render('User/Index', ['users'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::pluck('name');
        $statusArr =  UserStatus::array();
        return Inertia::render('User/Create', ['roles'=>$role,'statusArr'=>$statusArr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $file['avatar'] = FileServices::upload($request, 'avatar', 'users');
        $data = $request->only('name', 'email', 'password', 'status');

        $user = User::create(array_merge($data, $file));
        if ($user) {
            $user->assignRole($request->get('roles'));
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'));
        }

        return Redirect::route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load(['roles']);

        return Inertia::render('User/Show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->load(['roles:name']);

        $user->has_roles = $user->roles->map(function ($value) {
            return $value->name;
        });

        $statusArr =  UserStatus::array();


        $roleArr = Role::pluck('name');

        return Inertia::render('User/Edit', ['user'=>$user, 'statusArr'=>$statusArr, 'roleArr'=>$roleArr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $file['avatar'] = FileServices::upload($request, 'avatar', 'users');
        $data = $request->only('name', 'email', 'status');

        $user->update(array_merge($data, $file));

        if ($user) {
            $user->assignRole($request->get('roles'));
        }

        if ($user && $user->id!=1) {
            $user->roles()->detach();
            $user->assignRole($request->role);
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'));
        }

        return Redirect::route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(User $user)
   {
       if ($user->id !==1) {
           FileServices::deleteFile($user->avatar);
           $user->delete();
       }

       if (session('last_visited_url')) {
           return Redirect::to(session('last_visited_url'));
       }

       return Redirect::back();
   }
}
