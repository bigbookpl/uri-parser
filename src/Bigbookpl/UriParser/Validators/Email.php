<?php
/**
 * Created by PhpStorm.
 * User: kkonieczny
 * Date: 16/03/2017
 * Time: 23:57
 */

namespace Bigbookpl\UriParser\Validators;


class Email implements Validator
{

    const SCHEMA = 'mail';

    public function __construct()
    {
    }

    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }

    public function getSchema(): string
    {
        return self::SCHEMA;
    }
}