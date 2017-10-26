<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
    	$records=Category::all();
    	//dd($records);

    	return view('admin/category/list',compact('records'));
    }


    public function add()
    {
        $root_categories=Category::where('parent_id','0')->get();

    	return view('admin/category/add', compact('root_categories'));
    }

    public function postAdd(Request $request)
    {
    	//echo $_POST['title'];
    	//echo $request->title;
    	$category= new Category();
    	$category->title = $request->title;
        $category->slug = str_replace(' ', '-', strtolower($request->title));
        $category->parent_id = $request->parent_id;
    	$category->save();
    	return redirect()->back();
    }


    public function update(Request $request,$id)
    {
        $category=Category::find($id);
            if ($category)
            {
                $category->title=$request->title;
                $category->slug = str_replace(' ', '-', strtolower($request->title));
                $category->parent_id=$request->parent_id;
                $category->save();
            }
            return redirect('admin/category');
    }

     public function edit($id)

    {
     $root_categories=Category::where('parent_id','0')->get();
     $row=Category::find($id);
     return view('admin/category/edit', compact('row','root_categories'));

    }

    public function delete($id)
    {

        
        $category=Category::find($id);

        if($category){
            $category->delete();
        }
            return redirect()->back();   
    }

}
