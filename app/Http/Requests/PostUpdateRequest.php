<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title'             => 'required|max:255',
            'slug'              => 'max:100',
            'meta_description'  => 'max:150',
            'description'       => 'required',
            'is_publish'        => 'required',
            'published_at'      => 'required',
            'category_id'       => 'required',
            'featured_image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Batasan file gambar
        ];
    }
}
