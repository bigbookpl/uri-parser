<?php

namespace Bigbookpl\UriParser\Validators;


class Urn implements Validator
{

    private $uri;

    const SCHEMA = 'urn';

    public function __construct()
    {
    }

    public function validate(): bool
    {
        if (preg_match('/^urn:(([[:alnum:]][[:alnum:]-]{1,31}):([[:alnum:]()+,-.:=@%;$_!*\']+))/',$this->uri)){
            return true;
        }
        else
        {
            throw new ValidationException();
        }
    }

    public function getSchema(): string
    {
        return self::SCHEMA;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}