<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;

interface Parser
{
    public function setUri(string $uri): void;

    public function getParsed(): ParsedURI;
}