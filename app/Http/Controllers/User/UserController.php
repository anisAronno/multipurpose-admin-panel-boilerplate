<?php

namespace App\Http\Controllers\User;

use App\Enums\Status;
use App\Enums\UserStatus;
use App\Helpers\FileHelpers;
use App\Http\Controllers\InertiaApplicationController;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\UserResources;
use App\Models\Role;
use App\Models\User;
use App\Helpers\CacheHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
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

    public function index(Request $request)
    {
        $orderBy    = in_array($request->get('orderBy'), ['date']) ? $request->orderBy : 'created_at';
        $order      = in_array($request->get('order'), ['asc', 'desc']) ? $request->order : 'desc';
        $status     = in_array($request->get('status'), Status::values()) ? $request->status : '';

        $is_premium = $request->get('is_premium') ? $request->is_premium : '';

        $search     = $request->get('search', '');
        $startDate = $request->get('startDate', '');
        $endDate   = $request->get('endDate', '');
        $page       = $request->get('page', 1);
        $userCacheKey = CacheHelper::getUserCacheKey();

        $user  = auth()->user();
        $key =  $userCacheKey.md5(serialize([$orderBy, $order, $status, $is_premium, $page, $search, $startDate, $endDate,  ]));

        $users = Cache::tags([$userCacheKey, $user->token])->remember($key, now()->addDay(), function () use (
            $orderBy,
            $order,
            $status,
            $is_premium,
            $search,
            $startDate,
            $endDate,
            $user,
        ) {
            $users = User::with(['roles']);

            if (! $user->haveAdministrativeRole()) {
                $users->where('user_id', $user->id);
            }

            if (! empty($status)) {
                $users->where('status', $status);
            }

            if (! empty($is_premium)) {
                $users->where('is_premium', $is_premium);
            }


            if (! empty($search)) {
                $users->where('name', 'LIKE', '%'.$search.'%')->orWhere('email', 'LIKE', '%'.$search.'%')->orWhere('phone', 'LIKE', '%'.$search.'%');
            }

            if (! empty($startDate) && ! empty($endDate)) {
                $users->where('created_at', '>=', new \DateTime($startDate));
                $users->where('created_at', '<=', new \DateTime($endDate));
            }

            if (! empty($orderBy)) {
                $users->orderBy($orderBy, $order);
            }

            return $users->paginate(10);
        });

        Session::put('last_visited_url', $request->fullUrl());

        return Inertia::render('Dashboard/User/Index')->with(['users' => UserResources::collection($users)]);
    }

    public function create()
    {
        $role = Role::pluck('name');
        $statusArr = UserStatus::values();

        return Inertia::render('Dashboard/User/Create', ['roles' => $role, 'statusArr' => $statusArr]);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->only('name', 'email', 'status', 'gender');

        $data['password'] = Hash::make($request->password);
        $data['email_verified_at'] = Carbon::now();

        if ($request->avatar) {
            $data['avatar'] = FileHelpers::upload($request, 'avatar', 'users');
        }

        $user = User::create($data);

        if ($user) {
            $user->assignRole($request->get('roles'));
        }

        return Redirect::route('admin.user.index')->with(['success' => true, 'message', 'Created successfull']);
    }

    public function show(User $user)
    {
        $user->load(['roles']);

        return Inertia::render('Dashboard/User/Show', ['user' => $user]);
    }


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

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->only('name', 'email', 'status', 'gender'));

        if (! $user->is_editable) {
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

        return Redirect::route('admin.user.index')->with(['success' => true, 'message', 'Updated successfull']);
    }

   public function destroy(User $user)
   {
       if (! $user->is_deletable) {
           return $this->failedWithMessage('User is not delatable');
       }

       $user->delete();

       if (session('last_visited_url')) {
           return Redirect::to(session('last_visited_url'))->with(['success' => true, 'message', 'Deleted successfull']);
       }

       return $this->successWithMessage('Deleted successfull');
   }

   public function avatarUpdate(Request $request, User $user)
   {
       if ($request->image) {
           $path = FileHelpers::upload($request, 'image', 'users');
           if (! $path) {
               return $this->successWithMessage('Update Failed');
           } else {
               FileHelpers::deleteFile($user->avatar);
               $user->update([$user->avatar = $path]);
           }
       }

       return $this->successWithMessage('Successfully Updated');
   }

   public function avatarDelete(User $user)
   {
       FileHelpers::deleteFile($user->avatar);

       $user->update([$user->avatar = null]);

       return $this->failedWithMessage('Deleted successfull');
   }
}
