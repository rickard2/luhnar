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
        $data = json_decode(file_get_contents(dirname(__FILE__) . '/sweden.json'));

        return array_map(
            function ($item) {
                return array($item->value, $item->expected, $item->message);
            },
            $data
        );
    }
}