<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function getDashboard()
    {

        $posts = Post::all();
        return view('dashboard',['posts'=> $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request,[

            'body' => 'required|max:1000'

        ]);

        $post = new Post();
        $post->body =$request['body'];
        $message = 'there was an error';
        if($request->user()->posts()->save($post))
        {
            $message = 'Post created successfully!';
        }
        return redirect()->route('dashboard')->with(['message'=> $message]);
    }

    public function getDeletePost($postId)
    {
        $post = Post::where('id',$postId)->first();
        $post->delete();
        return redirect()->route('dashboard')->with(['message'=>'Successfully deleted']);
        //Post::where('id','>',$postId)->first();
    }


}