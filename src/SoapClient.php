<?php

namespace Demv\Curl;

/**
 * Class SoapClient
 * @package Client
 */
class SoapClient extends Client
{
    /**
     * XOP
     */
    const XOP = 'application/xop+xml';
    /**
     * SOAP (Plain XML)
     */
    const SOAP = 'application/soap+xml';
    /**
     * Default User-Agent
     */
    const DEFAULT_USER_AGENT = 'Mozilla/1.0N (Windows)';

    /**
     * SoapClient constructor.
     *
     * @param string $type
     */
    public function __construct( /*string */$type = '') // TODO: PHP 7

    {
        parent::__construct();

        $this->getHeaderProvider()->setContent($type);
    }

    /**
     * @param string $action
     * @param string $url
     * @param string $data
     *
     * @return mixed|string
     */
    public function submit(string $action, string $url, string $data)
    {
        $this->getHeaderProvider()->setHeader('SOAPAction', $action);
        $this->getHeaderProvider()->setLength(strlen($data));

        return $this->usePost(true)->send($url, $data);
    }
}
