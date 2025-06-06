<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ca extends Model
{
    protected $table = 'cas'; // or the actual table name
    //
    protected $fillable =[
        'name'
    ];
}
