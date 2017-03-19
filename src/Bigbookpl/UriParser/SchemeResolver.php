<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy as Parser;
use Bigbookpl\UriParser\Validator\Email;
use Bigbookpl\UriParser\Validator\Strategy as Validator;
use Bigbookpl\UriParser\Validator\ValidationException;

class SchemeResolver
{
    private $uri;
    private $validators;
    private $parsers;
    private $pattern = '/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/';
    private $schemeName;

    /**
     * SchemeResolver constructor.
     *
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->schemeName = $this->getSchemeName($this->uri);
    }

    public function addCustomValidator(Validator\Validator $validator)
    {
        $this->validators[$validator->getScheme()] = $validator;
    }

    public function resolveValidator(): Validator\Validator
    {
        if (array_key_exists($this->schemeName, $this->validators)) {
            return $this->validators[$this->schemeName];
        } else {
            return $this->getGenericValidator();
        }
    }

    public function resolveParser(): Parser\Parser
    {
        if (array_key_exists($this->schemeName, $this->validators)) {
            return $this->parsers[$this->schemeName];
        } else {
            return $this->getGenericParser();
        }
    }

    private function getGenericParser(): Parser\Parser
    {
        return new Parser\Generic();
    }

    private function getGenericValidator(): Validator\Validator
    {
        return new Validator\Generic();
    }

    private function getSchemeName(string $uri): string
    {
        if (0 == preg_match($this->pattern, $uri, $matches)) {
            throw new ValidationException("Scheme not found");
        } else {
            return $matches[1];
        }
    }

}