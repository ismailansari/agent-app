<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required|max:100',
            'email'                 => 'email|unique:users',
            'gender'                => 'required',
            'phone'                 => 'required|numeric|unique:users',
            'profile_image'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Batasan file gambar
            'password'              => 'required|min:8',
        ];
    }
}
