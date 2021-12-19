<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class BrandController extends Controller
{
    public function AllBrand() {
        // $brands = DB::table('brands')->latest()->paginate(5); //Query Builder
        $brands = Brand::latest()->paginate(5); //ORM Eloquent
        $tbrands = Brand::onlyTrashed()->latest()->paginate(3); //ORM Eloquent
        return view('admin.brand.index', compact('brands','tbrands'));
    }
    
    public function ValidateBrand($request) {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png,gif|min:4',
        ],
        [
            'brand_name.required' => 'Please input a brand name',
            'brand_image.mimes' => 'Please upload an image in these formats only (jpg,jpeg,png,gif)',
        ]);

        return $validated;
    }
    
    public function processImage($request, $img_name, $path) {
        $brand_image = $request->file($img_name);
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$image_ext;
        $up_location = $path;
        //must use intervention package to use the following
        // create instance
        $img = Image::make($brand_image);
        // resize the image to a width of 300 and constrain aspect ratio (auto height)
        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($up_location.$image_name);
        
        // $brand_image->move($up_location,$image_name);
        $last_img = $up_location.$image_name;
        return $last_img ;
    }

    public function AddBrand(Request $request) {
        $validated = $this->ValidateBrand($request);

        $last_img = $this->processImage($request, 'brand_image', 'image/brand/');
 
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Brand Added Successfully');
    }

    public function Edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }
    
    public function Update(Request $request, $id) {
        // $validated = $this->ValidateBrand($request);
        $validated = $request->validate([
            'brand_name' => 'required|max:255',
            'brand_image' => 'required|mimes:jpg,jpeg,png,gif|min:4',
        ]);

        $last_img = $this->processImage($request, 'brand_image', 'image/brand/');

        $update = Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
        ]);

        return Redirect()->route('all.brand')->with('success', 'Brand Updated Successfully');
    }

    public function SoftDelete($id){
        $brand = Brand::find($id)->delete();
        return Redirect()->back()->with('success', 'Brand Soft Deleted Successfully');
    }

    public function Restore($id){
        $brand = Brand::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Brand Restored Successfully');
    }
    public function ForceDelete($id){
        $brand = Brand::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Brand Was Deleted Permanently');
    }
    
    public function Multipic(){
        $images = Multipic::All();
        return view('admin.multipic.index', compact('images'));
    }

    public function StoreImage(Request $request) {
        // $validated = $request->validate([
        //     'images' => 'required|mimes:jpg,jpeg,png,gif',
        // ]);

        $images = $request->file('images');
        $up_location = 'image/multi/';
        
        foreach($images as $image) {
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($image->getClientOriginalExtension());
            $image_name = $name_gen.'.'.$image_ext;
            
            $img = Image::make($image);
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($up_location.$image_name);
            
            $last_img = $up_location.$image_name;
    
            Multipic::insert([
                'image' => $last_img,
                'created_at' => Carbon::now(),
            ]);
        }
        return Redirect()->back()->with('success', 'Image/Images Added Successfully');
    }
}

