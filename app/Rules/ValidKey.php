<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\RegisNumber;


class ValidKey implements Rule
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
        if(count(RegisNumber::where('key', '=', $value)->where('used', '=', '0')->get()) > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Vous n\'avez pas un code d\'enregistrement valide!';
    }
}
