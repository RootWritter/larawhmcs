@extends('template')
@section('view')
<div class="row">
    <div class="col-12">
        <h1>{{ $page_name }}</h1>
        <div class="col-8 m-auto">
            <div class="card">
                <div class="card-header">
                    Register
                </div>
                <form method="POST">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success alert-borderless" role="alert">
                            <strong>Respond :</strong> Success <br />
                            <strong>Message : </strong> {{ session('success') }}
                        </div>
                        @endif
                        @if(session()->has('registerError'))
                        <div class="alert alert-danger alert-borderless" role="alert">
                            <strong>Respond :</strong> Failed <br />
                            <strong>Message : </strong> {{ session('registerError') }}
                        </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="Please insert your First Name">
                                    @if ($errors->has('first_name'))
                                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Please insert your Last Name">
                                    @if ($errors->has('last_name'))
                                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Please insert your Address">
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Please insert your City Name">
                                    @if ($errors->has('city'))
                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="state" placeholder="Please insert your State Name">
                                    @if ($errors->has('state'))
                                    <span class="text-danger">{{ $errors->first('state') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" placeholder="Please insert your Phone Number (eg: +6282....)">
                            @if ($errors->has('phone_number'))
                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please insert your Email Address">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Please insert your New Password">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary" type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
@endsection