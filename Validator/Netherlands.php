<?php

namespace Rickard2\Luhnar\Validator;

/**
 * Netherlands, the | ISO: NL | BurgerServiceNummer BSN
 *
 * @package Rickard2\Luhnar\Validator
 */
class Netherlands extends Validator
{
    /**
     * @param string $input
     *
     * @return bool
     *
     * @author Gerben Geijteman <gerben@hyperized.net>
     */
    public function validate($input)
    {
        /**
         * Validation criteria:
         * - 8 or 9 digits (only numbers!)
         * - Be able to pass the '11 test'
         * - Musn't contain any information.
         *   Cannot implement at this stage, not clear enough defined! Is 1337 information?
         * - Can not be sequential (nummeric)
         * - Is not 900000000 through 999999999 (test numbers)
         *
         * Based on public information: http://nl.wikipedia.org/wiki/Burgerservicenummer
         */

        // Validate: 8 or 9 digits (only numbers!)
        if (strlen($input) < 8 || strlen($input) > 9) {
            return false;
        }

        // Check if they are actually numbers
        // Alternatively, use ctype_digit($input) !
        if (preg_match('/[^0-9]/', $input)) {
            return false;
        }

        // See if the number passes the Eleventest (http://nl.wikipedia.org/wiki/Elfproef)
        if ($this->elevenTest($input)) {
            return false;
        }

        // Check if the numbers are sequential
        // Will not match when sequential numbers are used
        if (preg_match('/\d{5}/u', $input)) {
            return false;
        }

        // Validate if the number is not in the test range!
        return filter_var(
            $input,
            FILTER_VALIDATE_INT,
            array('options' => array('min_range' => '900000000', 'max_range' => '999999999'))
        );
    }

    /**
     * Returns true when the input does not match the test (so invert results!)
     */
    private function elevenTest($input)
    {
        $res      = 0;
        $multiply = strlen($input);
        for ($i = 0; $i < strlen($input); $i++, $multiply--) {
            $res += substr($input, $i, 1) * $multiply;
        }
        return ($res % 11);
    }
}