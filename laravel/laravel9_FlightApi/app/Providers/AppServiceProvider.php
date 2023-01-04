<?php

namespace App\Providers;

use App\Validators\SumsTo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('sums_to', SumsTo::class);

        Validator::extend('greater_than_field', function ($attribute, $value, $parameters, $validator) {
            $otherParameters = request()->only($parameters);
            $max_value = array_sum(array_values(array_column($otherParameters, "ADT")));

            if ($value > $max_value) {
                return false;
            }

            return true;
        });

        Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });
    }
}
