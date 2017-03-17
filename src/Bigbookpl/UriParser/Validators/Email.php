<?php
namespace Bigbookpl\UriParser\Validators;

class Email implements Validator
{
    //todo: add mailto schema maybe?
    const SCHEMA = 'mail';

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
        if (preg_match('/^mail:([\w-\.]+)@([\w-\.]+\.[a-z]{2,})/',$this->uri)){
            return true;
        }
        else
        {
            throw new ValidationException();
        }
    }

    public function getSchema(): string
    {
        return self::SCHEMA;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }
}