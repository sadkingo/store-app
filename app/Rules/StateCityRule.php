<?php

namespace App\Rules;

use App\Models\City;
use App\Models\State;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class StateCityRule implements ValidationRule
    {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail) : void
        {
        $split = explode('-', $value);

        if (!isset($split[0]) || empty($split[0]))
            {
            $fail("$attribute state can't be empty");
            return;
            }

        if (!isset($split[1]) || empty($split[1]))
            {
            $fail("$attribute city can't be empty");
            return;
            }

        $state = $split[0];
        $city = $split[1];

        State::findOr($state, function () use ($fail, $attribute)
            {
            $fail("$attribute can't be found");
            });
        City::findOr($city, function () use ($fail, $attribute)
            {
            $fail("$attribute can't be found");
            });
        }
    }
