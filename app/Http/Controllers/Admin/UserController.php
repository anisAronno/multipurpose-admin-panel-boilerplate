<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use App\Services\Cache\CacheServices;
use App\Services\FileServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;
use App\Models\Role;

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
        $currentPage = isset($request->page) ? (int)[$request->page] : 1;

        $key = CacheServices::getUserCacheKey($currentPage);

        if (!empty($request->search)) {
            $q = $request->search;
            $users = User::with(['roles'])->where('name', 'LIKE', '%' . $q . '%')->orWhere('email', 'LIKE', '%' . $q . '%')->orderBy('id', 'desc')->paginate(10);
            return Inertia::render('User/Index', ['users'=>$users]);
        }

        $users = Cache::remember($key, 10, function () {
            return User::with(['roles'])->orderBy('id', 'desc')->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('User/Index', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::pluck('name');
        $statusArr =  UserStatus::values();
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
        $data = $request->only('name', 'email', 'password', 'status');

        if ($request->avatar) {
            $data['avatar'] = FileServices::upload($request, 'avatar', 'users');
        }

        $user = User::create($data);

        if ($user) {
            $user->assignRole($request->get('roles'));
        }

        return Redirect::route('user.index')->with('message', 'Created successfull');
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

        $statusArr =  UserStatus::values();


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
        $data = $request->only('name', 'email', 'status');

        if ($request->avatar) {
            $data['avatar'] = FileServices::upload($request, 'avatar', 'users');
            FileServices::deleteFile($user->avatar);
        }

        $user->update($data);

        if (! $user->isEditable) {
            $user->roles()->detach();

            $roles = $request->roles;

            if (!in_array('superadmin', $roles)) {
                array_push($roles, 'superadmin');
            }

            $user->assignRole($roles);
        } else {
            $user->roles()->detach();
            $user->assignRole($request->roles);
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with('message', 'Updated successfull');
        }

        return Redirect::route('user.index')->with('message', 'Updated successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy(User $user)
   {
       if (! $user->isDeletable) {
           return Redirect::back()->with(['message'=>'User is not delatable']);
       }

       $user->delete();

       if (session('last_visited_url')) {
           return Redirect::to(session('last_visited_url'))->with('message', 'Deleted successfull');
       }

       return Redirect::back()->with('message', 'Deleted successfull');
   }
    /**
     * Remove the specified user avatar.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function avatarDelete(User $user)
   {
       FileServices::deleteFile($user->avatar);

       $user->update([$user->avatar=null]);

       return Redirect::back()->with('message', 'Deleted successfull');
   }
}
