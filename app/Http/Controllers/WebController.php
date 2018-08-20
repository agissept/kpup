<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\admin;
use App\config;
use App\candidate;
use App\generation;
use App\classes;
use App\student;
use Illuminate\Support\Facades\Session;


class WebController extends Controller
{   

    public function showLoginAdmin(){
        if(Session::get('loginAdmin')==true){
            return redirect()->action('WebController@index');    
        }
        else{
            return view('loginAdmin');
        }
        
    }

    public function loginAdmin(Request $request){
        $admin = admin::where([
            ['user',$request -> username],
            ['password',$request -> password],
        ])->first();
        
        if($admin != null){
            Session::put('loginAdmin',true);
            Session::put('username',$admin -> username);
            Session::put('password',$admin -> password);
            Session::put('kodeJurusan',$admin -> kode_jurusan);
            return redirect()->action('WebController@showLoginUser');
        }
        else{
            Session::put('loginAdmin',false);
            return redirect()->action('WebController@loginAdmin')
                             ->with('alert','Username atau password salah');
        }
    }

    public function showLoginUser(){
        if(Session::get('loginAdmin')==false){
            return redirect()->action('WebController@loginAdmin')
                             ->with('alert','Anda harus login sebagai admin');    
        }
        if(Session::get('loginUser')==true){
            return redirect()->action('WebController@loginAdmin');    
        }
        else{
            return view('loginUser',['admin' => Session::get('kodeJurusan')]);
        }
        
    }

    public function loginUser(Request $request){
        
        $siswa = student::where([
            ['nisn',$request -> username],
            ['nis',$request -> password],
        ])->first();

        if($siswa == null ){
            Session::put('loginUser',false);
            return redirect()->action('WebController@showLoginUser')
                             ->with('alert','Username atau password salah');
        }
        if($siswa->memilih == 1){
            Session::put('loginUser',false);
            return redirect()->action('WebController@showLoginUser')
                             ->with('alert','Anda sudah memilih calon');    
        }
        if($siswa->kode_jurusan != Session::get('kodeJurusan')){
            Session::put('loginUser',false);
            return redirect()->action('WebController@showLoginUser')
                             ->with('alert','Anda harus memilih di tps '.$siswa->kode_jurusan);
        }
            Session::put('loginUser',true);
            Session::put('nisn',$siswa->nisn);
            Session::put('nis',$siswa->nis);
            Session::put('nama',$siswa->nama);
            return redirect()->action('WebController@index');  
        
    }

    public function index(){
        if(Session::get('loginUser') == false){
            return redirect()->action('WebController@showLoginUser')
                             ->with('alert','Anda harus login terlebih dahulu');
        }else{
            $config = config::find(1);
            $caketos = candidate::where('angkatan','=',$config->angkatan)->get();
            return view('index',['caketos' => $caketos, 'nama' => Session::get('nama')]);
        }
    } 

    public function pilih(Request $request){
        if(Session::get('loginUser') == false){
            return redirect()->action('WebController@showLoginUser')
                             ->with('alert','Anda harus login terlebih dahulu');
        }
        $config = config::find(1);
        $caketos = candidate::where([
                ['angkatan','=',$config->angkatan],
                ['nomor_calon','=',$request->caketos]
            ])->first();
        
        $caketos->update(['jumlah_voting' => $caketos->jumlah_voting+1]);
        $siswa = student::where('nisn','=',Session::get('nisn'))->first();
        $siswa->update(['memilih' => 0]);

    }

    public function logoutAdmin(){
        Session::flush('loginAdmin');
        Session::flush('loginUser');
        return redirect('/');
    }

    public function logoutUser(){
        Session::put('loginUser',false);
        return redirect('/loginUser');
    }

    public function succes(){
        return view('success');
    }

}
