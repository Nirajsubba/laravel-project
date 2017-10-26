<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductController extends Controller
{
    public function index($slug='')
    {
    	$categories=Category::all();
    	// \DB::enableQueryLog();
    	if($slug)
    	{
    		//select product .* from product join category ON product.id=category.id where product.status='active' AND category.slug='';
    		// \DB::select("SELECT product .* FROM product JOIN category ON product.id=category.id WHERE product.status='active' AND category.slug=''");
    		//DB::select() works same as below

    		$products=Product::
    		join('category','category.id','=','product.category_id')
    		->where('category.slug',$slug)
    		->where('product.status','active')
    		->get();
    	}
    	else{
    		$products=Product::where('status','active')->get();
    	}

    	// dd(\DB::getQueryLog());
    	// for pegination
    	// $products=Product::where('status','active')->paginate(1);
    	return view('product/list', compact('products','categories'));
    }
}
