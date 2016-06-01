<?php

use Demv\Curl\Header\Content;
use Demv\Curl\Header\Header;
use Demv\Curl\Header\HeaderProvider;

class HeaderProviderTest extends PHPUnit_Framework_TestCase
{
    protected $hp = null;

    public function setUp()
    {
        $this->hp = new HeaderProvider();
    }

    public function testSetContent()
    {
        $type    = 'text/xml';
        $content = $this->hp->setContent($type);
        $this->assertInstanceOf(Content::class, $content);
        $this->assertCount(1, $content->getContent());
        $this->assertEquals($type, $content->getContent()[0]);
    }

    public function testSetAgent()
    {
        $agent  = 'Apache-HttpClient/4.1.1';
        $header = $this->hp->setAgent($agent);
        $this->assertInstanceOf(Header::class, $header);
        $this->assertCount(1, $header->getContent());
        $this->assertEquals($agent, $header->getContent()[0]);

        return $this->hp;
    }

    public function testSetLength()
    {
        $length = 1512;
        $header = $this->hp->setLength($length);
        $this->assertInstanceOf(Header::class, $header);
        $this->assertCount(1, $header->getContent());
        $this->assertEquals($length, $header->getContent()[0]);
    }

    public function testSetNewHeader()
    {
        $headerStr = 'Connection';
        $value     = 'Keep-Alive';
        $header    = $this->hp->setHeader($headerStr, $value);

        $this->assertInstanceOf(Header::class, $header);
        $this->assertCount(1, $header->getContent());
        $this->assertEquals($value, $header->getContent()[0]);
    }

    /**
     * @depends testSetAgent
     */
    public function testOverideExistingHeader(HeaderProvider $hp)
    {
        $headerStr = 'Agent';
        $value     = 'Another Agent';
        $header    = $hp->setHeader($headerStr, $value);

        $this->assertInstanceOf(Header::class, $header);
        $this->assertCount(1, $header->getContent());
        $this->assertEquals($value, $header->getContent()[0]);
    }

    public function testGetHeaderExisting()
    {
        $agent  = 'Apache-HttpClient/4.1.1';
        $this->hp->setAgent($agent);
        $header = $this->hp->getHeader('agent');

        $this->assertInstanceOf(Header::class, $header);
        $this->assertCount(1, $header->getContent());
        $this->assertEquals($agent, $header->getContent()[0]);
    }

    public function testGetHeaderNonExistent()
    {
        $header = $this->hp->getHeader('none');
        $this->assertNull($header);
    }

    public function testProvide()
    {
        $agent  = 'Apache-HttpClient/4.1.1';
        $header = $this->hp->setAgent($agent);

        $length = 1024;
        $header = $this->hp->setLength($length);

        $output = $this->hp->provide();
        $this->assertCount(2, $output);
        $this->assertEquals('User-Agent: ' . $agent, $output[0]);
        $this->assertEquals('Content-Length: ' . $length, $output[1]);
    }
}
