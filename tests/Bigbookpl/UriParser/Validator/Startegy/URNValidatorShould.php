<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class URNValidatorShould extends TestCase
{
    /**
     * @test
     */
    public function returnTrueIfURNValid()
    {
        //given
        $cut = new URNValidator();
        $cut->setUri('urn:issn:9788375540598');

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
        $cut = new URNValidator();
        $cut->setUri('urn:1hsagfhgdsfaf');

        //when
        $cut->validate();
    }

}