<?php

namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;

abstract class AbstractValidator implements Validator
{
    protected $uri;
    protected $scheme;

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    public function validate(): bool
    {
        if (preg_match($this->getPattern(), $this->uri)) {
            return true;
        } else {
            throw new ValidationException();
        }
    }

    protected abstract function getPattern(): string;
}