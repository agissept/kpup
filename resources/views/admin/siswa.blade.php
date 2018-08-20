@extends('layouts.sidebar') @section('sidebar')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/dashboard/angkatan/">Angkatan</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/admin/dashboard/angkatan/{{$angkatan}}">{{$angkatan}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{$kodeKelas}}</li>
        </ol>
    </nav>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">NISN</th>
                <th scope="col">NIS</th>
                <th scope="col">Nama</th>
                <th scope="col">Memilih</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $key)
            <tr>
                <td>{{$key->nisn}}</td>
                <td>{{$key->nis}}</td>
                <td>{{$key->nama}}</td>
                <td>{{$key->memilih}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
                        <i class="far fa-edit mr-1"></i>Edit
                    </button>

                    <div class="modal fade" id="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Angkatan {{$key->angkatan}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="/admin/dashboard/angkatan/{{$angkatan}}/{{$kodeKelas}}/{{$key->nisn}}/edit" method="post">
                                        <div class="form-group">
                                            <label for="nisn" class="col-form-label">NISN : </label>
                                            <input type="text" class="form-control ml-1" name="nisn" id="nisn" value="{{$key->nisn}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nis" class="col-form-label">NIS : </label>
                                            <input type="text" class="form-control ml-1" name="nis" id="nis" value="{{$key->nis}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama : </label>
                                            <input type="text" class="form-control ml-1" name="nama" id="nama" value="{{$key->nama}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status : </label>
                                            <select class="form-control ml-1" name="status" id="status">
                                                @if ($key->memilih == 0)
                                                <option selected>0</option>
                                                <option>1</option>
                                                @else
                                                <option>0</option>
                                                <option selected>1</option>
                                                @endif

                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hapus">
                        <i class="far fa-trash-alt mr-1"></i>
                        Hapus
                    </button>

                    <div class="modal fade" id="hapus">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapus">Hapus Nama {{$key->nama}} ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="/admin/dashboard/angkatan/{{$angkatan}}/{{$kodeKelas}}/{{$key->nisn}}/delete">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="/admin/dashboard/angkatan/{{$angkatan}}/{{$kodeKelas}}/addSiswa" method="post" class="form-inline">
        <div class="form-group">
            <input type="text" name="nisn" class="form-control ml-1" placeholder="NISN">
        </div>
        <div class="form-group">
            <input type="text" name="nis" class="form-control ml-1" placeholder="NIS">
        </div>
        <div class="form-group">
            <input type="text" name="nama" class="form-control ml-1" placeholder="Nama">
        </div>
        <button type="submit" class="btn btn-coralite ml-3">
            <i class="fas fa-plus"></i>
            Tambah
        </button>{{ csrf_field() }}
    </form>
</div>
@endsection @section('pemilih','coralite-active')