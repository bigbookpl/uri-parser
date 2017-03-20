<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class URNValidatorShould extends TestCase
{
    /**
     * @test
     * @dataProvider validURIData
     */
    public function returnTrueIfURNValid($validURI)
    {
        //given
        $cut = new URNValidator();
        $cut->setUri($validURI);

        //when
        $result = $cut->validate();

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     * @dataProvider invalidURIData
     */
    public function throwExceptionWhenURNInvalid($invalidURI)
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $cut = new URNValidator();
        $cut->setUri($invalidURI);

        //when
        $cut->validate();
    }

    public function validURIData(){
        return array(
            array('urn:isbn:0451450523'),
            array('urn:isan:0000-0000-9E59-0000-O-0000-0000-2'),
            array('urn:ISSN:0167-6423'),
            array('urn:ietf:rfc:2648'),
            array('urn:mpeg:mpeg7:schema:2001'),
            array('urn:oid:2.16.840'),
            array('urn:uuid:6e8bc430-9c3a-11d9-9669-0800200c9a66'),
            array('urn:nbn:de:bvb:19-146642'),
            array('urn:lex:eu:council:directive:2010-03-09;2010-19-UE'),
            array('urn:lsid:zoobank.org:pub:CDC8D258-8F57-41DC-B560-247E17D3DC8C'),
        );
    }

    public function invalidURIData(){
        return array(
            array('urn:*isbn:0451450523'),
            array('urn:is a n:'),
            array('urn:i'),
            array('urn:(85445'),
            array('urn:\dasi/fdsf'),
            array('urn:ąść”'),
        );
    }
}