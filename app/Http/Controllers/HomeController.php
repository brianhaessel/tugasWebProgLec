<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('home', compact('posts'));
    }

    public function search(Request $request) {
        // dd("ASD");
        $search = $request->search;
        $request->flashOnly('search');

        if ($search == null) {
            return redirect('home');
        } else {
            $posts = Post::where('title', 'LIKE', '%'.$search.'%')->orWhere('caption', 'LIKE', '%'.$search.'%')->paginate(10);
            return view('home', compact('posts'))->withInput($request->except('password'));
        }
    }

    public function followedBrands() {
        $brands = Auth::user()->followedBrands;
        $brandsIds = [];

        foreach ($brands as $cat) {
            array_push($brandsIds, $cat->id);
        }

        $posts = Post::whereHas('brand', function($q) use ($brandsIds) {
            $q->whereIn('id', $brandsIds);
        })->paginate(10);


        return view('home', compact('posts'));
    }

    public function myPosts() {
        $posts = Auth::user()->posts()->paginate(5);
        return view('home', compact('posts'));
    }


}
