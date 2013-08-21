<?php

namespace Rickard2\Luhnar\Tests\Validator;

use Rickard2\Luhnar\Validator\Finland;

class FinlandTest extends \PHPUnit_Framework_TestCase
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
        $validator = new Finland();
        $this->assertEquals($expected, $validator->validate($input), $description);
    }

    public function provider()
    {
        return array(
            array('311280+999J', true, '11 digit valid, 19th century'),
            array('311280-999J', true, '11 digit valid, 20th century'),
            array('311280A999J', true, '11 digit valid, 21st century'),
            array('311280+999j', true, '11 digit valid, 19th century, lowercase'),
            array('311280-999j', true, '11 digit valid, 20th century, lowercase'),
            array('311280a999j', true, '11 digit valid, 21st century, lowercase'),
            array('311280+999F', false, '11 digit invalid, 19th century'),
            array('311280-999F', false, '11 digit invalid, 20th century'),
            array('311280A999F', false, '11 digit invalid, 21st century'),
            array('311280+999f', false, '11 digit invalid, 19th century, lowercase'),
            array('311280-999f', false, '11 digit invalid, 20th century, lowercase'),
            array('311280a999f', false, '11 digit invalid, 21st century, lowercase'),
        );
    }
}