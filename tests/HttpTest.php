<?php
namespace Panadas\Util;

class HttpTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Panadas\Util\Http::getStatusCodes()
     */
    public function testGetStatusCodes()
    {
        $this->assertContains(200, Http::getStatusCodes());
    }

    /**
     * @covers Panadas\Util\Http::hasStatusCode()
     */
    public function testHasStatusCodes()
    {
        $this->assertTrue(Http::hasStatusCode(200));
        $this->assertFalse(Http::hasStatusCode(0));
    }

    /**
     * @covers Panadas\Util\Http::getStatusMessageFromCode()
     */
    public function testGetStatusMessageFromCode()
    {
        $this->assertEquals("OK", Http::getStatusMessageFromCode(200));
        $this->assertNull(Http::getStatusMessageFromCode(0));
    }

    /**
     * @covers Panadas\Util\Http::getPhpHeaderName()
     * @dataProvider getPhpHeaderNameProvider
     */
    public function testGetPhpHeaderName($header, $expected)
    {
        $this->assertEquals($expected, Http::getPhpHeaderName($header));
    }

    /**
     * @return array
     */
    public function getPhpHeaderNameProvider()
    {
        return [
	        ["foo bar", "HTTP_FOO_BAR"],
	        ["x-foo-bar", "HTTP_X_FOO_BAR"]
        ];
    }


}
