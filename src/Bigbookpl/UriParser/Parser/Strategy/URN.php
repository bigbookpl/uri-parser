<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;
use Bigbookpl\UriParser\Parser\ParserException;

class URN implements Parser
{
    private $uri;

    private $pattern = '/^(?\'scheme\'urn):(?\'path\'(?:[[:alnum:]][[:alnum:]-]{1,31}):(?:[[:alnum:]()+,-.:=@%;$_!*\']+))/';

    public function getParsed(): ParsedURI
    {
        $matches = $this->parse();

        return $this->getParsedURI($matches);
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    private function parse(): array
    {
        $matches = array();

        if (!preg_match($this->pattern, $this->uri, $matches)) {
            throw new ParserException();
        }

        return $matches;
    }

    private function getParsedURI(array $matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setPath($matches['path'])
            ->setScheme($matches['scheme']);

        return $parsed;
    }
}