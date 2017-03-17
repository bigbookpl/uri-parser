<?php

namespace Bigbookpl\UriParser\Parser;

class ParsedURI
{
    private $scheme;
    private $path;
    private $port;

    const EMPTY_STRING = '';

    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * @param mixed $scheme
     * @return ParsedURI
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return ParsedURI
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param mixed $port
     * @return ParsedURI
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPort(): string
    {
        return $this->port ?? self::EMPTY_STRING;
    }


}