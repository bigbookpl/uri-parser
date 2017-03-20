<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy\GenericParser;
use Bigbookpl\UriParser\Parser\Strategy\Parser;
use Bigbookpl\UriParser\Parser\Strategy\URNParser;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
use Bigbookpl\UriParser\Validator\Strategy\Validator;
use Bigbookpl\UriParser\Validator\ValidationException;

class SchemeResolver
{
    private $uri;
    private $validators = array();
    private $parsers = array();
    private $pattern = '/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/';
    private $schemeName;

    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->schemeName = $this->getSchemeName($this->uri);
//        $this->addCustomValidator(new URNValidator());
        $this->addCustomParser(new URNParser());
    }

    public function addCustomValidator(Validator $validator)
    {
        $this->validators[$validator->getScheme()] = $validator;
    }

    public function addCustomParser(Parser $parser)
    {
        $this->parsers[$parser->getScheme()] = $parser;
    }

    public function getValidator(): Validator
    {
        if (array_key_exists($this->schemeName, $this->validators)) {
            $validator = $this->validators[$this->schemeName];
        } else {
            $validator = $this->getGenericValidator();
        }

        $validator->setUri($this->uri);

        return $validator;
    }

    public function getParser(): Parser
    {
        if (array_key_exists($this->schemeName, $this->parsers)) {
            $parser = $this->parsers[$this->schemeName];
        } else {
            $parser = $this->getGenericParser();
        }

        $parser->setUri($this->uri);

        return $parser;
    }

    private function getGenericParser(): Parser
    {
        return new GenericParser();
    }

    private function getGenericValidator(): Validator
    {
        return new GenericValidator();
    }

    private function getSchemeName(string $uri): string
    {
        if (0 == preg_match($this->pattern, $uri, $matches)) {
            throw new ValidationException("Invalid scheme");
        } else {
            return $matches[1];
        }
    }

}