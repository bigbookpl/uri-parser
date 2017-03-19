<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;

class Generic extends AbstractParser
{
    protected function getParsedURI($matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setScheme($matches['scheme'])
            ->setUserInformation($matches['userinfo'])
            ->setHost($matches['host'])
            ->setPort($matches['port'])
            ->setPath($matches['path'])
            ->setQuery($matches['query'])
            ->setFragment($matches['fragment']);

        return $parsed;
    }

    protected function getPattern(): string
    {
        return <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?:((?'userinfo'[a-z]+:?[a-z]+)@))?(?'host'[a-z.-]+)(?:(:(?'port'[0-9]{1,5})))?)?(?:(?'path'\/[\/\w.-]*))?(?:(\?(?'query'[=&\w]*)))?(?:(#(?'fragment'.+)))?$/
REGEX;
    }
}