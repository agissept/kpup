<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class candidate extends Model
{
    protected $table = 'candidates';
    protected $primarykey = 'id';
    protected $fillable = ['nomor_calon','nama','kelas','visi','misi','jumlah_voting','angkatan','pic'];
    public $timestamps = false;
}
