<?php

namespace Bigbookpl\UriParser;

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
    public function addValidator(Validator $validator)
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