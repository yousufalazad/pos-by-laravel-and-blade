<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductInRequest extends FormRequest
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
            'supplier_id' => 'required',
            'product_id' => 'required',
            'in_quantity' => 'required',
            'in_unit_price' => 'required',
            'in_total_amount' => 'nullable',
            'in_discount_amount' => 'nullable',
            'date' => 'nullable',
        ];
    }
}
