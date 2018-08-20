@extends('layouts.master')
@section('content')
<div class="container" id="formLogin">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header">Login Admin</h3>
                <div class="card-body">
                    <form action="/admin/login" method="post">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class=input-group-text>
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username">
                            <br>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class=input-group-text>
                                    <i class="fas fa-key"></i>
                                </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <br>
                        </div>

                        <input type="submit" value="Sign in" class="btn btn-block"> {{csrf_field() }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection