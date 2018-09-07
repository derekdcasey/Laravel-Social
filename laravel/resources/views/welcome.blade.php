@extends('layouts.master')

@section('title')
Welcome
@endsection

@section('content')
<div class="container">

@include('includes.message-block')

    <div class="row">
        <div class="col">
            <h3>Register</h3>
        <form action="{{ route('signup') }}" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control   {{ $errors->has('email') ? 'border-danger' : '' }} " value="{{ Request::old('email') }}"/>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'border-danger' : '' }} " value="{{ Request::old('name') }}"/>
                </div>
                    <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" value="{{ Request::old('password') }}"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        <div class="col">
            <h3>Sign In</h3>
            <form action="{{ route('signin') }}" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'border-danger' : '' }}" value="{{ Request::old('email') }}"/>
                </div>

                    <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'border-danger' : '' }}" value="{{ Request::old('password') }}"/>
                        </div>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>

</div>
@endsection