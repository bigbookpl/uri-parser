<?php

namespace Bigbookpl\UriParser\Validator\Strategy;

class URN extends AbstractValidator
{
    public function __construct()
    {
        $this->scheme = 'urn';
    }

    protected function getPattern(): string
    {
        return '/^urn:(([[:alnum:]][[:alnum:]-]{1,31}):([[:alnum:]()+,-.:=@%;$_!*\']+))/';
    }
}