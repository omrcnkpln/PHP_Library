<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class OriginAndDestRule implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $value = strtoupper($value);
        $valueLength = strlen($value);

        if ($valueLength == 3) {
        }else{
            if($valueLength == 4){
                $lastLetter = substr($value, -1);

                if($lastLetter === "S"){
                }else{
                    $fail('The :attribute format not correct with this length.');
                }
            }else{
                $fail('The :attribute length not correct.');
            }
        }
    }
}
