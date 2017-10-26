<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Brand::all();
        return view('admin/brand/list',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin/brand/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand=new Brand();
        $brand->title=$request->title;
        $brand->logo='';
        $brand->content=$request->content;
        if($_FILES['logo']['error']==0)
        {
            $filename=time().'_'.$_FILES['logo']['name'];
            $logo='uploads/'.$filename;
            $destination=public_path($logo);
            $is_uploaded=move_uploaded_file($_FILES['logo']['tmp_name'], $destination);
            if($is_uploaded)
            {
                $brand->logo='/'.$logo;
            }
          
        }
        $brand->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row=Brand::find($id);
        return view('admin/brand/edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $brand = Brand::find($id);
        if($brand) {
            $oldimage = $brand->logo;
            $brand->title = $request->title;
            $brand->logo = $oldimage;
            if($request->logo) {
                if($_FILES['logo']['error'] == 0) {
                    $filename = time() . '_' . $_FILES['logo']['name'];
                    $logo = 'uploads/' . $filename;
                    $destination = public_path($logo) ;
                    $is_uploaded = move_uploaded_file($_FILES['logo']['tmp_name'], $destination);
                    if($is_uploaded) {
                        if(is_file(public_path($oldimage))) {
                            unlink(public_path($oldimage));    
                        }
                        $brand->logo = '/' . $logo;
                    }
                }

            }

            $brand->content = $request->content;
            $brand->save();

            return redirect()->back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);

        if($brand) {
            $brand->delete();
        }
        return redirect()->back();
    }
}
