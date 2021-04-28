<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        // if the post is being created, then use the title to generate a slug.
        // if it is an update, then use the existing slug.
        $slug = $this->slug ?? $this->title;
        $this->merge([
            'slug' => Str::slug($slug),
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
            'title' => 'required|max:255',
            'slug' => 'required|max:255|alpha-dash',
            'content' => 'string|nullable|required_unless:save,draft',
            'excerpt' => 'string|nullable',
            'is_featured' => 'boolean',
            'featured_image' => 'nullable|file|image|mimes:jpg,jpeg,png,webp,bmp',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required.',
            'content.required_unless' => 'The post content is required to publish.',
        ];
    }
}
