<?php
namespace Validators;

use Bigbookpl\UriParser\Validators\Email;
use Bigbookpl\UriParser\Validators\ValidationException;
use PHPUnit\Framework\TestCase;

class EmailValidatorShould extends TestCase
{
    /**
     * @test
     */
    public function returnTrueIfEmailIsValid()
    {
        //given
        $cut = new Email();
        $cut->setUri('mail:harriet@vanger.company.se');

        //when
        $result = $cut->validate();

        //then
        $this->assertTrue($result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenEmailIsInvalid()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $cut = new Email();
        $cut->setUri('mail:harriet@vange');

        //when
        $cut->validate();
    }

}