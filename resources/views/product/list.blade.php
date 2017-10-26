@extends('layouts.layout')

@section('body_content')
<section id="advertisement">
        <div class="container">
            <img src="/front/images/shop/advertisement.jpg" alt="">
        </div>
    </section>
<section>
        <div class="container">
            <div class="row">


            @include('layouts/leftbar')
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">All Products</h2>
                        @foreach($products as $p)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ $p->image }}" alt="" height="241.75px" width="213.72px">
                                        <h2>${{ $p->price }}</h2>
                                        <p></p>
                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{ $p->price }}</h2>
                                            <p>{{ $p->content}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- for pegination -->
                        {{-- $products->links() --}}
                        <!-- comment in laravel -->
                        <ul class="pagination">
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                            <li><a href="">»</a></li>
                        </ul>
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection




