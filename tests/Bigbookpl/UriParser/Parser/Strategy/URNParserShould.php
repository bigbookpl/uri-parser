<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParserException;
use PHPUnit\Framework\TestCase;

class URNParserShould extends TestCase
{

    /**
     * @test
     */
    public function returnParsedObject(){
        //given
        $cut = new URNParser();
        $cut->setUri("urn:mpeg:mpeg7:schema:2001");

        //when
        $result = $cut->getParsed();

        //then
        $this->assertEquals('mpeg:mpeg7:schema:2001',$result->getPath());
        $this->assertEquals('urn',$result->getScheme());
        $this->assertEmpty($result->getPort());
    }


    /**
     * @test
     */
    public function throwExceptionWhenInvalidURI(){
        //expect
        $this->expectException(ParserException::class);

        //given
        $cut = new URNParser();
        $cut->setUri("urn:mpeg72001");

        //when
        $cut->getParsed();
    }

}