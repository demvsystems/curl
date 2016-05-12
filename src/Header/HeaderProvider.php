<?php

namespace Demv\Curl\Header;

/**
 * Class HeaderProvider
 * @package Client\Header
 */
final class HeaderProvider implements HeaderInterface
{
    /**
     * @var array
     */
    private $_header = [];

    /**
     * @param string $type
     *
     * @return Content
     */
    public function setContent(string $type)
    {
        $this->_header['content'] = new Content($type);

        return $this->_header['content'];
    }

    /**
     * @param string $agent
     *
     * @return Header
     */
    public function setAgent(string $agent)
    {
        $this->_header['agent'] = new Header('User-Agent', $agent);

        return $this->_header['agent'];
    }

    /**
     * @param int $length
     *
     * @return Header
     */
    public function setLength(int $length)
    {
        $this->_header['length'] = new Header('Content-Length', $length);

        return $this->_header['length'];
    }

    /**
     * @param string $header
     *
     * @return null|Header
     */
    public function getHeader(string $header)
    {
        if (array_key_exists($header, $this->_header)) {
            return $this->_header[$header];
        }

        return null;
    }

    /**
     * @param string $header
     * @param string $value
     *
     * @return Header
     */
    public function setHeader(string $header, string $value)
    {
        $result = $this->getHeader($header);
        if ($result !== null) {
            $result->setContent($value);
        } else {
            $result = new Header($header, $value);

            $this->_header[$header] = $result;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function provide()
    {
        $output = [];
        foreach ($this->_header as $header) {
            $output[] = $header->provide();
        }

        return $output;
    }
}
