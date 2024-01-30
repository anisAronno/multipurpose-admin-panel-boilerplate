<?php

namespace App\Http\Controllers\User;

use AnisAronno\MediaHelper\Facades\Media;
use App\Enums\UserStatus;
use App\Helpers\CacheControl;
use App\Helpers\CacheKey;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResources;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class UserController extends InertiaApplicationController
{
    /**
     * Filter role and permission
     */
    public function __construct()
    {
        $this->middleware('permission:user.view|user.create|user.edit|user.delete|user.status', ['only' => ['index', 'store']]);
        $this->middleware('permission:user.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user.edit|permission:user.status|', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user.delete', ['only' => ['destroy']]);
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
        $userCacheKey = CacheKey::getUserCacheKey();
        $key = $userCacheKey . md5(serialize([$queryString]));

        $users = Cache::remember($key, now()->addDay(), function () use ($request) {
            return User::with(['roles'])
                ->when($request->has('search'), function ($query) use ($request) {
                    $query->where(function ($subQuery) use ($request) {
                        $subQuery->where('name', 'LIKE', '%' . $request->input('search') . '%')
                            ->orWhere('email', 'LIKE', '%' . $request->input('search') . '%');
                    });
                })
                ->when($request->has('startDate') && $request->has('endDate'), function ($query) use ($request) {
                    $query->whereBetween('created_at', [
                        new \DateTime($request->input('startDate')),
                        new \DateTime($request->input('endDate'))
                    ]);
                })
                ->orderBy($request->input('orderBy', 'id'), $request->input('order', 'desc'))
                ->paginate(10)
                ->withQueryString();
        });

        CacheControl::updateCacheKeys($userCacheKey, $key);

        return Inertia::render('Dashboard/User/Index')->with(['users' => UserResources::collection($users)]);
    }


    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $role = Role::pluck('name');
        $statusArr = UserStatus::values();

        return Inertia::render('Dashboard/User/Create', ['roles' => $role, 'statusArr' => $statusArr]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->only('name', 'email', 'password', 'status', 'gender');

        if ($request->avatar) {
            $data['avatar'] = Media::upload($request, 'avatar', 'users');
        }

        $user = User::create($data);

        if ($user) {
            $user->assignRole($request->get('roles'));
        }

        return Redirect::route('user.index')->with(['success' => true, 'message', 'Created successfull']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
      */
    public function show(User $user)
    {
        $user->load(['roles']);


        return Inertia::render('Dashboard/User/Show', ['user' =>  new UserResources($user)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(User $user)
    {
        $user->load(['roles:name']);

        $user->has_roles = $user->roles->map(function ($value) {
            return $value->name;
        });

        $statusArr = UserStatus::values();

        $roleArr = Role::pluck('name');

        return Inertia::render('Dashboard/User/Edit', ['user' => $user, 'statusArr' => $statusArr, 'roleArr' => $roleArr]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->only('name', 'email', 'status', 'gender'));

        if (! $user->isEditable) {
            $user->roles()->detach();

            $roles = $request->roles;

            if (! in_array('superadmin', $roles)) {
                array_push($roles, 'superadmin');
            }

            $user->assignRole($roles);
        } else {
            $user->roles()->detach();
            $user->assignRole($request->roles);
        }

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Updated successfull']);
        }

        return Redirect::route('user.index')->with(['success' => true, 'message', 'Updated successfull']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(User $user)
    {
        if (! $user->isDeletable) {
            return $this->failedWithMessage('User is not delatable');
        }

        $user->delete();

        if (session('last_visited_url')) {
            return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
        }

        return $this->successWithMessage('Deleted successfull');
    }

    /**
     * Summary of avatarUpdate
     *
     * @param  User  $user
     */
    public function avatarUpdate(Request $request, User $user)
    {
        if ($request->image) {
            $path = Media::upload($request, 'image', 'users');
            if (! $path) {
                return $this->successWithMessage('Update Failed');
            } else {
                Media::delete($user->avatar);
                $user->update([$user->avatar = $path]);
            }
        }

        return $this->successWithMessage('Successfully Updated');
    }

    /**
     * Remove the specified user avatar.
     *
     * @param  int  $id
     */
    public function avatarDelete(User $user)
    {
        Media::delete($user->avatar);

        $user->update([$user->avatar = null]);

        return $this->failedWithMessage('Deleted successfull');
    }
}
