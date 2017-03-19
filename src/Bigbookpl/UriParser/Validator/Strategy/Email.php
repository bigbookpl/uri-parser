<?php
namespace Bigbookpl\UriParser\Validator\Strategy;

use Bigbookpl\UriParser\Validator\ValidationException;

class Email implements Validator
{
    const SCHEME = 'mailto';

    private $uri;

    public function __construct()
    {
    }

    /**
     * todo: extend validation
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate(): bool
    {
        if (preg_match('/^mailto:([\w-\.]+)@([\w-\.]+\.[a-z]{2,})/', $this->uri)) {
            return true;
        } else {
            throw new ValidationException();
        }
    }

    public function getScheme(): string
    {
        return self::SCHEME;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}