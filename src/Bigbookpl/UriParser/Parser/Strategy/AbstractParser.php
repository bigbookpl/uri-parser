<?php
namespace Bigbookpl\UriParser\Parser\Strategy;

use Bigbookpl\UriParser\Parser\ParsedURI;
use Bigbookpl\UriParser\Parser\ParserException;

abstract class AbstractParser implements Parser
{

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
        $matches = array();

        if (!preg_match($this->getPattern(), $this->uri, $matches)) {
            throw new ParserException();
        }

        return $matches;
    }

    protected abstract function getPattern(): string;

    protected abstract function getParsedURI($matches);

}