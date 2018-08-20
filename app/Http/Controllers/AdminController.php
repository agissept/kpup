<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\admin;
use App\config;
use App\candidate;
use App\generation;
use App\classes;
use App\student;
use Session;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Intervention\Image\ImageManager;
use Image;



class AdminController extends Controller
{
    public function admin(){
        return view('admin/loginAdmin');
    }
    
    public function adminLogin(Request $request){
        $admin = admin::where([
            ['user', '=', $request->username],
            ['password', '=', $request->password],
        ])->first();
        
        if($admin){
            Session::put('userAdmin',$request->username);
            Session::put('loginAdmin',true);
            Session::put('jurusan',$admin->jurusan);
            return redirect('admin/dashboard/');
        }else{
            return view('failed');
        }
    }

    public function adminDashboard(){
        if(!Session::has('loginAdmin')){
            return view('failed');
        }

        $str=null;
        $vote='';
        $angkatanAktif = config::first()->angkatan;
        $caketos =  candidate::select('nama','jumlah_voting')->where('angkatan','=',$angkatanAktif)->get();
        
        foreach ($caketos as $key=>$value) {
            $str.=$value->nama.',';
            $vote.='\''.$value->jumlah_voting.'\''.',';
        }
     
        $str=rtrim($str,',');
        $vote=rtrim($vote,',');
        
        $angkatan = candidate::select('angkatan')->groupBy('angkatan')->get();
       
        return view("admin/dashboard",[
            'angkatanAktif' => $angkatanAktif,
            'angkatan' => $angkatan,
            'str' => $str,
            'vote' => $vote
        ]);
    }

    public function adminCreate(Request $request){
        $user = users::where([
            ['username', $request->username],
        ])->first();

        if(!$user){
            $user = new users;
            $user->username = $request->username;
            $user->password = $request->password;

            $user->save();
            
            $belumMemilih = new belum_memilih;
            $belumMemilih->username = $request->username;
            $belumMemilih->password = $request->password;
            $belumMemilih->save();
        }
        else{
            return view('failed');
        }

        return redirect("admin/dashboard/");
    }

    public function adminCandidate(){
        $angkatan = candidate::select('angkatan')->groupBy('angkatan')->get();
        foreach ($angkatan as $key => $value) {
            $caketos[$key] = candidate::all()->where('angkatan','=',$value->angkatan);
        }
    
        return view('/admin/kandidat',[
            'angkatan' => $angkatan,
            'caketos' => $caketos
        ]);
    }

    public function adminUser(){
        $user = users::all();
        return view('admin/userAdmin',[
            'user'=>$user
        ]);
    }
    
    public function generationCandidate(){
        return view('admin/generationCandidate');
        dd('aa');
    }

    public function createGenerationCandidate(Request $request){
        Session::put('generationCandidate',$request->nama);
        Session::put('no',$request->jumlah);
        return redirect('admin/dashboard/candidate');
    }

    public function candidate(){
        $noCalon = candidate::where('angkatan','=',Session::get('generationCandidate'))->max('nomor_calon');
        $no = Session::get('no');
        return view('admin/candidate',[
            'no' => $no,
            'noCalon' => $noCalon
        ]);
    }

    public function createCandidate(Request $request){   
        $angkatan = generation::where('angkatan','=',Session::get('generationCandidate'))->first();
        if($angkatan == null){
            $angkatan = new generation;
            $angkatan->angkatan = Session::get('generationCandidate');
            $angkatan->save();
        }
        $noCalon = candidate::where('angkatan','=',Session::get('generationCandidate'))->max('nomor_calon')+1;

        for ($i=0; $i < Session::get('no'); $i++) { 
            if ($request->hasFile('image'.$i)) {
                $image = $request->file('image'.$i);
                $extension = $image->getClientOriginalExtension();
                $imageName = ($i+1).$request->input('nama'.$i).Session::get('generationCandidate').'.'.$extension;
                $resize = Image::make($image->getRealPath());
                $resize->resize(300,400);
                $resize->save(public_path('/images/'.$imageName));
            }
            else {
                $imageName = "noPicture";
            }
            $caketos = new candidate;
            $caketos->nomor_calon = $noCalon+$i;
            $caketos->nama = $request->input('nama'.$i);
            $caketos->kelas = $request->input('kelas'.$i);
            $caketos->visi = $request->input('visi'.$i);
            $caketos->misi = $request->input('misi'.$i);   
            $caketos->jumlah_voting = 0;
            $caketos->angkatan = Session::get('generationCandidate');
            $caketos->pic = $imageName;
            $caketos->save();
        }        
        return redirect('/admin/dashboard/');
    }

