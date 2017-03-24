<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\ParserException;
use Bigbookpl\UriParser\Parser\Strategy\GenericParser;
use Bigbookpl\UriParser\Parser\Strategy\URNParser;
use Bigbookpl\UriParser\Validator\Http;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use PHPUnit\Framework\TestCase;

class SchemeResolver_getParserShould extends TestCase
{
    /**
     * @test
     */
    public function returnParserForHTTP()
    {
        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $cut = new SchemeResolver($uri, new ValidatorSet());
        $cut->addParser(new GenericParser());

        //when
        $result = $cut->getParser();

        //then
        $this->assertInstanceOf(GenericParser::class, $result);
    }

    /**
     * @test
     */
    public function returnParserForEMAIL()
    {
        //given
        $uri = 'mailto:mikael@blomkvist.se';
        $cut = new SchemeResolver($uri, new ValidatorSet());
        $cut->addParser(new GenericParser());

        //when
        $result = $cut->getParser();

        //then
        $this->assertInstanceOf(GenericParser::class, $result);
    }

    /**
     * @test
     */
    public function returnParserForURN()
    {
        //given
        $uri = 'urn:postcode:133-49';
        $cut = new SchemeResolver($uri, new ValidatorSet());
        $cut->addParser(new URNParser());

        //when
        $result = $cut->getParser();

        //then
        $this->assertInstanceOf(URNParser::class, $result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenGenericParserNotSet()
    {
        //expect
        $this->expectException(ParserException::class);

        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $validatorSet = new ValidatorSet();
        $validatorSet->addValidator(new GenericValidator());

        $cut = new SchemeResolver($uri, $validatorSet);

        //when
        $cut->getParser();
    }
}