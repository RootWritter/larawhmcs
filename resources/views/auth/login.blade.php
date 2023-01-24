@extends('template')
@section('view')
<div class="row">
    <div class="col-12">
        <h1>{{ $page_name }}</h1>
        <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <form method="POST">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-borderless" role="alert">
                            <strong>Respond :</strong> Success <br />
                            <strong>Message : </strong> {{ session('success') }}
                        </div>
                        @endif
                        @if(session()->has('loginError'))
                        <div class="alert alert-danger alert-borderless" role="alert">
                            <strong>Respond :</strong> Failed <br />
                            <strong>Message : </strong> {{ session('loginError') }}
                        </div>
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please insert your email address">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please insert your password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection