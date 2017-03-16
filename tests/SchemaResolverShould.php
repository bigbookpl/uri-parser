<?php

namespace Bigbookpl\UriParser;

use PHPUnit\Framework\TestCase;

class SchemaResolverShould extends TestCase
{
    /**
     * @test
     */
    public function returnSchemaNameForHTTP(): void
    {
        //given
        $uri = "http://www.onet.pl";
        $cut = new SchemaResolver($uri);

        //when
        $result = $cut->getSchema();

        //then
        $this->assertEquals('http', $result);
    }

    /**
     * @test
     */
    public function returnSchemaNameForEMAIL(): void
    {
        //given
        $uri = "email:webmaster@test.test";
        $cut = new SchemaResolver($uri);

        //when
        $result = $cut->getSchema();

        //then
        $this->assertEquals('email', $result);
    }

    /**
     * @test
     */
    public function throwExceptionWhenSchemaDoestExists(): void
    {
        //expect
        $this->expectException(\Exception::class);

        //given
        $uri = "webmaster@test.test";
        $cut = new SchemaResolver($uri);

        //when
        $cut->getSchema();
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
        $cut->getSchema();
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
        $cut->getSchema();
    }
}