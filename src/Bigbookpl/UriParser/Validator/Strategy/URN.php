<?php

namespace Bigbookpl\UriParser\Validator\Strategy;


use Bigbookpl\UriParser\Validator\ValidationException;

class URN implements Validator
{

    private $uri;

    const SCHEME = 'urn';

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

    public function getScheme(): string
    {
        return self::SCHEME;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}