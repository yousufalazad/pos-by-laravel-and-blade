<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductOutRequest extends FormRequest
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
            'customer_id' => 'required',
            'product_id' => 'required',
            'out_quantity' => 'required',
            'out_unit_price' => 'nullable',
            'out_ws_unit_price' => 'nullable',
            'out_total_amount' => 'nullable',
            'out_discount_amount' => 'nullable',
            'date' => 'nullable',
        ];
    }
}
