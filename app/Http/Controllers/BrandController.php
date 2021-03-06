<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return view('manageBrands', compact('brands'));
    }
    public function addBrand(){
        return view('insertBrand');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => 'required|string|min:3|max:20',
            ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();

        return redirect('/manageBrands');
    }
    public function updateBrand(Request $request, Brand $brand){
        
            $validation = $request->validate([
                'name' => 'required|string|max:20|min:3',
            ]);
            $brand->name = $request->name;
            $brand->save();
        
        return redirect()->route('manage_brand');
    }

    public function deleteBrand(Brand $brand){
        $brand->delete();
        return back();
    }

   
    public function update(Request $request, Brand $brand)
    {
        //
    }

    
    public function destroy(Brand $brand)
    {
        //
    }
    
}
