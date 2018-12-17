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
        $categories = Auth::user()->followedCategories;
        $categoriesIds = [];

        foreach ($categories as $cat) {
            array_push($categoriesIds, $cat->id);
        }

        $posts = Post::whereHas('category', function($q) use ($categoriesIds) {
            $q->whereIn('id', $categoriesIds);
        })->paginate(10);


        return view('home', compact('posts'));
    }

    public function myPosts() {
        $posts = Auth::user()->posts()->paginate(5);
        return view('home', compact('posts'));
    }

//     public function search(Request $request){
//     $category = $request->input('category');

//     //now get all user and services in one go without looping using eager loading
//     //In your foreach() loop, if you have 1000 users you will make 1000 queries

//     $users = User::with('services', function($query) use ($category) {
//          $query->where('category', 'LIKE', '%' . $category . '%');
//     })->get();

//     return view('browse.index', compact('users'));
// }
}
