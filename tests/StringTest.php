<?php
namespace Panadas\Util;

class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Panadas\Util\String::mask()
     */
    public function testMask()
    {
        $this->assertEquals("******", String::mask("foobar"));
        $this->assertEquals("f*******r", String::mask("fooobaaar", true));
        $this->assertEquals("••••••", String::mask("foobar", false, "•", "UTF-8"));
    }

    /**
     * @covers Panadas\Util\String::mask()
     * @expectedException \InvalidArgumentException
     */
    public function testMaskInvalidCharacterLength()
    {
        String::mask("foobar", false, "foo");
    }

    /**
     * @covers Panadas\Util\String::mbLcfirst()
     * @dataProvider mbLcfirstProvider
     */
    public function testMbLcfirst($string, $encoding, $expected)
    {
        $this->assertEquals($expected, String::mbLcFirst($string, $encoding));
    }

    /**
     * @return array
     */
    public function mbLcfirstProvider()
    {
        return [
            ["", null, ""],
            ["FOOBAR", "UTF-8", "fOOBAR"],
            ["ƑOOBAR", "UTF-8", "ƒOOBAR"]
        ];
    }

    /**
     * @covers Panadas\Util\String::mbUcfirst()
     * @dataProvider mbUcfirstProvider
     */
    public function testMbUcfirst($string, $encoding, $expected)
    {
        $this->assertEquals($expected, String::mbUcFirst($string, $encoding));
    }

    /**
     * @return array
     */
    public function mbUcfirstProvider()
    {
        return [
            ["", null, ""],
            ["foobar", "UTF-8", "Foobar"],
            ["ƒoobar", "UTF-8", "Ƒoobar"]
        ];
    }

    /**
     * @covers Panadas\Util\String::Camel()
     * @dataProvider camelProvider
     */
    public function testCamel($string, $encoding, $expected)
    {
        $this->assertEquals($expected, String::camel($string, $encoding));
    }

    /**
     * @return array
     */
    public function camelProvider()
    {
        return [
            ["foo bar", null, "fooBar"],
            ["foo bar", "UTF-8", "fooBar"],
            ["FOO BAR", "UTF-8", "fooBar"],
            ["foo-bar", "UTF-8", "fooBar"],
            ["foo_bar", "UTF-8", "fooBar"],
            ["foo1bar", "UTF-8", "foo1bar"],
        ];
    }

    /**
     * @covers Panadas\Util\String::startsWith()
     */
    public function testStartsWith()
    {
        $this->assertTrue(String::startsWith("foo", "foobar"));
        $this->assertFalse(String::startsWith("bar", "foobar"));
    }

    /**
     * @covers Panadas\Util\String::endsWith()
     */
    public function testEndsWith()
    {
        $this->assertTrue(String::endsWith("bar", "foobar"));
        $this->assertFalse(String::endsWith("foo", "foobar"));
    }

    /**
     * @covers Panadas\Util\String::random()
     */
    public function testRandom()
    {
        $this->assertNotEquals(String::random(10), String::random(10));
        $this->assertEquals(10, mb_strlen(String::random(10)));
    }
}
