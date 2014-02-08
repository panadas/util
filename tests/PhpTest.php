<?php
namespace Panadas\Util;

class PhpTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Panadas\Util\Php::isIterable()
     * @covers Panadas\Util\Php::makeIterable()
     * @dataProvider isIterableProvider
     */
    public function testMakeIterable($var, $expected)
    {
        $this->assertEquals($expected, Php::makeIterable($var));
    }

    /**
     * @return array
     */
    public function isIterableProvider()
    {
        $resource = socket_create(AF_INET, SOCK_STREAM, 0);
        $stdClass = new \stdClass();
        $splStack = new \SplStack();

        return [
            [true, [true]],
            ["foo", ["foo"]],
            [123, [123]],
            [1.23, [1.23]],
            [[], []],
            [$resource, [$resource]],
            [$stdClass, [$stdClass]],
            [$splStack, $splStack],
            [null, []]
        ];
    }

    /**
     * @covers Panadas\Util\Php::toString()
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
            [socket_create(AF_INET, SOCK_STREAM, 0), "resource(Socket)"],
            [new \stdClass(), "object(stdClass)"],
            [null, "null"]
        ];
    }

}
