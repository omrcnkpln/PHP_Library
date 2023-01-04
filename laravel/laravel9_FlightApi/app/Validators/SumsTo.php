<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

class SumsTo extends Validator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param $attribute -> Validate edilecek field
     * @param $value -> Validate edilecek field'ın sahip oldugu deger
     * @param $parameters -> Custom Validate Attribute'un parametreleri MVC de oldugu gibi
     * @param $parameters -> Custom Validate Attribute'un parametreleri MVC de oldugu gibi
     * @param $validator -> Laravel Validator Sınıfı
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $expected = floatval(array_shift($parameters));
        $otherParameters = request()->only($parameters);
        $otherValue = array_column($otherParameters, "ADT");

        $sum = floatval(array_sum(array_merge(array_values($otherValue), [$value])));

        if ($sum <= $expected) {
            return true;
        }

        return false;
    }
}
