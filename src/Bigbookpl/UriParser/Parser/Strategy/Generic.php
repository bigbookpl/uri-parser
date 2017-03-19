<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;
use Bigbookpl\UriParser\Parser\ParserException;

class Generic implements Parser
{
    private $uri;
    private $pattern = <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?:((?'userinfo'[a-z]+:?[a-z]+)@))?(?'host'[a-z.-]+)(?:(:(?'port'[0-9]{1,5})))?)?(?:(?'path'\/[\/\w.-]*))?(?:(\?(?'query'[=&\w]*)))?(?:(#(?'fragment'.+)))?$/
REGEX;


    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getParsed(): ParsedURI
    {
        $matches = array();
        if (!$this->parse($matches))
        {
            throw new ParserException();
        }

        return $this->getParsedURI($matches);
    }

    private function parse(&$matches): int
    {
        return preg_match($this->pattern, $this->uri, $matches);
    }

    private function getParsedURI($matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setScheme($matches['scheme'])
               ->setUserInformation($matches['userinfo'])
               ->setHost($matches['host'])
               ->setPort($matches['port'])
               ->setPath($matches['path'])
               ->setQuery($matches['query'])
               ->setFragment($matches['fragment'])
        ;

        return $parsed;
    }
}