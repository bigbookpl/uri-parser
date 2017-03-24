<?php
namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy\GenericParser;
use Bigbookpl\UriParser\Parser\Strategy\URNParser;
use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class ParserSetShould extends TestCase
{
    /**
     * @test
     */
    public function returnAddedParser(){
        //given
        $cut = new ParserSet();
        $cut->addParser(new GenericParser());
        $cut->addParser($urnParser = new URNParser());

        //when
        $parser = $cut->getSchemaParser('urn');

        //then
        $this->assertSame($urnParser, $parser);
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