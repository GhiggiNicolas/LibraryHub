<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:800',
            'pages' => 'nullable|integer|min:1',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array
     */
    public function messages() : array
    {
        return [
            'title.required' => 'The title of the book is required.',
            'title.max' => 'The title cannot exceed 255 characters.',
            'description.max' => 'The description cannot exceed 800 characters.',
            'pages.integer' => 'The number of pages must be an integer.',
            'pages.min' => 'The number of pages must be at least 1.',
            'author_id.required' => 'The author of the book is required.',
            'author_id.exists' => 'The selected author does not exist.',
            'category_id.required' => 'The category of the book is required.',
            'category_id.exists' => 'The selected category does not exist.',
            'image.image' => 'The file must be a valid image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png, gif.',
            'image.max' => 'The image must not exceed 2MB.',
        ];
    }
}
