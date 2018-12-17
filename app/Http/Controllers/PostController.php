<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Brand;
use App\PostComment;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
    }
    public function add(){
        $brands = Brand::all();
        return view('insertpost', compact('brands'));
    }
    public function addComment(Request $request){
        $post_comments = new PostComment();
        $post_comments->comment = $request->comment;
        $post_comments->user_id = Auth::user()->id;
        $post_comments->post_id = $request->post_id;
        $post_comments->save();
        // return redirect('post', [$post->id]);
        return back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required|string|min:20|max:200',
            'caption' => 'required',
            'price' => 'integer',
            'image' => 'required|mimes:jpeg,png,jpg',
            'brand' => 'required'
        ]);

        $storeImage = $request->file('image')->storeAs('', $request->file('image')->getClientOriginalName().time(), 'public');

        // dd($request->gender);
        $post = new Post();
        $post->title = $request->title;
        $post->caption = $request->caption;
        $post->price = $request->price;
        $post->image = $storeImage;
        $post->user_id = Auth::user()->id;
        $post->brand_id = Brand::where('name', $request->brand)->first()->id;
        $post->save();

        return redirect('/myposts');
    }

    public function view($id) {
        $post = Post::find($id);
        $post_comments = PostComment::where('post_id', $id)->get();

        return view('post', compact('post','post_comments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/myposts');
    }
}
