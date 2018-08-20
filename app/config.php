<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    protected $table = 'configs';
    protected $primarykey = 'id';
    protected $fillable = ['angkatan'];
    public $timestamps = false;
}
