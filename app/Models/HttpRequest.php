<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HttpRequest extends Model
{
    protected $fillable = [
        'url',
        'status_code',
        'response_body',
    ];
}
