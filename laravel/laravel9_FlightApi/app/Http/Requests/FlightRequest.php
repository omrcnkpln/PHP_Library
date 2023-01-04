<?php

namespace App\Http\Requests;

use App\Rules\OriginAndDestRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class FlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
//    public function authorize()
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "origin" => ["required", new OriginAndDestRule],
            "destination" => ["required", new OriginAndDestRule],
            "departure_date" => "required|date_format:Y-m-d|after_or_equal:today",
            "return_date" => ["date_format:Y-m-d","after_or_equal:departure_date"],
            "passengers" => ["array:ADT,CHD,INF"],
            "passengers.ADT" => "required|integer|min:1|max:7|sums_to:7,passengers.CHD",
            "passengers.CHD" => "integer|min:0|max:7|sumsTo:7,passengers.ADT",
            "passengers.INF" => "integer|min:0|greater_than_field:passengers.ADT",
        ];
    }

    public function FailedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'origin.required' => 'Origin is required',
            "sums_to" => 'ADT + CHD must be less than 7',
            "greater_than_field" => ':attribute can not be greater than :field',
        ];
    }
}
