<?php

use Client\SoapClient;

class SoapClientTest extends PHPUnit_Framework_TestCase
{
    /**
     *
     */
    public function testConstructSoapClient()
    {
        $client = new SoapClient();
        $this->assertTrue($client !== null);
    }
}
