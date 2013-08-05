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

            case 11: // YYMMDD-AABB
                $parsed = str_replace('-', '', $input);
                break;

            // YYYYMMDDAABB
            case 12:
                $parsed = substr($input, 2);
                break;

            case 13: // YYYYYYMMDD-AABB
                $parsed = substr($input, 2);
                $parsed = str_replace('-', '', $parsed);
                break;

            default:
                return false;
        }

        if (!preg_match('/^\d+$/', $parsed)) {
            return false;
        }

        // Get check number
        $check  = intval(substr($parsed, -1, 1));
        $parsed = substr($parsed, 0, 9);

        $result = 0;

        // Calculate check number
        for ($i = 0; $i < strlen($parsed); $i++) {

            if (($i % 2) == 0) {
                $tmp = intval($parsed[$i] * 2);
            } else {
                $tmp = intval($parsed[$i]);
            }

            if ($tmp > 9) {
                $result += (1 + ($tmp % 10));
            } else {
                $result += $tmp;
            }
        }

        return ((($check + $result) % 10) == 0);
    }
}