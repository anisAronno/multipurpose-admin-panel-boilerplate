<?php

namespace App\Http\Controllers\User;

use AnisAronno\MediaHelper\Facades\Media;
use App\Enums\UserGender;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function edit(Request $request)
    {
        return Inertia::render('Dashboard/Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'genderArr' => UserGender::values(),
            'addresses' => $request->user()->addresses,
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with(['success' => true, 'message', 'Profile updated']);
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        Auth::logout();

        if (! $user->is_deletable) {
            Media::delete($user->avatar);
            $user->delete();
        }

        if (! $user->is_deletable) {
            $user->delete();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with(['success' => true, 'message', 'Profile Deleted']);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function avatarUpdate(ProfileUpdateRequest $request)
    {
        try {
            $user = $request->user();
            if ($request->avatar) {
                $path = Media::upload($request, 'avatar', 'users');

                if ($path) {
                    Media::delete($user->avatar);
                    $user->avatar = $path;
                    $user->save();

                    return Redirect::back()->with(['success' => true, 'message', 'Profile picture updated']);
                } else {
                    return Redirect::back()->with(['success' => false, 'message', 'Failed Update']);
                }
            } else {
                return Redirect::back()->with(['success' => false, 'message', 'Something went wrong']);
            }
        } catch (\Throwable $th) {
            return Redirect::back()->with(['success' => false, 'message', 'Something went wrong']);
        }
    }
}
