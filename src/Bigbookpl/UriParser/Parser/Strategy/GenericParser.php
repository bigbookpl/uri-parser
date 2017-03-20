<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;

class GenericParser extends AbstractParser
{
    protected function getParsedURI($matches): ParsedURI
    {
        $parsed = new ParsedURI();
        $parsed->setScheme($this->getValue('scheme', $matches))
            ->setUserInformation($this->getValue('userinfo', $matches))
            ->setHost($this->getValue('host', $matches))
            ->setPort($this->getValue('port', $matches))
            ->setPath($this->getValue('path', $matches))
            ->setQuery($this->getValue('query', $matches))
            ->setFragment($this->getValue('fragment', $matches))
            ->setAuthority($this->getValue('authority', $matches));

        return $parsed;
    }

    protected function getPattern(): string
    {
        return <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?'authority'(?:((?'userinfo'[a-z]+:?[a-z]+)@))?(?'host'[a-z.-]+)(?:(:(?'port'[0-9]{1,5})))?))?(?:(?'path'\/[\/\w.-]*))?(?:(\?(?'query'[=&\w]*)))?(?:(#(?'fragment'.+)))?$/
REGEX;
    }

    public function getScheme()
    {
        return null;
    }

    private function getValue(string $key, array $array, string $default = ''): string
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return $default;
    }
}