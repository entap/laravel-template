<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicContentCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function pages()
    {
        return $this->belongsToMany(DynamicPage::class);
    }
}
