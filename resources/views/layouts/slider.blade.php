<section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php 
                             $count=0;
                             foreach($sliders as $slider){
                                if($count==0){ ?>
                                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <?php $count++; } else {  ?>
                            <li data-target="#slider-carousel" data-slide-to="$count" class=""></li>
                                <?php $count++;}
                             }
                             ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php
                              $count=0;
                              foreach ($sliders as $slider) { 
                                if($count==0)
                                { ?>
                                    <div class="item active">
                               <?php $count++; } else { ?>
                                 <div class="item">
                              <?php $count++; } ?>
                              
                           
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>{{ $slider->title}}</h2>
                                    <p>{{ $slider->caption}}</p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ $slider->image }}" class="girl img-responsive" alt="">
                                    <img src="/front/images/home/pricing.png" class="pricing" alt="">
                                </div>
                            </div> 
                           <?php } ?> 
                        </div>
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>