<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table = 'students';
    protected $primarykey = 'id';
    protected $fillable = ['nisn','nis','nama','kode_jurusan','kode_kelas','angkatan','memilih'];
    public $timestamps = false;
}
