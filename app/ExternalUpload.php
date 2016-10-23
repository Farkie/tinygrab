<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalUpload extends Model
{
    protected $fillable = [
        'userId', 'url', 'ip_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'ip_address',
    ];

}
