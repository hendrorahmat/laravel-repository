<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateCouponRequest extends FormRequest
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
			'phone_number' => 'required|min:5',
			'email' => 'required|email',
			'products' => 'required|array',
			'products.*.product_id' => 'required|exists:product,product_id',
			'coupon_code' => 'required|exists:coupon,coupon_code',
			'products.*.quantity' => 'required|integer|min:1|numeric',
		];
	}
}
