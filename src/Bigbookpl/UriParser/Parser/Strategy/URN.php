<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;
use Bigbookpl\UriParser\Parser\ParserException;

class URN extends AbstractParser
{

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
}