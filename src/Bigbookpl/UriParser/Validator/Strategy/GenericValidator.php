<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

class GenericValidator extends AbstractValidator
{
    public function __construct()
    {
        $this->scheme = self::GENERIC;
    }

    protected function getPattern(): string
    {
        return <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?'authority'(?:((?'userinfo'[[:alnum:]]+(:\S+)?)@))?(?'host'[[:alnum:].-]+)(?:(:(?'port'[1-9][0-9]{0,4})))?))?(?:(?'path'\/[\/[[:alnum:]@&=+$.,;\/]*))?(?:(\?(?'query'[[:alnum:];\/?@&=+$,%\-!*'()]*)))?(?:(#(?'fragment'[[:alnum:];\/?@&=+$,%\-!*'()]+)))?$/
REGEX;
    }
}