@extends('admin.layouts.auth-app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Admin</b>FILM</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">LOGIN</p>
                @if ($errors->any())
                    <div class="alert alert-default-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <form action="{{route('adm.login')}}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Login">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Meni eslab qoling
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="input-group">
                            <button class="btn btn-block btn-primary" type="submit">
                                <i class="fa fa-key mr-2"></i> Kirish
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
