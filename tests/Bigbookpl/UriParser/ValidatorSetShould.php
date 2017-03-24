<?php
namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class ValidatorSetShould extends TestCase
{
    /**
     * @test
     */
    public function returnAddedValidator(){
        //given
        $cut = new ValidatorSet();
        $cut->addValidator(new GenericValidator());
        $cut->addValidator($emailValidator = new EmailValidator());
        $cut->addValidator(new URNValidator());

        //when
        $validator = $cut->getSchemaValidator('mailto');

        //then
        $this->assertSame($emailValidator, $validator);
    }

    /**
     * @test
     */
    public function returnGenericValidator(){
        //given
        $cut = new ValidatorSet();
        $cut->addValidator($genericValidator = new GenericValidator());
        $cut->addValidator(new EmailValidator());
        $cut->addValidator(new URNValidator());

        //when
        $validator = $cut->getSchemaValidator('unknown');

        //then
        $this->assertSame($genericValidator, $validator);
    }

    /**
     * @test
     */
    public function throwExceptionWhenGenericValidatorNotExists(){
        //expect
        $this->expectException(ValidationException::class);

        //given
        $cut = new ValidatorSet();
        $cut->addValidator(new EmailValidator());
        $cut->addValidator(new URNValidator());

        //when
        $validator = $cut->getSchemaValidator('unknown');
    }
}