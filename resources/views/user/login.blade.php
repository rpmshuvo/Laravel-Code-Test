@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-lg-center">
        <div class="col-lg-4">
            <fieldset>
                <legend>Login Form</legend>
                <form method="post" action="{{ route('user.login') }}">
                    @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number')}}" required>
                            @if ($errors->has('mobile_number'))
                                <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                    <p>{{ $errors->first('mobile_number') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                    <p>{{ $errors->first('password') }}</p>
                                </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </fieldset>
        </div>
    </div>
</div>
@endsection