<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PublishPhoto extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'image', 'admin',
    ];
}
