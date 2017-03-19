<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;

class URNParser extends AbstractParser
{
    private $scheme = "urn";

    protected function getParsedURI($matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setPath($matches['path'])
            ->setScheme($matches['scheme']);

        return $parsed;
    }

    protected function getPattern(): string
    {
        return '/^(?\'scheme\'urn):(?\'path\'(?:[[:alnum:]][[:alnum:]-]{1,31}):(?:[[:alnum:]()+,-.:=@%;$_!*\']+))/';
    }

    public function getScheme()
    {
        return $this->scheme;
    }
}