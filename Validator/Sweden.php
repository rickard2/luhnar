<?php

namespace Rickard2\Luhnar\Validator;

/**
 * Class Sweden
 *
 * @package Rickard2\Luhnar\Validator
 */
class Sweden extends Validator
{
    /**
     * @param string $input
     *
     * @return bool
     */
    public function validate($input)
    {
        switch (strlen($input)) {
            // YYMMDDAABB
            case 10:
                $parsed = $input;
                break;

            case 11: // YYMMDD[-+]AABB
                $parsed = str_replace(array('-', '+'), '', $input);
                break;

            // YYYYMMDDAABB
            case 12:
                $parsed = substr($input, 2);
                break;

            case 13: // YYYYYYMMDD[-+]AABB
                $parsed = substr($input, 2);
                $parsed = str_replace(array('-', '+'), '', $parsed);
                break;

            default:
                return false;
        }

        if (!preg_match('/^\d+$/', $parsed)) {
            return false;
        }

        // Use DateTime to parse the date and see if it changes
        $date     = substr($parsed, 0, 6);
        $dateTime = \DateTime::createFromFormat('ymd', $date);

        // If it changes, it wasn't a valid date (since 991232 will yield 000101)
        if ($dateTime->format('ymd') !== $date) {
            return false;
        }

        // Get check number
        $check  = intval(substr($parsed, -1, 1));
        $parsed = substr($parsed, 0, 9);

        $result = 0;

        // Calculate check number
        for ($i = 0; $i < strlen($parsed); $i++) {

            if (($i % 2) == 0) {
                $number = intval($parsed[$i] * 2);
            } else {
                $number = intval($parsed[$i]);
            }

            if ($number > 9) {
                $result += (1 + ($number % 10));
            } else {
                $result += $number;
            }
        }

        return ((($check + $result) % 10) == 0);
    }
}
