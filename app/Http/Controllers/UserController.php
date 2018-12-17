<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Brand;
use App\FollowBrand;
class UserController extends Controller
{
    public function welcome() {
    	$users = User::all();
    	return view('welcome', compact('users'));
    }

    public function login(){
    	$users = User::all();
    	return view('login', compact('users'));
    }

    public function register(){
    	$users = User::all();
    	return view('register', compact('users'));
    }
    public function insert(Request $request) {
    	$storeImage = $request->file('image')->store('images');
    	// dd($request->gender);
    	$user = new User();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = $request->password;
    	$user->gender = $request->gender;
    	$user->image = $storeImage;
    	$user->save();
    	return redirect('/');

    }
    public function profile(){
        $user = Auth::user();
        return view('profile', compact('user'));

    }

    public function editUser($id) {
        $user = User::find($id);
        return view('profile', compact('user'));
    }
    public function editBrand($id){
        $brand = Brand::find($id);
        return view('updateBrand', compact('brand'));
    }

    public function followedBrand(){
        $user = Auth::user();
        $brands = Brand::all();
        $followed_ids = [];

        foreach ($user->followedBrands as $cat) {
            array_push($followed_ids, $cat->id);
        }

        return view('followedBrand',compact('user', 'brands', 'followed_ids'));
    }
    
    public function manageUser(){
        $users = User::all();
        return view('manageUser', compact('users'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        if ($request->button_submit == 'save') {
            $validation = $request->validate([
                'name' => 'required|string|min:5',
                'email' => 'required|string|email|max:255|unique:users,id,'.$user->id,
                'password' => 'required|string|min:8|alpha_num',
                'gender' => 'required',
            ]);


            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->gender = $request->gender;

            $user->save();
        }
  
        return back();
    }

    public function updateAdmin(Request $request, User $user) {
        if ($request->button_submit == 'save') {
            $validation = $request->validate([
                'name' => 'required|string|min:5',
                'email' => 'required|string|email|max:255|unique:users,id,'.$user->id,
                'gender' => 'required',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;

            $user->save();
        } else if ($request->button_submit == 'discard') {
            return redirect()->route('manage_user');
        }
  
        return back();
    }



    public function updateFollowBrand(Request $request) {
        $brands = Brand::all();

        foreach ($brands as $cat) {
            $checked = $request->input('cat'.$cat->id);

            if ($checked) {
                $existingData = FollowBrand::firstOrNew(['brand_id' => $cat->id, 'user_id' => Auth::user()->id]);
                $existingData->user_id = Auth::user()->id;
                $existingData->brand_id = $cat->id;
                $existingData->save();
            } else {
                
                $existingData = FollowBrand::where('brand_id', $cat->id)->where('user_id', Auth::user()->id)->first();
                if ($existingData != null) {
                    $existingData->delete();
                }
            }
            
        }

        return back();
    }
    
    public function delete(User $user) {
        $user->delete();

        return redirect()->route('manage_user');
    }

}
