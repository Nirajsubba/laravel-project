 <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach($categories as $c)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#{{ $c->slug }}">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            {{ $c->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="{{ $c->slug }}" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            @foreach($subcats as $subcat)
                                            @if($subcat->parent_id==$c->id)
                                            <li><a href="/category/{{ $subcat->slug }}/product">{{ $subcat->title }}</a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Brands</h2>
                            
                            <div class="brands-name">
                            @foreach($brands as $brand)
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="#"> <span class="pull-right">{{ $brand->total}}</span>{{ $brand->title }}</a></li>
                                </ul>
                                 @endforeach
                            </div>
                           
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="/front/images/home/shipping.jpg" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>