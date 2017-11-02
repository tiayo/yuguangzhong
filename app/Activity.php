<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name',
        'picture',
        'start_time',
        'end_time',
        'active_people',
        'content',
        'sponsor',
        'contractor',
        'status',
        'order',
    ];
}
