<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParserException;
use PHPUnit\Framework\TestCase;

class GenericParserShould extends TestCase
{

    /**
     * @test
     */
    public function returnParsedObject()
    {
        //given
        $cut = new GenericParser();
        $cut->setUri("abc://username:password@example.com:123/path/data?key=value&key2=value2#fragid1");

        //when
        $result = $cut->getParsed();

        //then
        $this->assertEquals('abc', $result->getScheme());
        $this->assertEquals('username:password', $result->getUserInformation());
        $this->assertEquals('example.com', $result->getHost());
        $this->assertEquals('123', $result->getPort());
        $this->assertEquals('/path/data', $result->getPath());
        $this->assertEquals('key=value&key2=value2', $result->getQuery());
        $this->assertEquals('fragid1', $result->getFragment());
        $this->assertEquals('username:password@example.com:123', $result->getAuthority());
        $this->assertEquals('username:password@example.com:123/path/data', $result->getHierarchicalPart());
    }

    /**
     * @test
     * @dataProvider invalidURIData
     */
    public function throwExceptionWhenInvalidURI($invalidUri)
    {
        //expect
        $this->expectException(ParserException::class);

        //given
        $cut = new GenericParser();
        $cut->setUri($invalidUri);

        //when
        $cut->getParsed();
    }

    /**
     * @test
     */
    public function returnNullAsScheme(){
        //given
        $cut = new GenericParser();

        //when
        $scheme = $cut->getScheme();

        //then
        $this->assertEquals('__generic', $scheme);
    }

    /**
     * Invalid URI data provider
     *
     * @return array
     */
    public function invalidURIData(){
        return [
            ['abc://:123/path/data?key=value&key2=value2#fragid1'],
            ['://salander.hack/path/data?key=value&key2=value2#fragid1'],
            ['xxx:\local/path/data?key=value&key2=value2#fragid1'],
            ['abc://millenium.se:ABC/path/data']
        ];
    }

}