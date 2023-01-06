<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\FileServices;
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
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
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

        return Redirect::route('profile.edit')->with('message', 'Profile updated');
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

        if (! $user->isDeletable) {
            FileServices::deleteFile($user->avatar);
            $user->delete();
        }

        if (! $user->isDeletable) {
            $user->delete();
        }



        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('message', 'Profile Deleted');
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
                FileServices::deleteFile($user->avatar);
                $user->avatar = FileServices::upload($request, 'avatar', 'users');
                $user->save();
            }

            return Redirect::route('profile.edit')->with('message', 'Profile picture updated');
        } catch (\Throwable $th) {
            return Redirect::back()->with('message', 'Something went wrong');
        }
    }
}
