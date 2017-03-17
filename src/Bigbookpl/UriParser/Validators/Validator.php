<?php
namespace Bigbookpl\UriParser\Validators;


interface Validator
{
    public function __construct();
    public function validate(): bool;
    public function getSchema(): string;
    public function setUri($uri);
}