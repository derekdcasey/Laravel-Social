@extends('layouts.master')

@section('content')
@include('includes.message-block')
<div class="row">
    <div class="col">
        <h3>What do you have to say?</h3>
    <form action="{{ route('post.create')}}" method="POST">
            <div class="form-group">
                <textarea class="form-control" name="body" id="body" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            <button type="submit" class="btn btn-primary">Create post</button>
        </form>
    </div>
</div>


  
<div class="row">
    <div class="col">
            <header><h3>What others are saying...</h3></header>
            @foreach($posts as $post)
                <article> 
                <p>{{ $post->body }}</p>
                <div>Posted By {{ $post->user->name }} on {{ $post->created_at }}</div>
                <div>
                    <a href="">Like</a> |
                    <a href="">Dislike</a> |
                    <a href="">Edit</a> |
                <a href="{{ route('post.delete',['post_id' => $post->id ]) }}">Delete</a>
                </div>   
                </article>
                @endforeach
            </div>
        </div>

@endsection