<?php

namespace Rickard2\Luhnar\Tests\Validator;

use Rickard2\Luhnar\Validator\Sweden;

class SwedenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $input
     * @param bool   $expected
     * @param string $description
     *
     * @dataProvider provider
     */
    public function testValidate($input, $expected, $description)
    {
        $validator = new Sweden();
        $this->assertEquals($expected, $validator->validate($input), $description);
    }

    public function provider()
    {
        return array(
            array('9909193766', true, '10 digit valid'),
            array('9909193776', false, '10 digit invalid'),
            array('990919-3766', true, '11 digit valid'),
            array('990919-3776', false, '11 digit invalid'),
            array('199909193766', true, '12 digit valid'),
            array('199909193776', false, '12 digit invalid'),
            array('19990919-3766', true, '13 digit valid'),
            array('19990919-3776', false, '13 digit invalid'),
            array('Random crap', false, 'random crap'),
        );
    }
}