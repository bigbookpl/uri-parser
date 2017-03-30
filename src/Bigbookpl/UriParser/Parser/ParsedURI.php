<?php

namespace Bigbookpl\UriParser\Parser;

use JsonSerializable;

class ParsedURI implements JsonSerializable
{
    private $scheme;
    private $userInformation;
    private $host;
    private $port;
    private $path;
    private $query;
    private $fragment;
    private $authority;

    const EMPTY_STRING = '';

    public function getScheme(): string
    {
        return $this->scheme ?? self::EMPTY_STRING;
    }

    /**
     * @param string $scheme
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
    public function getPath(): string
    {
        return $this->path ?? self::EMPTY_STRING;
    }

    /**
     * @param string $path
     * @return ParsedURI
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $port
     * @return ParsedURI
     */
    public function setPort($port)
    {
        $this->port = $port;
        return $this;
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->port ?? self::EMPTY_STRING;
    }

    /**
     * @return string
     */
    public function getUserInformation(): string
    {
        return $this->userInformation;
    }

    /**
     * @param string $userInformation
     * @return ParsedURI
     */
    public function setUserInformation($userInformation)
    {
        $this->userInformation = $userInformation;
        return $this;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host ?? self::EMPTY_STRING;
    }

    /**
     * @param string $host
     * @return ParsedURI
     */
    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query ?? self::EMPTY_STRING;
    }

    /**
     * @param string $query
     * @return ParsedURI
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getFragment(): string
    {
        return $this->fragment ?? self::EMPTY_STRING;
    }

    /**
     * @param string $fragment
     * @return ParsedURI
     */
    public function setFragment($fragment)
    {
        $this->fragment = $fragment;
        return $this;
    }

    public function getHierarchicalPart(){
        return ( $this->getAuthority() . $this->getPath() )?? self::EMPTY_STRING;
    }

    /**
     * @return mixed
     */
    public function getAuthority()
    {
        return $this->authority;
    }

    /**
     * @param mixed $authority
     * @return $this
     */
    public function setAuthority($authority)
    {
        $this->authority = $authority;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'scheme' => $this->getScheme(),
            'userInformation' => $this->getUserInformation(),
            'host' => $this->getHost(),
            'port' => $this->getPort(),
            'path' => $this->getPath(),
            'query' => $this->getQuery(),
            'fragment' => $this->getFragment(),
            'authority' => $this->getAuthority(),
            'hierarchicalPart' => $this->getHierarchicalPart()
        ];
    }

    public function valueOf(array $matches){

        $this->setScheme($this->getValue('scheme', $matches))
            ->setUserInformation($this->getValue('userinfo', $matches))
            ->setHost($this->getValue('host', $matches))
            ->setPort($this->getValue('port', $matches))
            ->setPath($this->getValue('path', $matches))
            ->setQuery($this->getValue('query', $matches))
            ->setFragment($this->getValue('fragment', $matches))
            ->setAuthority($this->getValue('authority', $matches));

        return $this;
    }

    private function getValue(string $key, array $array, string $default = ''): string
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return $default;
    }
}