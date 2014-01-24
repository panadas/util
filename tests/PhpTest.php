<?php
namespace Panadas\Util;

class PhpTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Php::toString()
     * @dataProvider toStringProvider
     */
    public function testToString($var, $expected)
    {
        $this->assertEquals($expected, Php::toString($var));
    }

    /**
     * @return array
     */
    public function toStringProvider()
    {
        return [
	        [true, "true"],
	        [false, "false"],
	        ["foo", "\"foo\""],
	        [123, 123],
	        [1.23, 1.23],
	        [["foo", "bar"], "array(2)"],
	        [fopen(__FILE__, "r"), "resource(stream)"],
	        [new \stdClass(), "object(stdClass)"],
	        [null, "null"]
        ];
    }

}
