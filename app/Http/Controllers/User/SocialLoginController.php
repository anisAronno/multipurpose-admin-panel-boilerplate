<?php

namespace App\Http\Controllers\User;

use App\Events\LoginEvent;
use App\Helpers\UserSystemInfoHelper;
use App\Models\Option;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\InertiaApplicationController;
use App\Models\User;
use App\Enums\UserStatus;
use Laravel\Socialite\Two\InvalidStateException;
use Spatie\Permission\Models\Role;

class SocialLoginController extends InertiaApplicationController
{
    /**
     * Redirect to provider
     * @param mixed $provider
     * @return mixed
     */
    public function socialLoginRedirect($provider)
    {
        $isActiveSSO = Option::getOption('allow_social_login');

        if (!$isActiveSSO || $isActiveSSO == false) {
            return $this->failedWithMessage('Social Login Is Not Active');
        }

        return Socialite::driver($provider)->redirect();
    }
    /**
     * Handle callback from provider
     * @param Request $request
     * @param mixed $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function socialLoginCallback(Request $request, $provider)
    {
        $isActiveSSO = Option::getOption('allow_social_login');

        if (!$isActiveSSO || $isActiveSSO == false) {
            return $this->failedWithMessage('Social Login Is Not Active');
        }

        try {
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (InvalidStateException $e) {
            $socialiteUser = Socialite::driver($provider)->stateless()->user();
        }

        try {
            if (filter_var($socialiteUser->getEmail(), FILTER_VALIDATE_EMAIL)) {
                $email = $socialiteUser->getEmail();
                $name =  $socialiteUser->getName() ?? '';
                $phone_number = $socialiteUser->user['mobile'] ?? '';
                $image =$socialiteUser->getAvatar() ?? '';
                $id = $socialiteUser->id ?? '';
                $password = Hash::make(Str::random(32));
                $userDefaultStatus = Option::getOption('user_default_status');

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
                        'status' => $userDefaultStatus,
                    ]
                );

                if ($userDefaultStatus !== UserStatus::ACTIVE) {
                    return redirect()->route('login')->with(["success"=>true,"Registration is complete. Please Wait for administrative response."]);
                }

                $request->session()->regenerate();

                Auth::login($user, true);

                $logedInUser = auth()->user();

                $logedInUser->socialLogins()->create([
                        'sso_id' => $id,
                        'sso_provider' => $provider,
                        'sso_token' => $socialiteUser->token,
                        'sso_refresh_token' => $socialiteUser->refreshToken,
                        'user_id' => $logedInUser->id,
                ]);

                $this->setRole($logedInUser);

                if (Option::getOption('collect_user_location' == true)) {
                    $this->storeLoginDetails($logedInUser, $provider);
                }

                return redirect()->intended(RouteServiceProvider::HOME)->with(['success'=>true, 'message'=>'Login Successfull']);
            } else {
                return $this->failedWithMessage("Something went wrong!");
            }
        } catch (\Throwable $th) {
            return $this->failedWithMessage("Failed ". $th->getMessage());
        }
    }

    /**
     * set user role
     * @param mixed $user
     * @return void
     */
    private function setRole($user): void
    {
        $user->load('roles:name');

        $hasRole = $user->hasAllRoles(Role::all());

        logger()->debug($hasRole);

        if (!$hasRole) {
            $role = Option::getOption('user_default_role');
            $user->assignRole($role);
        }
    }

     /**
       * Summary of storeUserLoginDetails
       * @param mixed $user
       * @return void
       */
      public function storeLoginDetails($user, $provider)
      {
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
