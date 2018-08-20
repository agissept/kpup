@extends('layouts.sidebar') @section('sidebar')
<meta name="str" content="{!! $str !!}">
<meta name="vote" content="{!! $vote !!}">
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Data Voting</h1>
            <canvas id="myChart" style="max-width:100%;" height="50px"></canvas>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <h4>Statistik Pemilih</h4>
            <div class="c-border" style="width:100%">
                <div class="progress-bar rounded-5" id="progress-width">0%</div>
            </div>
        </div>
    </div>
</div>
<div>
</div>

<div>
    <form action="/admin/dashboard/configtable" method="post" style="width:30%">
        <div class="form-group">
            <label for="activeTable">Tabel Aktif</label>
            <select name="angkatan" id="activeTable" class="form-control">
                <option value="{{$angkatanAktif}}" selected disabled hidden>{{$angkatanAktif}}</option>
                @foreach ($angkatan as $key)
                <option value="{{$key->angkatan}}">{{$key->angkatan}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
        {{ csrf_field() }}
    </form>
</div>
@endsection
@section('dashboard','coralite-active')