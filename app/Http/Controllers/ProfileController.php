<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Get the validated user object
        $user = $request->user();

        // Fill the user model with validated data (name, email)
        $user->fill($request->validated());

        // If the user's email has changed, reset the verification date
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // --- NEW: HANDLE AVATAR UPLOAD ---
        if ($request->hasFile('avatar')) {
            // If an old avatar exists, delete it
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            // Store the new avatar and update the user's avatar path
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        // --- END OF NEW LOGIC ---

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
