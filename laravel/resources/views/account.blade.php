@extends('layouts.master')
@section('content')
    <section>
    <form action="{{ route('account.save')}}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"/>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control" />
        <input type="hidden" value="{{ Session::token() }}" name="_token">
        <br>
        <button class="btn btn-primary" type="submit">Save Account</button>
        </div>
    </form>
    </section>

    @if(Storage::disk('local')->has($user->name . '-' . $user->id . '.jpg'))
        <section>
        <img src="{{ route('account.image', ['filename'=>$user->name . '-' . $user->id . '.jpg'])}}" alt="" class="img-responsive">
        </section>
    @endif

@endsection