@extends('layouts.master') @section('content')
Selamat Datang Di TPS : {{Session::get('kodeJurusan')}} <br>
Hello {{$nama}}<br>
<a href="logoutUser">Logout User</a>
    <div class="container text-center">
        <h2>Masukkan Data Calon Ketua Osis</h2>
        <form action="/index" method="post">
            <div class="card-deck">
                @foreach($caketos as $key)
                    <div class="card mb-5 mx-auto">
                        <h6 class="mx-auto pt-1">Nomor Urut {{$key->nomor_calon}}</h6>
                        <img class="card-img-top mx-auto img-profile" src="{{asset('images/noPicture.png')}}" width="20%">
                        <div class="card-body">
                            <div class="form-group caketos">
                                <h5>{{$key->nama}}</h5>
                                <h5>{{$key->kelas}}</h5>
                                <p>{{$key->visi}}</p>
                                <p>{{$key->misi}}</p>
                                <button type="submit" name="caketos" value="{{$key->nomor_calon}}" class="btn btn-primary px-5 mb-5">Vote</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ csrf_field() }}
        </form>
    </div>

@endsection