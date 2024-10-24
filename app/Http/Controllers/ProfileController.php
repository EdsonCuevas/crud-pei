<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;

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
        
        dd($request);
        $request->user()->fill($request->validated());


        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        return Redirect::route('profile.edit');
    }


    public function updatePhoto(Request $request)
    {
        // Validar que el archivo de imagen esté presente
        $request->validate([
            'photo' => ['required','image','mimes:jpeg,png,jpg','max:2048'],  // Reglas de validación para la imagen
        ]);
    
        // Obtener el usuario autenticado
        $user = User::find($request->id);
    
        // Verificar si se subió una nueva imagen
        if ($request->hasFile('photo')) {
            // Eliminar la imagen anterior si existe
            if ($user->photo) {
                Storage::disk('public')->delete('img/' . $user->photo);
            }
    
            // Generar un nombre único para la imagen usando microtime
            $imgName = microtime(true) . '.' . $request->file('photo')->getClientOriginalExtension();
    
            // Almacenar la nueva imagen en la carpeta 'public/img'
            $request->file('photo')->storeAs('public/img', $imgName);
    
            // Actualizar el campo 'photo' en la base de datos
            $user->photo = $imgName;
            $user->save();
        }
    
        // Redirigir al formulario de edición del perfil con un mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'Photo updated successfully.');
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