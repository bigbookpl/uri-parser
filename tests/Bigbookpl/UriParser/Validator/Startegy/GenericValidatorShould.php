<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class GenericValidatorShould extends TestCase
{
    /**
     * @test
     * @dataProvider validURIData
     * @param $validURI
     */
    public function returnTrueIfHTTPUrlValid($validURI)
    {
        //given
        $cut = new GenericValidator();
        $cut->setUri($validURI);

        //when
        $result = $cut->validate();

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     * @dataProvider invalidURIData
     * @param $invalidURI
     */
    public function throwExceptionWhenEmailInvalid($invalidURI)
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $cut = new GenericValidator();
        $cut->setUri($invalidURI);

        //when
        $cut->validate();
    }

    /**
     * Invalid URI data provider
     *
     * @return array
     */
    public function invalidURIData(){
        return [
            ['ftp://heeee\\@#top:10'],
            ['abc://:123/path/data?key=value&key2=value2#fragid1'],
            ['://salander.hack/path/data?key=value&key2=value2#fragid1'],
            ['xxx:\local/path/data?key=value&key2=value2#fragid1'],
            ['abc://millenium.se:ABC/path/data']
        ];
    }

    /**
     * Valid URI data provider
     *
     * @return array
     */
    public function validURIData(){
        return [
            ['http://www.wennerstrom.se/?search=HansErik#top'],
            ['abc://jjj:sss@example.com:123/path/data?key=value&key2=value2#fragid1'],
            ['xxx:/local/path/data?key=value&key2=value2#fragid1'],
            ['abc:///path/data?key=value&key2=value2#fragid1'],
            ['abc:mail@test.com'],
            ['abc://onet.pl/path/data?key=value&key2=value2#fragid1'],
            ['abc://example.com/path/data?key=value&key2=value2#fragid1'],
            ['abc://example.com:123/path/data?key=value&key2=value2'],
            ['abc://jjj:ddd@example.com:123/path/data?key=value&key2=value2#fragid1'],
            ['http://www:data@example.com:123/path/data?key=value&key2=value2#fragid1'],
        ];
    }
}