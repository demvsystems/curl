<?php

use Demv\Curl\Header\Header;

class HeaderTest extends PHPUnit_Framework_TestCase
{
    protected $headerStr = 'Connection';
    protected $value     = 'Keep-Alive';
    protected $header    = null;

    public function setUp()
    {
        $this->header = new Header($this->headerStr, $this->value);
    }

    public function testGetHeader()
    {
        $this->assertEquals($this->headerStr, $this->header->getHeader());
    }

    public function testGetContent()
    {
        $content = $this->header->getContent();
        $this->assertCount(1, $content);
        $this->assertEquals($this->value, $content[0]);
    }

    public function testConcat()
    {
        $anotherValue = 'value';
        $this->header->concat($anotherValue);
        $content = $this->header->getContent();
        $this->assertCount(2, $content);
        $this->assertEquals($anotherValue, $content[1]);
    }

    public function testSetContentWithArray()
    {
        $newContent = ['value1', 'value2', 'value3'];
        $this->header->setContent($newContent);
        $content = $this->header->getContent();
        $this->assertEquals($newContent, $content);
    }

    public function testSetContentWithString()
    {
        $newContent     = 'text/xml;charset=UTF-8';
        $expectedResult = ['text/xml', 'charset=UTF-8'];
        $this->header->setContent($newContent);
        $content = $this->header->getContent();
        $this->assertEquals($expectedResult, $content);
    }

    /**
     * @expectedException Exception
     */
    public function testSetContentWithInvalidInput()
    {
        $invalidContent = 5;
        $this->header->setContent($invalidContent);
    }

    public function testProvide()
    {
        $expected = 'Connection: Keep-Alive;Keep-Dead';
        $this->header->concat('Keep-Dead');
        $this->assertEquals($expected, $this->header->provide());
    }
}
