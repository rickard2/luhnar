<?php

namespace Rickard2\Luhnar\Validator;

/**
 * Class Finland
 *
 * @package Rickard2\Luhnar\Validator
 */
class Finland extends Validator
{
    /**
     * @param string $input
     *
     * @return bool
     */
    public function validate($input)
    {
        $checkDigit = explode(',', '0,1,2,3,4,5,6,7,8,9,a,b,c,d,e,f,h,j,k,l,m,n,p,r,s,t,u,v,w,x,y');

        // Get the check digit
        $check = strtolower(substr($input, -1, 1));

        // Remove dash, plus or A
        if (strlen($input) == 11) {
            $input = substr($input, 0, 6) . substr($input, 7, 3);
        } else {
            $input = substr($input, 0, 9);
        }

        if (!preg_match('/^\d+$/', $input)) {
            return false;
        }

        // Do the math
        $result = $input % 31;

        return $checkDigit[$result] == $check;
    }
}