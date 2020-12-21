@extends('layout.app')



@section('content')
    <div class="container">
        <fieldset>
            <legend>Registration Form</legend>
            <form  method="post" action="{{ route('user.registration') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="first_name">First name<span class="required_star">*</span></label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First name" value="{{old('first_name')}}">
                        @if ($errors->has('first_name'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>{{ $errors->first('first_name') }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Last Name<span class="required_star">*</span></label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name" value="{{old('last_name')}}">
                        @if ($errors->has('last_name'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>{{ $errors->first('last_name') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="organization">Name Of Organization<span class="required_star">*</span></label>
                    <input type="text" class="form-control" id="organization" name="organization" placeholder="Name Of Organization" value="{{old('organization')}}">
                    @if ($errors->has('organization'))
                        <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                            <p>
                            <p>{{ $errors->first('organization') }}</p></p>
                        </div>
                    @endif
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">City<span class="required_star">*</span></label>
                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{old('city')}}">
                        @if ($errors->has('city'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('city') }}</p></p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="street">Street<span class="required_star">*</span></label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{old('street')}}">
                        @if ($errors->has('street'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('street') }}</p></p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email">Email<span class="required_star">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{old('email')}}">
                        @if ($errors->has('email'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('email') }}</p></p>
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mobile_number">Mobile Number<span class="required_star">*</span></label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number')}}">
                        @if ($errors->has('mobile_number'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('mobile_number') }}</p></p>
                            </div>
                        @endif
                    </div>
                </div>
    
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="password">Password<span class="required_star">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('password') }}</p></p>
                            </div>
                        @endif
    
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm_password">Confirm Password<span class="required_star">*</span></label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Password">
                        @if ($errors->has('confirm_password'))
                            <div class="alert alert-danger" style=" margin-top:2px; padding: 1px !important;">
                                <p>
                                <p>{{ $errors->first('confirm_password') }}</p></p>
                            </div>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </fieldset>
    </div>
@endsection