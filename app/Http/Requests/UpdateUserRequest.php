<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('edit-other-users');
    }

    public function prepareForValidation()
    {
        $this->merge([
            'role_id' => $this->role,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/i', 'max:100'],
            'email' => 'required|email|max:200',
            'password' => 'min:8|max:32',
            'profile_image' => 'nullable|image|file|mimes:jpg,jpeg,png,webp,bmp|max:4096',
            'role_id' => 'numeric|min:1'
        ];
    }
}
