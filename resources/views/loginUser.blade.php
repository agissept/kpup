@extends('layouts.master')
@section('content')
Selamat Datang Di TPS : {{Session::get('kodeJurusan')}} <br>
<a href="logoutAdmin">Logout Admin</a>
    <div class="container" id="formLogin">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header">Login User</h3>
                    <div class="card-body">
                        <form action="/loginUser" method="post">
                            @if(Session::has('alert'))
                            <div class="p-1 pl-3 mb-3 bg-danger text-white rounded">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ Session::get('alert') }}
                            </div>
                            @endif
                            
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" placeholder="Username" class="form-control"><br>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" placeholder="Password" class="form-control"><br>
                            </div>
                            <input type="submit" value="Sign in" class="btn btn-block">
                            {{csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection