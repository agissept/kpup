@extends('master')
@section('content')

    <form action="/admin/dashboard/configtable" method="post">
        @foreach($angkatan as $key) 
            <input type="submit" name="table" value="{{ $key->angkatan }}"><br>
        @endforeach
        {{ csrf_field() }}
    </form>
@endsection