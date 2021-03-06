<?php

namespace Bigbookpl\UriParser\Parser\Strategy;

class URNParser extends AbstractParser
{
    private $scheme = "urn";

    protected function getPattern(): string
    {
        return '/^(?\'scheme\'urn):(?\'path\'(?:[[:alnum:]][[:alnum:]-]{1,31}):(?:[[:alnum:]()+,-.:=@%;$_!*\']+))/';
    }

    public function getScheme(): ?string
    {
        return $this->scheme;
    }
}