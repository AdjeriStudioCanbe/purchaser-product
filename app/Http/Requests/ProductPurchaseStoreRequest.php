<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductPurchaseStoreRequest extends FormRequest
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
            'purchaser_id' => 'required|exists:purchasers,id',
            'product_id' => 'required|exists:products,id',
            'purchase_timestamp' => 'required|numeric|min:1',
        ];
    }
}
