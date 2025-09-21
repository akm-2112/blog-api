<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        
        $posts = Post::latest()->paginate(12);
        return response()->json($posts, 200);
    }

    public function show(Post $post){
        $post->load('categories','tags');
        return response()->json($post, 200);
    }

    public function store(Request $request){
        $this->authorize('create', Post::class);
        $request->validate([
            'title' => 'required | string | max:255',
            'context'=>'required | string',
            'category_id' =>'nullable | exists:categories,id',
        ]);
        $post = Auth::user()->posts()->create($request->only('title', 'context', 'category_id'));
        return response()->json([
            'message' => 'Post uploaded successfully',
            'post' =>$post,
        ], 201);
    }
    
 
    public function update(Request $request, Post $post){
        $this->authorize('update', $post);
        $request->validate([
            'title' => 'required | string',
            'context'=>'required | string',
            'category_id' =>'nullable | exists:categories,id',
        ]);
        $post->update($request->all());
        return response()->json([
            'message' => 'Updated Successfully',
            'post' => $post,
        ], 200);
    }
    
    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->delete();
        return response()->json([
            'message' => 'Deleted successfully'
        ],200);
    }

    public function myPosts(User $user){
       
        $posts = Auth::user()->posts()->latest()->paginate(12);
        return response()->json($posts, 200);
    }
}

