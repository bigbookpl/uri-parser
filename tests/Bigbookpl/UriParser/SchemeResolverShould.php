<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validator\Http;
use Bigbookpl\UriParser\Validator\Strategy\Email;
use PHPUnit\Framework\TestCase;

class SchemeResolverShould extends TestCase
{
//    /**
//     * @test
//     */
//    public function returnValidatorForHTTP()
//    {
//        //given
//        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
//        $cut = new SchemaResolver($uri);
//
//        $cut->addValidator(new Http());
//
//        //when
//        $result = $cut->resolveValidator();
//
//        //then
//        $this->assertInstanceOf(Http::class, $result);
//    }

    /**
     * @test
     */
    public function returnValidatorForEMAIL()
    {
        //given
        $uri = 'mailto:mikael@blomkvist.se';
        $cut = new SchemeResolver($uri);

        $cut->addCustomValidator(new Email());

        //when
        $result = $cut->resolveValidator();

        //then
        $this->assertInstanceOf(Email::class, $result);
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
        $cut->resolveValidator();
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
        $cut->resolveValidator();
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
        $cut->resolveValidator();
    }
}