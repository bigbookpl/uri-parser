<?php

namespace Bigbookpl\UriParser;


use Bigbookpl\UriParser\Parser\ParserException;
use Bigbookpl\UriParser\Parser\Strategy\AbstractParser;
use Bigbookpl\UriParser\Parser\Strategy\Parser;
use Bigbookpl\UriParser\Validator\Strategy\Validator;
use Bigbookpl\UriParser\Validator\ValidationException;

class ParserSet
{
    private $parsers = array();

    public function addParser(Parser $parser)
    {
        $this->parsers[$parser->getScheme()] = $parser;
        return $this;
    }

    public function getSchemaParser(string $scheme): Parser
    {
        try{
            return $this->getParser($scheme);
        }catch (ValidationException $e){
            return $this->getGenericParser();
        }
    }

    private function getGenericParser()
    {
        try{
            return $this->getParser(AbstractParser::GENERIC);
        }catch (ParserException $e){
            throw new ParserException("Generic parser not found");
        }
    }

    private function getParser(string $scheme): Validator{
        if(!array_key_exists($scheme, $this->parsers)){
            throw new ParserException("Parser not found");
        }
        return $this->parsers[$scheme];
    }
}