<?php

use Bigbookpl\UriParser\Parser\Strategy\GenericParser;
use Bigbookpl\UriParser\Parser\Strategy\URNParser;
use Bigbookpl\UriParser\ParserSet;
use Bigbookpl\UriParser\Validator\Strategy\EmailValidator;
use Bigbookpl\UriParser\Validator\Strategy\GenericValidator;
use Bigbookpl\UriParser\Validator\Strategy\URNValidator;
use Bigbookpl\UriParser\ValidatorSet;

function __autoload($class){
    require_once 'src'.DIRECTORY_SEPARATOR.str_replace('\\','/', $class).'.php';
}

$uri = 'https://getcomposer.org/doc/04-schema.md#type';
$validators = new ValidatorSet();

//you can add your custom validators related to scheme
$validators->addValidator(new GenericValidator())
    ->addValidator(new EmailValidator())
    ->addValidator(new URNValidator());

//you can add your custom parsers related to scheme
$parsers = new ParserSet();
$parsers->addParser(new GenericParser())
    ->addParser(new URNParser());

$schemeResolver =  new Bigbookpl\UriParser\SchemeResolver($uri, $validators, $parsers);


/**
 * Validator example
 */
$validator    = $schemeResolver->getValidator();
if ($validator->validate()){
    echo 'URI is valid\n';
} else {
    echo 'URI is not valid\n';
}

/**
 * Parser example
 */
$parser = $schemeResolver->getParser();
$parsedObject = $parser->getParsed();
echo $parsedObject->getHost();
