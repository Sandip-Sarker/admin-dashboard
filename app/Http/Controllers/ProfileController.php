<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        return view('profile.edit', [
            'user' => $request->user(),
            'title' => 'Edit Profile',
        ]);
    }

    /**
     * Update the user's profile information.
     */
//    public function update(ProfileUpdateRequest $request): RedirectResponse
//    {
//        $request->user()->fill($request->validated());
//
//        if ($request->user()->isDirty('email')) {
//            $request->user()->email_verified_at = null;
//        }
//
//        $request->user()->save();
//
//        return Redirect::route('profile.edit')->with('status', 'profile-updated');
//    }

    public function update(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            $user = auth()->user();

            if (!$user) {
                return back()->with( 'error', 'User with this email does not exist.');
            }
            $user->name                 = $request->name;
            $user->email                = $request->email;

            if (!empty($request->password )) {
                $user->password = bcrypt($request->password );
            }
            if ($request->hasFile('avatar')) {

                // delete old image
                if ($user->avatar && File::exists(public_path($user->avatar))) {
                    File::delete(public_path($user->avatar));
                }

                $file = $request->file('avatar');
                $fileName = 'user-profile_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/user-profile'), $fileName);

                $user->avatar = 'uploads/user-profile/' . $fileName;
            }
            $user->save();

            return back()->with('success', 'User updated successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again'.$e->getMessage());
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
