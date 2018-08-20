@extends('layouts.sidebar') @section('sidebar')

<div class="container">
    <form action="/admin/dashboard/createGenerationCandidate" method="post" class="form-inline mb-3">
        <div class="form-group ml-1">
            <input type="text" name="nama" class="form-control" placeholder="Tahun" class="form-control" required>
        </div>
        <div class="form-group ml-2">
            <input type="number" name="jumlah" class="form-control" placeholder="Daftar Calon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-coralite ml-3">
            <i class="fas fa-plus"></i>
            Tambah
        </button>{{ csrf_field() }}
    </form>

    <div class="accordion">
        @foreach($caketos as $key=>$value)
        <div class="card-header" id="headingOne" onclick="spinIcon_{{$key}}" data-toggle="collapse" data-target="#{{ $angkatan[$key]->angkatan }}"
            aria-controls="{{ $angkatan[$key]->angkatan }}">
            <h5 class="mb-0">
                <button type="button" class="btn btn-link">{{ $angkatan[$key]->angkatan}}</button>
                <div class="float-right ">
                    <div class="icon"></div>
                </div>
            </h5>
        </div>

        <div class="collapse mt-2 mb-2 container" id="{{ $angkatan[$key]->angkatan }}" aria-labelledby="headingOne" data-parent="#accordion">
            @foreach($value as $key=>$field)
            <div class="row bg-light border">
                <div class="col-md-2 border text-center">
                    <h5>Calon {{$field->nomor_calon}} </h5>
                    <img src="{{asset('images/noPicture.png')}}" class="img-fluid img-sm">
                </div>
                <div class="col-md-2 border">
                    {{$field -> nama}}
                    <br> {{$field -> kelas}}
                    <br> Jumlah vote :
                    <b>{{$field -> jumlah_vote}}</b>
                    <br>
                </div>
                <div class="col-md-4 border">
                    <h5 class="card-title text-center">Visi</h5>
                    {{$field -> visi}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, aspernatur, explicabo repellat soluta
                    nesciunt nam ducimus deleniti reprehenderit distinctio pariatur qui nisi modi est quisquam ea quam quibusdam,
                    repellendus laudantium.
                </div>
                <div class="col-md-4 border">
                    <h5 class="card-title text-center">Misi</h5>
                    {{$field -> misi}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque tenetur voluptatum ratione fugit quaerat
                    ad temporibus dolor consequuntur vitae minus recusandae praesentium, earum quidem eligendi nesciunt officiis,
                    provident expedita delectus.
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endsection @section('kandidat') coralite-active @endsection