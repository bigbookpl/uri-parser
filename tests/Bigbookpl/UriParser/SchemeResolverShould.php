<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validator\Http;
use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use PHPUnit\Framework\TestCase;

class SchemeResolverShould extends TestCase
{
    /**
     * @test
     */
    public function returnValidatorForHTTP()
    {
        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $cut = new SchemeResolver($uri);

        $cut->addCustomValidator(new EmailValidator());

        //when
        $result = $cut->getValidator();

        //then
        $this->assertInstanceOf(GenericValidator::class, $result);
    }

    /**
     * @test
     */
    public function returnValidatorForEMAIL()
    {
        //given
        $uri = 'mailto:mikael@blomkvist.se';
        $cut = new SchemeResolver($uri);

        $cut->addCustomValidator(new EmailValidator());

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
        $this->expectException(\Exception::class);

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
        $this->expectException(\Exception::class);

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
        $this->expectException(\Exception::class);

        //given
        $uri = 'mikael@blomkvist.se:21/Miriam';
        $cut = new SchemeResolver($uri);

        //when
        $cut->getValidator();
    }
}