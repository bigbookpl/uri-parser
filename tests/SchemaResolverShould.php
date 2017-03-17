<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validators\Email;
use Bigbookpl\UriParser\Validators\Http;
use PHPUnit\Framework\TestCase;

class SchemaResolverShould extends TestCase
{
    /**
     * @test
     */
    public function returnValidatorForHTTP()
    {
        //given
        $uri = 'http://www.goodreads.com/book/show/7822895-the-millennium-trilogy';
        $cut = new SchemaResolver($uri);

        $cut->addValidator(new Http());

        //when
        $result = $cut->resolveValidator();

        //then
        $this->assertInstanceOf(Http::class, $result);
    }

    /**
     * @test
     */
    public function returnValidatorForEMAIL()
    {
        //given
        $uri = 'mail:mikael@blomkvist.se';
        $cut = new SchemaResolver($uri);

        $cut->addValidator(new Email());
        $cut->addValidator(new Http());

        //when
        $result = $cut->resolveValidator();

        //then
        $this->assertInstanceOf(Email::class, $result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemaDoNoPassed()
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = 'mikael@blomkvist.se';
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemaIsInvalid()
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = '&://mikael@blomkvist.se';
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenPortCouldBeRecognizedAsSchema()
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = 'mikael@blomkvist.se:21/Miriam';
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }
}