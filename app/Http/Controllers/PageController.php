<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Page;

class PageController extends Controller
{
   public function contact()
   {
    return view('pages/contact');
   }
   public function content($slug)
   {
    $page=Page::where('slug',$slug)->first();
 

    return view('pages/content', compact('page'));
   }
}
