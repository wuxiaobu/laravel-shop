<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id'     => [
                'required',
                Rule::exists('user_addresses', 'id')->where('user_id', Auth::user()->id),
            ],
            'items'  => ['required', 'array'],
            'items.*.amount' => ['required', 'integer', 'min:2'],
        ];
    }

    public function messages()
    {
        return [
            'items.*.amount.min' => 'Amount must be at least 2.',
        ];
    }
}
