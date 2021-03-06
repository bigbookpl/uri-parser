<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;
use Bigbookpl\UriParser\Parser\ParserException;

abstract class AbstractParser implements Parser
{
    const GENERIC = '__generic';
    protected $uri;

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getParsed(): ParsedURI
    {
        $matches = $this->parse();

        return $this->getParsedURI($matches);
    }

    protected function parse(): array
    {
        $matches = [];

        if (!preg_match($this->getPattern(), $this->uri, $matches)) {
            throw new ParserException("Parsing error");
        }

        return $matches;
    }

    protected abstract function getPattern(): string;

    public function getParsedURI($matches): ParsedURI
    {
        return (new ParsedURI())->valueOf($matches);
    }

}