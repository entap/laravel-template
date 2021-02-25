<?php

namespace App\Models;

use Entap\Admin\Database\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

class AdminJob extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    protected $attributes = [
        'status' => 'pending',
        'progress' => 0,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isProgressing()
    {
        return $this->status === 'progressing';
    }

    public function isSuccess()
    {
        return $this->status === 'success';
    }

    public function isFailed()
    {
        return $this->status === 'failed';
    }

    public function progress(int $progress): void
    {
        if ($progress > 100) {
            throw new InvalidArgumentException(
                'Progress should be less than or equal 100.'
            );
        }
        if ($progress < $this->progress) {
            throw new InvalidArgumentException('Progress should not be back.');
        }
        $this->status = 'progressing';
        $this->progress = $progress;
        $this->save();
    }

    public function finish(): void
    {
        $this->status = 'success';
        $this->progress = 100;
        $this->save();
    }

    public function fail(): void
    {
        $this->status = 'failed';
        $this->save();
    }
}
