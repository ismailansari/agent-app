<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name'                  => 'required|max:100|unique:users,name,' . $this->user->id,
            'gender'                => 'nullable',
            'email'                 => 'email|unique:users,email,' . $this->user->id,
            'phone'                 => 'nullable|numeric|unique:users,phone,' . $this->user->id,
            'profile_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Batasan file gambar
            'password'              => 'nullable|min:8',
        ];
    }
}
