<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category(){
        $getCategory = Category::where('status',1)->get();
        $getStatus = Status::get();
        return view('admin.category.addCategory',compact('getStatus','getCategory'));
    }
    public function addCategory(Request $request){
        $addCategory = new Category();
        $addCategory->category_name = $request->category_name;
        $addCategory->category_slug = $request->category_slug;
        $addCategory->status = $request->status;
        $addCategory->save();
    }
}
