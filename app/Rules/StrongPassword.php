<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StrongPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /*
        Passwords will contain at least 1 upper case letter
        Passwords will contain at least 1 lower case letter
        Passwords will contain at least 1 number or special character
        Passwords will contain at least 8 characters in length
        Password maximum length should not be arbitrarily limited
        */
        return preg_match('/(?=^.{8,12}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be strong and must have at least from 8 to 12 characters, 1 upper case, 1 lower case, 1 special character (!@$&*), 2 numerals (0-9).';
    }
}
