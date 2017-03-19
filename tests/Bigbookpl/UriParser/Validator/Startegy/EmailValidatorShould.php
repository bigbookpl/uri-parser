<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class EmailValidatorShould extends TestCase
{
    /**
     * @test
     */
    public function returnTrueIfEmailValid()
    {
        //given
        $cut = new EmailValidator();
        $cut->setUri('mailto:harriet@vanger.company.se');

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
        $cut = new EmailValidator();
        $cut->setUri('mailto:harriet@vange');

        //when
        $cut->validate();
    }

}