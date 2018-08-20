@extends('master')
@section('content')

    <h1>User</h1>
    <table border=1px>
        <tr>
            <td>Username</td>
            <td>Edit</td>
        </tr>
        @foreach($user as $users)
            <tr>
                <td>{{$users -> username}}</td>
                <td><a href="admin/dashboard/user/edit/{{$users -> username}}">edit</a></td>
            </tr>
        @endforeach
    </table>

@endsection