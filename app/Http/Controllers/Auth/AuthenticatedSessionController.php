<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginEvent;
use App\Models\Option;
use App\Helpers\UserSystemInfoHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Enums\UserStatus;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
            'canRegister' => Route::has('register'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        if ($request->user()->status != UserStatus::ACTIVE) {
            Auth::guard('web')->logout();
            return redirect()->back()->with(['success'=>false, 'message'=>'You Are not active user. Please Wait for administrative response.']);
        }

        $request->session()->regenerate();


        if (Option::getOption('collect_user_location' == true)) { 
            $this->storeLoginDetails($request->user());
        }

        return redirect()->intended(RouteServiceProvider::HOME)->with(['success'=>true, 'message'=>'Login Successfull']);
    }

      /**
       * Summary of storeUserLoginDetails
       * @param mixed $user
       * @return void
       */
      public function storeLoginDetails($user)
      {
          $data = [];
          $data['ip'] = UserSystemInfoHelper::get_ip();
          $data['device_name'] = UserSystemInfoHelper::get_device();
          $data['browser_name'] = UserSystemInfoHelper::get_browsers();
          $data['os_name'] = UserSystemInfoHelper::get_os();

          $userDetails = array_merge($data, ['user_id'=>$user->id]);

          LoginEvent::dispatch($userDetails);
      }
    /**
       * Destroy an authenticated session.
       *
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\RedirectResponse
       */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with(['success'=>true,'message'=>'Logout Successfull']);
    }
}
