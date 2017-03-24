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
        $cut = new SchemeResolver($uri);

        $cut->addValidator(new GenericValidator());
        $cut->addValidator(new EmailValidator());

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
        $cut = new SchemeResolver($uri);
        $cut->addValidator(new URNValidator());

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
        $cut = new SchemeResolver($uri);
        $cut->addValidator(new EmailValidator());

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
        $cut = new SchemeResolver($uri);

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
        $cut = new SchemeResolver($uri);

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
        $cut = new SchemeResolver($uri);

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
        $cut = new SchemeResolver($uri);

        //when
        $cut->getValidator();
    }

}