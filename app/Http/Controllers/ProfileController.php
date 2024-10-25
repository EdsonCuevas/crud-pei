<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $user = $request->user(); // Obtenemos el usuario autenticado
        $role = $user->role->id; // Obtenemos el nombre del rol (ajusta si usas una estructura diferente)

        switch ($role) {
            case 1:
                return Inertia::render('Profile/EditAdmin', [
                    'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);

            case 2:
                return Inertia::render('Profile/EditCoordi', [
                    'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);

            case 3:
                return Inertia::render('Profile/EditVolunt', [
                    'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);

            case 4:
                return Inertia::render('Profile/EditDonor', [
                    'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);

            case 5:
                return Inertia::render('Profile/EditBenef', [
                    'mustVerifyEmail' => $user instanceof MustVerifyEmail,
                    'status' => session('status'),
                ]);
        }
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {

            // Elimina la imagen anterior si existe
            if ($user->photo && Storage::exists('public/img/profile/' . $user->photo)) {
                Storage::delete('public/img/profile/' . $user->photo);
            }

            $image = $request->image;
            $imgName = rand() . '_' . $image->getClientOriginalName();
            $request->file('image')->storeAs('public/img/profile', $imgName);
            $path = $imgName;
            $user->photo = $path;
        }

        $request->user()->save();
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
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
