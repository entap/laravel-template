<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class DynamicCategory extends Model
{
    use HasFactory;
    use NodeTrait;

    protected $fillable = ['name', 'parent_id'];

    public function pages()
    {
        return $this->belongsToMany(
            DynamicPage::class,
            'dynamic_category_page'
        );
    }
}
