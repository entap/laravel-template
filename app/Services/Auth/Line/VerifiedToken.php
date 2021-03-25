<?php
namespace App\Services\Auth\Line;

class VerifiedToken
{
    protected $userId;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }
}
