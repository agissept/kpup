<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class generation extends Model
{
    protected $table = 'generations';
    protected $primarykey = 'id';
    protected $fillable = ['angkatan'];
    public $timestamps = false;
}
