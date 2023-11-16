<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'sometimes|required|string|max:255',
            'bio' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'avatar' => 'sometimes|required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}