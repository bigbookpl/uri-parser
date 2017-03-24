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
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?'authority'(?:((?'userinfo'[[:alnum:]]+(:\S+)?)@))?(?'host'[[:alnum:].-]+)(?:(:(?'port'[1-9][0-9]{0,4})))?))?(?:(?'path'\/[\/[[:alnum:]@&=+$.,;\/]*))?(?:(\?(?'query'[[:alnum:];\/?@&=+$,%\-!*'()]*)))?(?:(#(?'fragment'[[:alnum:];\/?@&=+$,%\-!*'()]+)))?$/
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