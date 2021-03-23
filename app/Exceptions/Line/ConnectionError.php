<?php
namespace App\Exceptions\Line;

use Error;

class ConnectionError extends Error
{
    protected $message = 'LINE Connection Error';
}
