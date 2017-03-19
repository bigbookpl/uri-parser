<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class GenericValidatorShould extends TestCase
{
    /**
     * @test
     */
    public function returnTrueIfHTTPUrlValid()
    {
        //given
        $cut = new GenericValidator();
        $cut->setUri('http://www.wennerstrom.se/?search=HansErik#top');

        //when
        $result = $cut->validate();

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenEmailInvalid()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $cut = new GenericValidator();
        $cut->setUri('ftp://heeee\\@#top:10');

        //when
        $cut->validate();
    }

}