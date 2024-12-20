<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|min:4|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                function ($attribute, $value, $fail) {
                    $parts = explode('@', $value);
                    if (count($parts) > 1 && strlen($parts[0]) < 6) {
                        $fail('The email must have at least 6 characters before the "@" symbol.');
                    }
                },
            ],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'digits_between:1,15'],
            'rfc' => ['required', 'min:13', 'max:13'],
            'birthdate' => 'required|date|before_or_equal:' . now()->toDateString(),
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'rfc' => $request->rfc,
            'role_id' => $request->role,
            'birthdate' => $request->birthdate,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('dashboard');
    }
}
