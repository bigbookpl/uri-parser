<?php
namespace Bigbookpl\UriParser\Validator\Strategy;


interface Validator
{
    public function __construct();
    public function validate(): bool;
    public function getScheme(): string;
    public function setUri($uri);
}