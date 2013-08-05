<?php

namespace Rickard2\Luhnar\Validator;

/**
 * Class Validator
 *
 * @package Rickard2\Luhnar\Validator
 */
abstract class Validator
{
    /**
     * @param string $input
     *
     * @return bool
     */
    abstract public function validate($input);
}