<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:255'],
            'amount' => ['required', 'integer', 'max:255'],
            'all_amount' => ['required', 'integer', 'max:255'],
        ];
    }
}
