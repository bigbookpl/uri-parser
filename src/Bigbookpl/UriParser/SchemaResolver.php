<?php

namespace Bigbookpl\UriParser;


class SchemaResolver
{
    private $uri;

    /**
     * SchemaResolver constructor.
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;

        $this->loadValidators();
    }

    /**
     * Return schema
     *
     * @return string schema
     * @throws \Exception
     */
    public function getSchema()
    {
        if (0 == preg_match('/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/',$this->uri, $matches)){
            throw new \Exception("Schema not found");
        }
        else{
            return $matches[1];
        }
    }

    private function loadValidators()
    {
    }

}