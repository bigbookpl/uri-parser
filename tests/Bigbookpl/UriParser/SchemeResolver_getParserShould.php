<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy\GenericParser;
use Bigbookpl\UriParser\Parser\Strategy\URNParser;
use Bigbookpl\UriParser\Validator\Http;
use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
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
        $cut = new SchemeResolver($uri);

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
        $cut = new SchemeResolver($uri);

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
        $cut = new SchemeResolver($uri);

        //when
        $result = $cut->getParser();

        //then
        $this->assertInstanceOf(URNParser::class, $result);
    }
}