<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicContent extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body'];

    public function page()
    {
        return $this->belongsTo(DynamicPage::class, 'dynamic_page_id');
    }
}
