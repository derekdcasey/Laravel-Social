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
    <article class="post" data-postId='{{ $post->id }}'> 
                <p>{{ $post->body }}</p>
                <div>Posted By {{ $post->user->name }} on {{ $post->created_at }}</div>
                <div>
                    <a class="like" href="#">Like</a> |
                    <a class="like" href="#">Dislike</a>
                    @if(Auth::user() == $post->user) | 
                    <a href="" class="edit" data-toggle="modal" data-target="#exampleModal">Edit</a> |
                    <a href="{{ route('post.delete',['post_id' => $post->id ]) }}">Delete</a>
                    @endif
                </div>   
                </article>
                @endforeach
            </div>
        </div>



<div class="modal" id="edit-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <form>
<div class="form-group">
    <label for="post-body">Edit the post</label>
    <textarea name="post-body" id="post-body" class="form-control" cols="30" rows="10"></textarea>
</div>

             </form>
            </div>
            <div class="modal-footer">
              <button type="button" id="modal-save" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      @endsection

      @section('scripts')
<script>
    var token = '{{ Session::token() }}'
    var url = '{{ route('edit') }}'
    var urlLike = '{{ route('like') }}'
    var postId = 0;
    var postBodyElement = null;

$( document ).ready(function() {

        $('.post').find('.edit').on('click', function (event) {
            event.preventDefault();
            postBodyElement = event.target.parentNode.parentNode.childNodes[1];
            var postBody = postBodyElement.textContent;
            postId = event.target.parentNode.parentNode.getAttribute('data-postId');
            $('#post-body').val(postBody);
            $('#edit-modal').modal();
        });


        $('#modal-save').on('click', function() {

            $.ajax({
                method: 'POST',
                url:url,
                data: {body: $('#post-body').val(), postId: postId, _token: token}
            }).done(function(msg){
                $(postBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide');
            });
        })

        $('.like').on('click', function(event){
            event.preventDefault();
            var isLike = event.target.previousElementSibling == null;
            postId = event.target.parentNode.parentNode.getAttribute('data-postId');
            $.ajax({
                method:'POST',
                url: urlLike,
                data:{isLike:isLike,postId:postId,_token:token}
            }).done(function(){
                //change the page                
            });
        });


});
</script>
      @endsection