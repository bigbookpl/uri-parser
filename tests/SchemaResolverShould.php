<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Validators\Email;
use Bigbookpl\UriParser\Validators\Http;
use Bigbookpl\UriParser\Validators\Validator;
use PHPUnit\Framework\TestCase;

class SchemaResolverShould extends TestCase
{
    /**
     * @test
     */
    public function returnValidatorForHTTP(): void
    {
        //given
        $uri = "http://www.onet.pl";
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
    public function returnValidatorForEMAIL(): void
    {
        //given
        $uri = "mail:mikael@blomkvist.se";
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
    public function throwExceptionWhenSchemaDoNoPassed(): void
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = "webmaster@test.test";
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemaIsInvalid(): void
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = "&://webmaster@test.test";
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }

    /**
     * @test
     */
    public function throwExceptionWhenPortCouldBeRecognizedAsSchema(): void
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = "webmaster@test.test:21/helloword";
        $cut = new SchemaResolver($uri);

        //when
        $cut->resolveValidator();
    }
}