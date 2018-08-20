@extends('layouts.sidebar') @section('sidebar')
<div class="container">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Angkatan</li>
        </ol>
    </nav>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Angkatan</th>
                <th scope="col">Sudah Memilih</th>
                <th scope="col">Belum Memilih</th>
                <th scope="col">Jumlah Siswa</th>
                <th scope="col">Status</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($angkatan as $key)

            <tr>
                <td>
                    <a href="/admin/dashboard/angkatan/{{$key->angkatan}}">{{$key->angkatan}}</a>
                </td>
                <td>@if ($key->status == 1) - @else{{$key->sudah_memilih}}@endif</td>
                <td>@if ($key->status == 1) - @else{{$key->sudah_memilih}}@endif</td>
                <td>{{$key->jumlah_siswa}}</td>
                <td>@if ($key->status == 1) Tidak Aktif @else Aktif @endif</td>
                <td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal{{$key->angkatan}}">
                        <i class="far fa-edit mr-1"></i>Edit
                    </button>
                    <div class="modal fade" id="modal{{$key->angkatan}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Angkatan {{$key->angkatan}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <form action="/admin/dashboard/angkatan/{{$key->angkatan}}/edit" method="post">
                                        <div class="form-group">
                                            <label for="angkatan" class="col-form-label">Angkatan : </label>
                                            <input type="text" name="angkatan" class="form-control" id="angkatan" value="{{$key->angkatan}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="col-form-label">Status : </label>
                                            <select class="form-control ml-1" name="status" id="status">
                                                @if ($key->status == 0)
                                                <option value="0" selected>Aktif</option>
                                                <option value="1" >Tidak Aktif</option>
                                                @else
                                                <option value="0" >Aktif</option>
                                                <option value="1" selected>Tidak Aktif</option>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hapus{{$key->angkatan}}">
                        <i class="far fa-trash-alt mr-1"></i>Hapus</button>

                    <div class="modal fade" id="hapus{{$key->angkatan}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus angkatan {{$key->angkatan}} ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-primary" href="/admin/dashboard/angkatan/{{$key->angkatan}}/delete">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <form action="/admin/dashboard/addAngkatan" method="post" class="form-inline">
        <div class="form-group">
            <input type="text" name="angkatan" class="form-control" placeholder="Nama Angkatan">
        </div>
        <button type="submit" class="btn btn-coralite ml-3">
            <i class="fas fa-plus"></i>
            Tambah
        </button>{{ csrf_field() }}
    </form>

</div>
@endsection @section('pemilih','coralite-active')