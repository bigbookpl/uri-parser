<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

class EmailValidator extends AbstractValidator
{
    public function __construct()
    {
        $this->scheme = "mailto";
    }

    protected function getPattern(): string
    {
        return '/^mailto:([\w-\.]+)@([\w-\.]+\.[a-z]{2,})/';
    }

}