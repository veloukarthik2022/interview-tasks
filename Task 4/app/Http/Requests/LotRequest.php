<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\Validator;

class LotRequest extends FormRequest
{
    // protected $redirect = false;
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
            //
            "company"=>"required",
            "lot_name"=>"required|unique:lots",
            "product_name"=>"required",
            "weight"=>"required|numeric|min:5|max:1000",
            "country"=>"required",
            "harvest_date"=>"required",
            "expiry_date"=>"required"
        ];
    }

    public function messages()
    {
        return [
            "company.required"=>"The company is required",
        ];
    }

    protected function failedValidation(ValidationValidator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
    
}
