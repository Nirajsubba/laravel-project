<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;

class IndexController extends Controller
{
    public function index()
    {
    	session([
    		'carttest' => 'hello cart',
    		'testtest' => [
    			'test completed',
    			'hello world'
    		],
    	]);
    	$products=Product::all();
    	$sliders=Slider::all();

        return view('index',compact('products','sliders'));
    }
    public function detail()
    {
    	echo 'here';
    	echo session('carttest');
    	
    	echo '<pre>';
    	print_r(session('testtest'));
    	echo '</pre>';
    }
}
