@extends('layouts.app')

@section('title', 'Larahub Home')

@section('content')
<div class="d-flex justify-content-center flex-column mx-auto align-items-center">
    <div class="pt-5">
        <h1>
            Welcome To LaraHub!
        </h1>
    </div>

    <div>
        <a href="{{url('/')}}" class="mx-3">Home</a>
        <a href="{{url('/home')}}" class="mx-3">Forum</a>
    </div>
</div>
@endsection
