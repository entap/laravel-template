<?php

namespace App\Models;

use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DynamicContent extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'body'];

    public function page()
    {
        return $this->belongsTo(DynamicPage::class, 'dynamic_page_id');
    }

    public function getContentHtml(): HtmlString
    {
        return new HtmlString(
            strip_tags(
                $this->body ?? '',
                implode(
                    '',
                    array_map(
                        function ($tag) {
                            return "<{$tag}>";
                        },
                        ['a', 'strong']
                    )
                )
            )
        );
    }
}
