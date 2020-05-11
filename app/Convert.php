<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{

    protected $table = 'conversion';

    protected $fillable = ['amount','rate','result'];
}
