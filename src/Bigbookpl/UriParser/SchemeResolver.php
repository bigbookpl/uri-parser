<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy\Parser;
use Bigbookpl\UriParser\Validator\Strategy\Validator;
use Bigbookpl\UriParser\Validator\ValidationException;

class SchemeResolver
{
    private $uri;
    /**
     * @var ValidatorSet
     */
    private $validatorSet;
    private $pattern = '/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/';
    private $schemeName;
    private $parserSet;

    public function __construct($uri, ValidatorSet $validatorSet, ParserSet $parserSet)
    {
        $this->uri = $uri;
        $this->validatorSet = $validatorSet;
        $this->parserSet = $parserSet;
        $this->schemeName = $this->getSchemeName($this->uri);
    }

    public function getValidator(): Validator
    {
        return $this->validatorSet->getSchemaValidator($this->schemeName);
    }

    public function getParser(): Parser
    {
        return $this->parserSet->getSchemaParser($this->schemeName);
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