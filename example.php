<?php

function __autoload($class){
    require_once 'src'.DIRECTORY_SEPARATOR.str_replace('\\','/', $class).'.php';
}

$schemeResolver =  new Bigbookpl\UriParser\SchemeResolver('https://getcomposer.org/doc/04-schema.md#type');

//you can add your custom validators related to scheme
$schemeResolver->addCustomValidator(new \Bigbookpl\UriParser\Validator\Strategy\EmailValidator());

/**
 * Validator example
 */

$validator    = $schemeResolver->getValidator();
if ($validator->validate()){
    print 'URI is valid\n';
} else {
    echo 'URI is not valid\n';
}

/**
 * Parser example
 */

$parser = $schemeResolver->getParser();
$parsedObject = $parser->getParsed();
echo $parsedObject->getHost();
