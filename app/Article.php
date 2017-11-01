<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'abstract',
        'attribute',
        'category_id',
        'writer',
        'picture',
    ];

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
