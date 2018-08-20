@extends('master')
@section('content')
    
    <form action="/admin/dashboard/showtables" method="post">
        @foreach($tables as $table) 
            <input type="submit" name="table" value="{{ head($table) }}"><br>
        @endforeach
        {{ csrf_field() }}
    </form>
@endsection