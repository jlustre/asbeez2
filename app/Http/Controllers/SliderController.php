<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class SliderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function AllSlider() {
        // $sliders = DB::table('sliders')->latest()->paginate(5); //Query Builder
        $sliders = Slider::latest()->paginate(10); //ORM Eloquent
        $tsliders = Slider::onlyTrashed()->latest()->paginate(10); //ORM Eloquent
        return view('admin.slider.index', compact('sliders','tsliders'));
    }
       
    public function processImage($request, $image, $path) {
        $slider_image = $request->file($image);
        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($slider_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$image_ext;
        $up_location = $path;
        // create instance
        $img = Image::make($slider_image);
        $img->resize(1920, 1088)->save($up_location.$image_name);
        
        $last_img = $up_location.$image_name;
        return $last_img ;
    }

    public function AddSlider(Request $request) {
        $last_img = $this->processImage($request, 'image', 'image/slider/');
 
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'links' => $request->links,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Slider Added Successfully');
    }

    public function Edit($id){
        $slider = Slider::find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    
    public function Update(Request $request, $id) {
        if ($request->file('image')) {
            $last_img = $this->processImage($request, 'image', 'image/slider/');
        } else {
            $last_img = $request->old_image;
        }

        $update = Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'links' => $request->links,
        ]);

        return Redirect()->route('all.slider')->with('success', 'Slider Updated Successfully');
    }

    public function SoftDelete($id){
        $slider = Slider::find($id)->delete();
        return Redirect()->back()->with('success', 'Slider Soft Deleted Successfully');
    }

    public function Restore($id){
        $slider = Slider::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Slider Restored Successfully');
    }
    public function ForceDelete($id){
        $slider = Slider::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Slider Was Deleted Permanently');
    }
    
}


