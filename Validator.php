<?php

namespace Rickard2\Luhnar;

use Exception;

/**
 * Class Validator
 *
 * @package Rickard2\Luhnar
 */
class Validator
{
    /**
     * @var array
     */
    protected $countryClassMap = array(
        'se' => '\Rickard2\Luhnar\Validator\Sweden',
        'fi' => '\Rickard2\Luhnar\Validator\Finland',
        'nl' => '\Richard2\Luhnar\Validator\Netherlands',
    );

    /**
     * @param string $input
     * @param string $country
     *
     * @return bool
     * @throws \Exception
     */
    public function validate($input, $country)
    {
        $country = trim(strtolower($country));

        if (!$this->supportsCountry($country)) {
            throw new Exception('Unsupported country: ' . $country);
        }

        /** @var \Rickard2\Luhnar\Validator\Validator $validator */
        $validator = new $this->countryClassMap[$country];

        return $validator->validate($input);
    }

    /**
     * @param string $country
     *
     * @return bool
     */
    protected function supportsCountry($country)
    {
        return array_key_exists($country, $this->countryClassMap);
    }
}