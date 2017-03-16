<?php

namespace Bigbookpl\UriParser\Validators;


class Http implements Validator
{

    const SCHEMA = 'http';

    public function __construct()
    {
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }

    public function getSchema(): string
    {
        return self::SCHEMA;
    }
}