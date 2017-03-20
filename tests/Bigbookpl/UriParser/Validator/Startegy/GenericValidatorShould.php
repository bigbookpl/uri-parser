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
        return array(
            array('ftp://heeee\\@#top:10'),
            array('abc://:123/path/data?key=value&key2=value2#fragid1'),
            array('://salander.hack/path/data?key=value&key2=value2#fragid1'),
            array('xxx:\local/path/data?key=value&key2=value2#fragid1'),
            array('abc://millenium.se:ABC/path/data')
        );
    }

    /**
     * Valid URI data provider
     *
     * @return array
     */
    public function validURIData(){
        return array(
            array('http://www.wennerstrom.se/?search=HansErik#top'),
            array('abc://jjj:sss@example.com:123/path/data?key=value&key2=value2#fragid1'),
            array('xxx:/local/path/data?key=value&key2=value2#fragid1'),
            array('abc:///path/data?key=value&key2=value2#fragid1'),
            array('abc:mail@test.com'),
            array('abc://onet.pl/path/data?key=value&key2=value2#fragid1'),
            array('abc://example.com/path/data?key=value&key2=value2#fragid1'),
            array('abc://example.com:123/path/data?key=value&key2=value2'),
            array('abc://jjj:ddd@example.com:123/path/data?key=value&key2=value2#fragid1'),
            array('http://www:data@example.com:123/path/data?key=value&key2=value2#fragid1'),
       );
    }
}