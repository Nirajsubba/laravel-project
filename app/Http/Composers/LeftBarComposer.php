<?php 

  namespace App\Http\Composers;

  use App\Models\Category;
  use App\Models\Brand;
  use App\Models\Product;

  
  class LeftbarComposer
  {
  	public function compose($view)
  	{
  		 $categories=Category::where('parent_id',0)->get();
       $subcats=Category::where('parent_id','>',0)->get();
        $brands=Brand::all();

        foreach ($brands as $key => $b) {
          $products=Product::where('brand_id',$b->id)->get();
          $brands[$key]->total=count($products);
        }
  		// $view->with(['categories'=>$categories,'brands'=>$brands]);
  		$view->with(compact('categories','brands','subcats'));
  	}
  	
  }
 ?>