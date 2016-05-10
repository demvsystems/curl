<?php

namespace Client\Header;

/**
 * Class Header
 * @package Client\Header
 */
class Header implements HeaderInterface
{
    const HEADER = '%s: %s';

    /**
     * @var null|string
     */
    private $_header = null;
    /**
     * @var array
     */
    private $_content = [];

    /**
     * Header constructor.
     *
     * @param string $header
     * @param string $value
     */
    public function __construct(string $header, string $value)
    {
        $this->_header = $header;

        $this->concat($value);
    }

    /**
     * @return null|string
     */
    public function getHeader()
    {
        return $this->_header;
    }

    /**
     * @param $content
     *
     * @throws \Exception
     */
    public final function setContent($content)
    {
        if (is_array($content)) {
            $this->_content = $content;
        } else if (is_string($content)) {
            $this->_content = explode(';', $content);
        } else {
            throw new \Exception('Expected array or string');
        }
    }

    /**
     * @param string $value
     */
    public final function concat(string $value)
    {
        $this->_content[] = $value;
    }

    /**
     * @return string
     */
    public final function getContent()
    {
        return $this->_content;
    }

    /**
     * @return string
     */
    public function provide()
    {
        return sprintf(self::HEADER, $this->getHeader(), implode(';', $this->getContent()));
    }
}