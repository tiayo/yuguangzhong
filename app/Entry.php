<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'activity_id', 'name', 'phone', 'remark'
    ];

    public function activity()
    {
        return $this->hasOne('App\Activity', 'id', 'activity_id');
    }
}
