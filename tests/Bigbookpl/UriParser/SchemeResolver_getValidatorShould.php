<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validator\Http;
use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
use Bigbookpl\UriParser\Validator\ValidationException;
use PHPUnit\Framework\TestCase;

class SchemeResolver_getValidatorShould extends TestCase
{
    /**
     * @test
     */
    public function returnValidatorForHTTP()
    {
        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $validatorSet = new ValidatorSet();
        $validatorSet->addValidator(new GenericValidator());
        $validatorSet->addValidator(new EmailValidator());

        $cut = new SchemeResolver($uri, $validatorSet);

        //when
        $result = $cut->getValidator();

        //then
        $this->assertInstanceOf(GenericValidator::class, $result);
    }

    /**
     * @test
     */
    public function returnValidatorForURN()
    {
        //given
        $uri = 'urn:tel:692000000';
        $validatorSet = new ValidatorSet();
        $validatorSet->addValidator(new URNValidator());
        $cut = new SchemeResolver($uri, $validatorSet);

        //when
        $result = $cut->getValidator();

        //then
        $this->assertInstanceOf(URNValidator::class, $result);
    }

    /**
     * @test
     */
    public function returnValidatorForEMAIL()
    {
        //given
        $uri = 'mailto:mikael@blomkvist.se';
        $validatorSet = new ValidatorSet();
        $validatorSet->addValidator(new EmailValidator());
        $cut = new SchemeResolver($uri, $validatorSet);

        //when
        $result = $cut->getValidator();

        //then
        $this->assertInstanceOf(EmailValidator::class, $result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemeDoNoPassed()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $uri = 'mikael@blomkvist.se';
        $cut = new SchemeResolver($uri, $this->emptyValidatorSet());

        //when
        $cut->getValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemeIsInvalid()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $uri = '&://mikael@blomkvist.se';
        $cut = new SchemeResolver($uri, $this->emptyValidatorSet());

        //when
        $cut->getValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenPortCouldBeRecognizedAsScheme()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $uri = 'mikael@blomkvist.se:21/Miriam';
        $cut = new SchemeResolver($uri, $this->emptyValidatorSet());

        //when
        $cut->getValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenGenericValidatorNotSet()
    {
        //expect
        $this->expectException(ValidationException::class);

        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $validatorSet = new ValidatorSet();
        $validatorSet->addValidator(new EmailValidator());
        $cut = new SchemeResolver($uri, $validatorSet);

        //when
        $cut->getValidator();
    }

    /**
     * @return ValidatorSet
     */
    public function emptyValidatorSet(): ValidatorSet
    {
        return new ValidatorSet();
    }

}