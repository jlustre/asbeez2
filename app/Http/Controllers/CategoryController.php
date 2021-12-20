<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function AllCat() {
        // $categories = DB::table('categories')->latest()->paginate(5); //Query Builder
        $categories = Category::latest()->paginate(5); //ORM Eloquent
        $tcategories = Category::onlyTrashed()->latest()->paginate(3); //ORM Eloquent
        return view('admin.category.index', compact('categories','tcategories'));
    }

    public function AddCat(Request $request) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            // 'body' => 'required',
        ],
        [
            'category_name.required' => 'Please input a category name'
        ]);

        Category::insert([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Category Added Successfully');
    }

    public function Edit($id){
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    
    public function Update(Request $request, $id) {
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
            // 'body' => 'required',
        ],
        [
            'category_name.required' => 'Please input a category name'
        ]);
        $update = Category::find($id)->update([
            'category_name' => $request->category_name,
            'user_id' => Auth::user()->id,
        ]);

        return Redirect()->route('all.category')->with('success', 'Category Updated Successfully');
    }

    public function SoftDelete($id){
        $category = Category::find($id)->delete();
        return Redirect()->back()->with('success', 'Category Soft Deleted Successfully');
    }

    public function Restore($id){
        $category = Category::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success', 'Category Restored Successfully');
    }
    public function ForceDelete($id){
        $category = Category::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success', 'Category Was Deleted Permanently');
    }
    
}
