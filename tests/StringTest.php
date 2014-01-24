<?php
namespace Panadas\Util;

class StringTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers String::startsWith()
     */
    public function testStartsWith()
    {
        $this->assertTrue(String::startsWith("foo", "foobar"));
        $this->assertFalse(String::startsWith("bar", "foobar"));
    }

    /**
     * @covers String::endsWith()
     */
    public function testEndsWith()
    {
        $this->assertTrue(String::endsWith("bar", "foobar"));
        $this->assertFalse(String::endsWith("foo", "foobar"));
    }

    /**
     * @covers String::random()
     */
    public function testRandom()
    {
        $this->assertNotEquals(String::random(1), String::random(1));
        $this->assertEquals(10, mb_strlen(String::random(10)));
    }

}
