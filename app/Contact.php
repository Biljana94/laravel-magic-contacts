<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable= [
        'first_name',
        'last_name',
        'email',
    ];

    //ona polja koja hocemo da sakrijemo pisemo u $hidden niz
    protected $hidden = [
        'created_at',
    ];
}
