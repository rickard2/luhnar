<?php

namespace Rickard2\Luhnar\Tests;

use PHPUnit_Framework_TestCase;
use Rickard2\Luhnar\Validator;

class ValidatorTest extends PHPUnit_FrameWork_TestCase
{
    /**
     * @dataProvider provider
     */
    public function testValidator($input, $country, $expected, $description)
    {
        $validator = new Validator();

        $this->assertEquals($expected, $validator->validate($input, $country), $description);
    }

    public function provider()
    {
        return array(
            array('9909193766', 'se', true, 'Valid swedish, lowercase country'),
            array('9909193776', 'se', false, 'Invalid swedish, lowercase country'),
            array('clearly invalid', 'se', false, 'Clearly invalid swedish, lowercase country'),
            array('010203-306W', 'fi', true, 'Valid finnish, lowercase country'),
            array('010204-306W', 'fi', false, 'Invalid finnish, lowercase country'),
            array('clearly invalid', 'fi', false, 'Clearly invalid finnish, lowercase country'),
            array('9909193766', 'SE', true, 'Valid swedish, uppercase country'),
            array('9909193776', 'SE', false, 'Invalid swedish, uppercase country'),
            array('clearly invalid', 'SE', false, 'Clearly invalid swedish, uppercase country'),
            array('010203-306W', 'FI', true, 'Valid finnish, uppercase country'),
            array('010204-306W', 'FI', false, 'Invalid finnish, uppercase country'),
            array('clearly invalid', 'FI', false, 'Clearly invalid finnish, uppercase country'),
        );
    }

    /**
     * @expectedException \Exception
     */
    public function testInvalidCountry()
    {
        $validator = new Validator();
        $validator->validate('whatever', 'us');
    }
}