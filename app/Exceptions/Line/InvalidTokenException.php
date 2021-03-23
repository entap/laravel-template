<?php
namespace App\Exceptions\Line;

use InvalidArgumentException;

class InvalidTokenException extends InvalidArgumentException
{
    protected $message = 'Invalid Token';
}
