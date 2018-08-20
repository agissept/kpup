@extends('master')
@section('content')

    <h1>Sudah Memilih</h1>
    <table border=1px>
        <tr>
            <td>Username</td>
        </tr>
        @foreach($sudahMemilih as $sudah)
            <tr>
                <td>{{$sudah -> username}}</td>
            </tr>
        @endforeach
    </table>

@endsection