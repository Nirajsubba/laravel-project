<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

//use event
 use App\Events\ImageEvent;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::leftjoin('category', 'category.id', '=', 'product.category_id')
                ->leftjoin('brand', 'brand.id', '=', 'product.brand_id')
                ->select('product.*', 'category.title as ctitle', 'brand.title as btitle')
                ->get();
        return view('admin/product/list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands=Brand::all();

        return view('admin/product/add', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $product = new Product();

        //validation
        $request->valdate([
            'title'=>'required',
            'price'=>'required',
            'image'=>'required|type: jpeg|png'
        ]);
        // automatic redirection
        $product->title = $request->title;
        $product->slug = str_replace(' ', '-', strtolower($request->title));

        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->price = $request->price;
        $product->content = $request->content;
        $product->status = $request->status;
        $product->image = '';
        if($_FILES['image']['error'] == 0) {
            $filename = time() . '_' . $_FILES['image']['name'];

            $image = 'uploads/' . $filename;

            $destination = public_path($image) ;

            $is_uploaded = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

            if($is_uploaded) {
                $product->image = '/' . $image;
            }
        }

        
        $product->save();

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
        echo 'show to display detail';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Product::find($id);

        $categories = Category::all();
        $brands=Brand::all();

        return view('admin/product/edit', compact('row', 'categories','brands'));
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
        $product = Product::find($id);
        if($product) {
            $oldimage = $product->image;
            $product->title = $request->title;
            $product->price = $request->price;
            $product->image = $oldimage;
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
                        $product->image = '/' . $image;
                    }
                }

            }

            $product->content = $request->content;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->status = $request->status;

            $product->save();

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
        // event(new \App\Events\Event());
        // die;

        $product = Product::find($id);
        
        // die;
        if($product) {
            $productDelete=$product->delete();
            $uploadPath=$product->image;
            if($productDelete)
            {
                event(new ImageEvent($uploadPath));
                // unlink(public_path($uploadPath));
            }
        }
        return redirect()->back();
    }
}