    public function configTable(Request $request){
        config::where('id',1)->update([
                    'angkatan' => $request->angkatan
                ]);
        return redirect('/admin/dashboard');
    }

    public function angkatan(){
        $angkatan = generation::orderBy('angkatan','asc')->get();
        return view('/admin/angkatan',['angkatan' => $angkatan]);
    }

    public function addAngkatan(Request $request){
        $angkatan = generation::select('angkatan')->where('angkatan','=',$request->angkatan)->first();
        
        if($angkatan==null){
            $angkatan = new generation;
            $angkatan->angkatan = $request->angkatan;
            $angkatan->belum_memilih = 0;
            $angkatan->sudah_memilih = 0;
            $angkatan->jumlah_siswa = 0;
            $angkatan->status = 0;
            $angkatan->save();
            return redirect()->action('AdminController@angkatan')
                            ->with('alert','Angakatan '.$angkatan.' Sudah Ada');
        }
        return redirect()->action('AdminController@angkatan')
                             ->with('alert','Angakatan '.$angkatan.' Sudah Ada');
    }

    public function kelas($angkatan){
        $kelas = classes::where('angkatan','=',$angkatan)->get();
        return view('/admin/kelas',['kelas' => $kelas, 'angkatan' => $angkatan]);
    }

    public function addKelas(Request $request, $angkatan){
        $kelas = classes::select('kelas','angkatan')->where([
            ['angkatan','=',$angkatan],
            ['kode_kelas','=',$request->kodeJurusan.$request->kelas],
        ])->first();
        
        
        if($kelas==null){
            $kelas = new classes;
            $kelas->nama_jurusan = $request->namaJurusan;
            $kelas->kode_jurusan = $request->kodeJurusan;
            $kelas->angkatan = $angkatan;
            $kelas->kelas = $request->kelas;
            $kelas->kode_kelas = $request->kodeJurusan.$request->kelas;
            $kelas->save();
                
            return redirect()->action('AdminController@kelas',['angkatan' => $angkatan])
                            ->with('alert','Kelas '.$kelas.' Sudah Ada');
        }
        return redirect()->action('AdminController@kelas',['angkatan' => $angkatan])
                             ->with('alert','Kelas '.$kelas.' Sudah Ada');
    }

    public function siswa($angkatan, $kodeKelas){
        $siswa = student::where([
            ['angkatan','=',$angkatan],
            ['kode_kelas','=',$kodeKelas],
        ])->get();

        
        return view('/admin/siswa',['kodeKelas' => $kodeKelas, 'angkatan' => $angkatan, 'siswa' => $siswa]);
    }

    public function addSiswa(Request $request, $angkatan, $kodeKelas){
        $siswa = student::where([
            ['angkatan','=',$angkatan],
            ['kode_kelas','=',$kodeKelas],
            ['nisn','=',$request->nisn]
        ])->first();
        
        $kodeJurusan = classes::where('kode_kelas','=',$request->kodeKelas)->first();

        $jumlahSiswa = generation::select('jumlah_siswa')->where('angkatan',$angkatan);
        if($siswa==null){
            $siswa = new student;
            $siswa->nisn = $request->nisn;
            $siswa->nis = $request->nis;
            $siswa->nama = $request->nama;
            $siswa->kode_jurusan = $kodeJurusan->kode_jurusan;
            $siswa->kode_kelas = $kodeKelas;
            $siswa->angkatan = $angkatan;
            $siswa->memilih = false;
            $siswa->save();
            
            $jumlahSiswa = generation::select('jumlah_siswa')->where('angkatan',$angkatan);
            return redirect()->action('AdminController@siswa',['angkatan' => $angkatan, 'kodeKelas' => $kodeKelas])
                            ->with('alert','Siswa '.$siswa.' Sudah Ada');
        }
        return redirect()->action('AdminController@siswa',['angkatan' => $angkatan, 'kodeKelas' => $kodeKelas])
                             ->with('alert','Siswa '.$siswa.' Sudah Ada');
    }

    public function resetUserStatus(){
        $siswa = student::where('memilih','=',0)
        ->update(['memilih' => 1]);

        return redirect('admin/dashboard/');

    }

