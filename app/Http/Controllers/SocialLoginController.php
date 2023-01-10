<?php

namespace App\Http\Controllers;

use App\Events\LoginEvent;
use App\Helpers\UserSystemInfoHelper;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\InertiaApplicationController;
use App\Models\User;
use Laravel\Socialite\Two\InvalidStateException;

class SocialLoginController extends InertiaApplicationController
{
    public function socialLoginRedirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function socialLoginCallback(Request $request, $provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            $socialiteUser = Socialite::driver($provider)->stateless()->user();
        }

        if ( filter_var($socialiteUser->getEmail(), FILTER_VALIDATE_EMAIL) ) {
            $email = $socialiteUser->getEmail();
            $name =  $socialiteUser->getName() ?? '';
            $phone_number = $socialiteUser->user['mobile'] ?? '';
            $image =$socialiteUser->getAvatar() ?? '';
            $id = $socialiteUser->id ?? '';
            $password = Hash::make(Str::random(32));

            $user = User::firstOrCreate(
                [
                      'email' => $email
                  ],
                [
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'phone_number' => $phone_number,
                    'avatar' => $image,
                    'email_verified_at' => Carbon::now(),
                    'email_verification_token' => '',
                    'sso_id' => $id,
                    'sso' => $provider,
                    'sso_token' => $socialiteUser->token,
                    'sso_refresh_token' => $socialiteUser->refreshToken,
                ]
            );



            $request->session()->regenerate();

            Auth::login($user, true);

            $this->storeLoginDetails($user, $provider);

            return redirect()->intended(RouteServiceProvider::HOME)->with(['success'=>true, 'message'=>'Login Successfull']);
        } else {
            return $this->failedWithMessage("Something went wrong!");
        }
    }

     /**
       * Summary of storeUserLoginDetails
       * @param mixed $user
       * @return void
       */
      public function storeLoginDetails($user, $provider)
      {
          $data = [];
          $data['ip'] = UserSystemInfoHelper::get_ip();
          $data['auth_source'] = $provider;
          $data['device_name'] = UserSystemInfoHelper::get_device();
          $data['browser_name'] = UserSystemInfoHelper::get_browsers();
          $data['os_name'] = UserSystemInfoHelper::get_os();
          $data['auth_source'] = '';

          $userDetails = array_merge($data, ['user_id'=>$user->id]);

          LoginEvent::dispatch($userDetails);
      }
}
