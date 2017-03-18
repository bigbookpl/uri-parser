<?php

namespace Bigbookpl\UriParser;

use Bigbookpl\UriParser\Parser\Strategy\Generic;
use Bigbookpl\UriParser\Validator\Email;
use Bigbookpl\UriParser\Validator\Strategy\Validator;

class SchemeResolver
{
    private $uri;
    private $validators;

    /**
     * SchemeResolver constructor.
     * @param string $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @param Validator $validator
     */
    public function addCustomValidator(Validator $validator)
    {
        $this->validators[$validator->getScheme()] = $validator;
    }

    /**
     * @return Validator
     */
    public function resolveValidator(): Validator
    {
        $schemeName = $this->getSchemeName($this->uri);

        if (array_key_exists($schemeName,$this->validators)){
            return $this->validators[$schemeName];
        } else {
            return null;
        }
    }

    /**
     * @return Validator
     */
    public function resolveParser(): Validator
    {
    }

    private function getGenericParser(){
        return new Generic();
    }

    private function getGenericValidator(){
    }

    /**
     * Return scheme
     *
     * @return string schema
     * @throws \Exception
     */
    private function getSchemeName($uri)
    {
        if (0 == preg_match('/^([[:alpha:]]+[[:alnum:]\+-\.]*):(\/{1,2})?/', $uri, $matches)) {
            throw new \DomainException("Scheme not found");
        } else {
            return $matches[1];
        }
    }

}