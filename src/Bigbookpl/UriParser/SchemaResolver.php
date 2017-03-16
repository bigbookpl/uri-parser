<?php

namespace Bigbookpl\UriParser;


use Bigbookpl\UriParser\Validators\Email;
use Bigbookpl\UriParser\Validators\Validator;

class SchemaResolver
{
    private $uri;
    private $validators;

    /**
     * SchemaResolver constructor.
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @param Validator $validator
     */
    public function addValidator(Validator $validator)
    {
        $this->validators[$validator->getSchema()] = $validator;
    }

    /**
     * @return Validator
     */
    public function resolveValidator(): Validator
    {
        $schemaName = $this->getSchemaName($this->uri);

        if (array_key_exists($schemaName)){
            return $this->validators[$schemaName];
        } else {
//            return new DefaultSchema();
        }
    }

    /**
     * Return schema
     *
     * @return string schema
     * @throws \Exception
     */
    private function getSchemaName($uri)
    {
        if (0 == preg_match('/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/', $uri, $matches)) {
            throw new \Exception("Schema not found");
        } else {
            return $matches[1];
        }
    }

}