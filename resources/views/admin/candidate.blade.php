@extends('layouts.sidebar') @section('sidebar')

    <div class="container text-center">
        <h2>Masukkan Data Calon Ketua Osis</h2>
        <form action="/admin/dashboard/createCandidate" method="post" enctype="multipart/form-data">
            <div class="card-deck">
                @for($i=0; $i<$no; $i++)
                    <div class="card mb-5 mx-auto">
                        <h6 class="mx-auto pt-1">Nomor Urut {{$i+1+$noCalon}}</h6>
                        <img class="card-img-top mx-auto img-profile" src="{{asset('images/noPicture.png')}}" width="20%">
                        <div class="card-body">
                            <div class="form-group caketos">
                                <input type="text" placeholder="Nama" name="nama{{$i}}" class="form-control">
                                <input type="text" placeholder="Kelas" name="kelas{{$i}}" class="form-control">
                                <textarea placeholder="Visi" name="visi{{$i}}" class="form-control visi"></textarea>
                                <textarea placeholder="Misi" name="misi{{$i}}" class="form-control misi"></textarea>
                            <input type="file" name="image{{$i}}" class="form-control">
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <input type="submit" value="Submit" class="btn btn-primary px-5 mb-5">
            {{ csrf_field() }}
        </form>
    </div>

@endsection