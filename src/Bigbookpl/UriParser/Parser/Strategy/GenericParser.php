<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

class GenericParser extends AbstractParser
{
    public function getScheme(): ?string
    {
        return self::GENERIC;
    }

    protected function getPattern(): string
    {
        return <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?'authority'(?:((?'userinfo'[[:alnum:]]+(:\S+)?)@))?(?'host'[[:alnum:].-]+)(?:(:(?'port'[1-9][0-9]{0,4})))?))?(?:(?'path'\/[\/[[:alnum:]@&=+$.,;\/]*))?(?:(\?(?'query'[[:alnum:];\/?@&=+$,%\-!*'()]*)))?(?:(#(?'fragment'[[:alnum:];\/?@&=+$,%\-!*'()]+)))?$/
REGEX;
    }
}