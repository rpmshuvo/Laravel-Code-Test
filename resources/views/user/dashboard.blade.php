@extends('layout.app')
@section('content')
<div class="container">
    <div class="row justify-content-lg-center">
        Welcome, {{Auth::guard('user')->user()->first_name}}
    </div>
</div>

@endsection