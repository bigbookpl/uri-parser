<?php
namespace Bigbookpl\UriParser\Parser;

interface Parser
{
    public function setUri(string $uri): void;
    public function getParsed(): ParsedURI;
}