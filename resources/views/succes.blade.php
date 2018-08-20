@extends('master')
@section('content')
    @if(\Session::has('pilih'))
    succes
        <script>
            alert('Anda berhasil memilih');
        </script>
    @endif
    <a href ="/login">back</a>
@section('content')