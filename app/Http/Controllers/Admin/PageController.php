<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=Page::all();
        return view('admin/page/list',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/page/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $page=new Page();
        $page->title=$request->title;
        $page->slug = str_replace(' ', '-', strtolower($request->title));
        $page->content=$request->content;
        $page->image='';
        $page->meta_keyword=$request->meta_keyword;
        $page->meta_description=$request->meta_description;
        if($_FILES['image']['error']==0)
        {
            $filename=time().'_'.$_FILES['image']['name'];
            $image='uploads/'.$filename;
            $destination=public_path($image);
            $is_uploaded=move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if($is_uploaded)
            {
                $page->image='/'.$image;
            }
          
        }
        $page->save();
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
         $row=Page::find($id);
        return view('admin/page/edit', compact('row'));
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
         $page = Page::find($id);
        if($page) {
            $oldimage = $page->image;
            $page->title = $request->title;
            $page->content = $request->content;
            $page->meta_keyword=$request->meta_keyword;
            $page->meta_description=$request->meta_description;
            $page->image = $oldimage;
            if($request->image) {
                if($_FILES['image']['error'] == 0) {
                    $filename = time() . '_' . $_FILES['image']['name'];
                    $image = 'uploads/' . $filename;
                    $destination = public_path($image) ;
                    $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
                    if($is_uploaded) {
                        if(is_file(public_path($oldimage))) {
                            unlink(public_path($oldimage));    
                        }
                        $page->image = '/' . $image;
                    }
                }

            }

            $page->save();

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
         $page = Page::find($id);

        if($page) {
            $page->delete();
        }
        return redirect()->back();
    }
}
