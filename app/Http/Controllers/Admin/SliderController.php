<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slider;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $records=Slider::all();
        return view('admin/slider/list',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin/slider/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider=new Slider();
        $slider->title=$request->title;
        $slider->image='';
        $slider->caption=$request->caption;
        $slider->status=$request->status;
        
        // echo $slider->status; die;

        if($_FILES['image']['error']==0)
        {
            $filename=time().'_'.$_FILES['image']['name'];
            $image='uploads/'.$filename;
            $destination=public_path($image);
            $is_uploaded=move_uploaded_file($_FILES['image']['tmp_name'], $destination);
            if($is_uploaded)
            {
                $slider->image='/'.$image;
            }
          
        }
        $slider->save();
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
        $row=Slider::find($id);
        return view('admin/slider/edit', compact('row'));
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
        $slider = Slider::find($id);
        if($slider) {
            $oldimage = $slider->image;
            $slider->title = $request->title;
            $slider->image = $oldimage;
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
                        $slider->image = '/' . $image;
                    }
                }

            }

            $slider->caption = $request->caption;
            $slider->status=$request->status;
             
            $slider->save();

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
         $slider = Slider::find($id);

        if($slider) {
            $slider->delete();
        }
        return redirect()->back();
    }
}
