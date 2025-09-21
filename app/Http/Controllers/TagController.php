<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {   
        $categories = Tag::all();
        return response()->json($categories,200);
    }

    public function create(Request $request)
    {   
        $this->authorize('create', Tag::class);
        $request->validate([
            'name' => 'required | string | unique:tags|max:255',
        ]);
        $tag = Tag::create($request->all());
        return response()->json([
            'message'=>'Tag Created Successfully',
            'tag'=> $tag,
        ], 201) ;
    }

    public function show(Tag $tag)
    {   
        return response()->json($tag, 200);
    }
    public function update(Request $request, Tag $tag)
    {   
        $this->authorize('update', $tag);
        $request->validate([
            'name' => 'required | string | unique:tags|max:255',
        ]);
        $tag = tag::update([
            'name'=>$request->name
        ]);
        return response()->json([
            'message' => 'tag updated successfully',
            'tag' => $tag,
        ], 200);
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();
        return response()->json([
            'message' => 'Tag deleted successfully'
        ],200);
    }

    public function posts(Tag $tag)
    {   
        $posts = $tag->posts()->with('user')->latest()->paginate(12);
        return response()->json($posts,200);
    }
}

