<?php
namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // Dividir la dirección de correo en la parte local y el dominio
                    $parts = explode('@', $value);
                    if (count($parts) > 1 && strlen($parts[0]) < 6) {
                        $fail('The ' . $attribute . ' must have at least 6 characters before the "@" symbol.');
                    }
                },
                Rule::unique('users')->ignore(Auth::user())
            ],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
            'phone' => ['required', 'string'],
            'rfc' => ['string', 'size:12', Rule::unique('users')->ignore(Auth::user())],
            'birthdate' => ['required', 'date', 'before_or_equal:' . now()->toDateString()],
        ];
    }

    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        if ($this->password == null) {
            $this->request->remove('password');
        }
    }
}
