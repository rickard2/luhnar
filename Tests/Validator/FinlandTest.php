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
        $data = json_decode(file_get_contents(dirname(__FILE__) . '/finland.json'));

        return array_map(
            function ($item) {
                return array($item->value, $item->expected, $item->message);
            },
            $data
        );
    }
}