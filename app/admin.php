<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admins';
    protected $primarykey = 'id';
    protected $fillable = ['user','password','kode_jurusan','jurusan'];
}
