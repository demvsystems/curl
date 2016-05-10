<?php

namespace Client\Header;

/**
 * Class Content
 * @package Client\Header
 */
final class Content extends Header
{
    const CHARSET = '%s;charset=%s';
    const TYPE    = '%s;type=%s';

    /**
     * Content constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        parent::__construct('Content-Type', $type);
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function type(string $type)
    {
        $this->concat('type=' . $type);

        return $this;
    }

    /**
     * @param string $charset
     *
     * @return $this
     */
    public function charset(string $charset)
    {
        $this->concat('charset=' . $charset);

        return $this;
    }
}