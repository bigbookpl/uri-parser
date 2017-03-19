<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

class GenericValidator extends AbstractValidator
{
    protected function getPattern(): string
    {
        return <<<REGEX
/^(?'scheme'[[:alpha:]]+[[:alnum:]\+-\.]*?):(?:(\/{2})?(?:((?'userinfo'[a-z]+:?[a-z]+)@))?(?'host'[a-z.-]+)(?:(:(?'port'[0-9]{1,5})))?)?(?:(?'path'\/[\/\w.-]*))?(?:(\?(?'query'[=&\w]*)))?(?:(#(?'fragment'.+)))?$/
REGEX;
    }
}