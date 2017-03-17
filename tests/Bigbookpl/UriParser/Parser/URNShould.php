<?php
namespace Bigbookpl\UriParser\Parser;

use PHPUnit\Framework\TestCase;

class URNShould extends TestCase
{

    /**
     * @test
     */
    public function returnParsedObject(){
        //given
        $cut = new URN();
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
        $cut = new URN();
        $cut->setUri("urn:mpeg72001");

        //when
        $cut->getParsed();
    }

}