    public function editAngkatan($angkatan, Request $request){
        $key = generation::select('angkatan')->where([
            ['angkatan','=',$request->angkatan],
            ])->first();
        if($key == null || $angkatan == $request->angkatan){
            $siswa = student::where('angkatan', '=', $angkatan)
            ->update(['angkatan' => $request->angkatan]);

            $kelas = classes::where('angkatan', '=', $angkatan)
            ->update(['angkatan' => $request->angkatan]);

            $angkatan = generation::where('angkatan', '=', $angkatan)
            ->update([
                'angkatan' => $request->angkatan,
                'status' => $request->status
                ]);
        }

        return redirect('admin/dashboard/angkatan');
    }

    public function deleteAngkatan($angkatan){
        $siswa = student::where('angkatan', '=', $angkatan)
        ->delete();

        $kelas = classes::where('angkatan', '=', $angkatan)
        ->delete();
        
        $angkatan = generation::where('angkatan', '=', $angkatan)
        ->delete();

        return redirect('admin/dashboard/angkatan');
    }

    public function showEditKelas($angkatan,$kelas){
        return view("admin/editKelas",["angkatan" => $angkatan, 'kelas' => $kelas]);
    }

    public function editKelas($angkatan,$kodeKelas, Request $request){
        $kelas = classes::select('kelas','angkatan')->where([
            ['nama_jurusan','=',$request->namaJurusan],
            ['kode_jurusan','=',$request->kodeJurusan],
            ['kelas','=',$request->kelas],
            ['kode_kelas','=',$request->kodeJurusan.$request->kelas],
            ['angkatan','=',$angkatan]
        ])->first();
    
        if($kelas == null){
            $siswa = student::where('angkatan', '=', $angkatan)
            ->where('kode_kelas',$kodeKelas)
            ->update([
                'kode_jurusan' => $request->kodeJurusan,
                'kode_kelas' => $request->kodeJurusan.$request->kelas
                ]);
            
            $kelas = classes::where('angkatan', '=', $angkatan)
            ->where('kode_kelas',$kodeKelas)
            ->update([
                'nama_jurusan' => $request->namaJurusan,
                'kode_jurusan' => $request->kodeJurusan,
                'kelas' => $request->kelas,
                'kode_kelas' => $request->kodeJurusan.$request->kelas
                ]);
        }
        return redirect('admin/dashboard/angkatan/'.$angkatan);
    }

    public function deleteKelas($angkatan,$kodeKelas){
        $siswa = student::where('angkatan', '=', $angkatan)
        ->where('kode_kelas',$kodeKelas)
        ->delete();

        $kelas = classes::where('angkatan', '=', $angkatan)
        ->where('kode_kelas',$kodeKelas)
        ->delete();

        return redirect('admin/dashboard/angkatan/'.$angkatan);
    }
    


    public function showEditSiswa($angkatan,$kodeKelas,$nisn){
        return view("admin/editSiswa",["angkatan" => $angkatan, 'kodeKelas' => $kodeKelas, 'nisn' => $nisn]);
    }

    public function editSiswa($angkatan, $kodeKelas, $nisn, Request $request){
        $siswa = student::where([
            ['angkatan','=',$angkatan],
            ['kode_kelas','=',$kodeKelas],
            ['nisn','=', $request->nisn],
            ['nis','=', $request->nis],
            ['nama','=',$request->nama],
            ['memilih','=',$request->status]
        ])->first();

        if($siswa == null){
            $siswa = student::where('angkatan', '=', $angkatan)
            ->where('nisn', $nisn)
            ->update([
                'angkatan' => $angkatan,
                'kode_kelas' => $kodeKelas,
                'nisn' => $request->nisn,
                'nis' => $request->nis,
                'nama' => $request->nama,
                'memilih' => $request->status
                ]);

        }
        return redirect('admin/dashboard/angkatan/'.$angkatan.'/'.$kodeKelas);
    }

    public function deleteSiswa($angkatan,$kodeKelas,$nisn){
        $siswa = student::where([
            ['angkatan','=',$angkatan],
            ['kode_kelas','=',$kodeKelas],
            ['nisn','=', $nisn],
        ])->delete();

        return redirect('admin/dashboard/angkatan/'.$angkatan.'/'.$kodeKelas);
    }
}

