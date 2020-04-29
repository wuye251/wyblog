@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <form action="{{ url('auth/admin/login') }}" method="POST">
                    <h2 style="text-align: center;">管理员后台登陆页<h2>
                    <div class="card-body">
                        <div>
                            <input type="text" class="form-control" placeholder="Email" required="" name="email" value="{{ old('email') }}">
                        </div>

                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" name="password">
                        </div>
                        <div style="text-align:center">
                            <button class="btn btn-default submit" type="submit" style="border:solid;">{{ __('Sign In') }}</button>
                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

