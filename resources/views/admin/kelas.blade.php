@extends('layouts.sidebar') @section('sidebar')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/admin/dashboard/angkatan/">Angkatan</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{$angkatan}}</li>
        </ol>
    </nav>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Kelas</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $key)
            <tr>
                <td>
                    <a href="/admin/dashboard/angkatan/{{$angkatan}}/{{$key->kode_jurusan.$key->kelas}}">{{$key->nama_jurusan}}/{{$key->kode_jurusan}} {{$key->kelas}}</a>
                </td>
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
                                    <form action="/admin/dashboard/angkatan/{{$angkatan}}/{{$key->kode_jurusan.$key->kelas}}/edit" method="post">
                                        <div class="form-group">
                                            <label for="namaJurusan" class="col-form-label">Nama Jurusan : </label>
                                            <input type="text" class="form-control ml-1" name="namaJurusan" id="namaJurusan" value="{{$key->nama_jurusan}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kodeJurusan" class="col-form-label">Kode Jurusan : </label>
                                            <input type="text" class="form-control ml-1" name="kodeJurusan" id="kodeJurusan" value="{{$key->kode_jurusan}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kelas" class="col-form-label">Kelas : </label>
                                            <input type="text" class="form-control ml-1" name="kelas" id="kelas" value="{{$key->kelas}}">
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
                                    <h5 class="modal-title" id="hapus">Hapus Kelas {{$key->kode_jurusan.$key->kelas}} ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="/admin/dashboard/angkatan/{{$angkatan}}/{{$key->kode_jurusan.$key->kelas}}/delete">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="/admin/dahsboard/angkatan/{{$angkatan}}/addKelas" method="post" class="form-inline">
        <div class="form-group">
            <input type="text" class="form-control ml-1" name="namaJurusan" placeholder="Nama Jurusan">
        </div>
        <div class="form-group">
            <input type="text" class="form-control ml-1" name="kodeJurusan" placeholder="Kode Jurusan">
        </div>
        <div class="form-group">
            <input type="text" class="form-control ml-1" name="kelas" placeholder="Kelas">
        </div>
        <button type="submit" class="btn btn-coralite ml-3">
            <i class="fas fa-plus"></i>
            Tambah
        </button>{{ csrf_field() }}
    </form>
</div>
@endsection @section('pemilih','coralite-active')