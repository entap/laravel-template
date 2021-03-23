<?php
namespace App\Services\Line;

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
