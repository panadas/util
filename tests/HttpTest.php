<?php
namespace Panadas\Util;

class HttpTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Http::getStatusCodes()
     */
    public function testGetStatusCodes()
    {
        $this->assertContains(200, Http::getStatusCodes());
    }

    /**
     * @covers Http::hasStatusCode()
     */
    public function testHasStatusCodes()
    {
        $this->assertTrue(Http::hasStatusCode(200));
        $this->assertFalse(Http::hasStatusCode(0));
    }

    /**
     * @covers Http::getStatusMessageFromCode()
     */
    public function testGetStatusMessageFromCode()
    {
        $this->assertEquals("OK", Http::getStatusMessageFromCode(200));
        $this->assertNull(Http::getStatusMessageFromCode(0));
    }

    /**
     * @covers Http::getPhpHeaderName()
     */
    public function testGetPhpHeaderName()
    {
        $this->assertEquals("HTTP_FOO_BAR", Http::getPhpHeaderName("foo bar"));
        $this->assertEquals("HTTP_X_FOO_BAR", Http::getPhpHeaderName("x-foo-bar"));
    }

}
