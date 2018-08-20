<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classes extends Model
{
    protected $table = 'classes';
    protected $primarykey = 'id';
    protected $fillable = ['nama_jurusan','kode_jurusan','kode_kelas','angkatan'];
    public $timestamps = false;
}
