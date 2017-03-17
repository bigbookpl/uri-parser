<?php
namespace Bigbookpl\UriParser\Parser;

class URN implements Parser
{

    private $uri;

    public function getParsed(): ParsedURI
    {
        $matches = array();
        if (!$this->parseURN($matches))
        {
            throw new ParserException();
        }

        return $this->getParsedURI($matches);
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @param $matches
     * @return int
     */
    protected function parseURN(&$matches): int
    {
        return preg_match('/^(?\'scheme\'urn):(?\'path\'(?:[[:alnum:]][[:alnum:]-]{1,31}):(?:[[:alnum:]()+,-.:=@%;$_!*\']+))/', $this->uri, $matches);
    }

    /**
     * @param $matches
     * @return ParsedURI
     */
    protected function getParsedURI($matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setPath($matches['path'])
               ->setScheme($matches['scheme']);

        return $parsed;
    }
}