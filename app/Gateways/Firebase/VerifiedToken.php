<?php
namespace App\Gateways\Firebase;

class VerifiedToken
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }
}
