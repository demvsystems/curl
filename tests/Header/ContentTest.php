<?php

use Demv\Curl\Header\Content;

class ContentTest extends PHPUnit_Framework_TestCase
{
    protected $type = 'text/xml';
    protected $content = null;

    public function setUp()
    {
        $this->content = new Content($this->type);
    }

    public function testType()
    {
        $type = 'application/pdf';
        $content = $this->content->type($type)->getContent();
        $this->assertCount(2, $content);
        $this->assertEquals('type=' . $type, $content[1]);
    }

    public function testCharset()
    {
        $charset = 'UTF-8';

        $content = $this->content->charset($charset)->getContent();
        $this->assertCount(2, $content);
        $this->assertEquals('charset=' . $charset, $content[1]);
    }
}
