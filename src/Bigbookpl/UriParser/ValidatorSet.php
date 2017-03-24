<?php

namespace Bigbookpl\UriParser;


use Bigbookpl\UriParser\Validator\Strategy\AbstractValidator;
use Bigbookpl\UriParser\Validator\Strategy\Validator;
use Bigbookpl\UriParser\Validator\ValidationException;

class ValidatorSet
{
    private $validators = array();

    public function addValidator(Validator $validator)
    {
        $this->validators[$validator->getScheme()] = $validator;
        return $this;
    }

    public function getSchemaValidator(string $scheme): Validator
    {
        try{
            return $this->getValidator($scheme);
        }catch (ValidationException $e){
            return $this->getGenericValidator();
        }
    }

    private function getGenericValidator()
    {
        try{
            return $this->getValidator(AbstractValidator::GENERIC);
        }catch (ValidationException $e){
            throw new ValidationException("Generic validator not found");
        }
    }

    private function getValidator(string $scheme): Validator{
        if(!array_key_exists($scheme, $this->validators)){
            throw new ValidationException("Validator not found");
        }
        return $this->validators[$scheme];
    }
}