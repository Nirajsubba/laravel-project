
@extends('admin/layouts/adminlayout')

@section('title')
    Add Featured Product
@endsection

@section('body_content')
    <div class="right_col" role="main" style="min-height: 3562px;">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Create Featured Product</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input class="form-control" placeholder="Search for..." type="text">
                            <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Field Information <small>Please enter details</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br>
                            <form id="demo-form2" data-parsley-validate="" method="post" class="form-horizontal form-label-left" action="{{route('featured.store')}}" novalidate="" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <select name="category_id" class="form-control" id="category_id">
                                            <option value="0" >Please Select a Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">
                                                    {{$category->title}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Product <span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-6 col-xs-12" id="productoption">
                                        <select name="product_id" class="form-control" id="product_id">
                                                <option value="">
                                                </option>
                                        </select>
                                    </div>
                                </div>

                            <div class="form-group">
                              <label class="control-label col-md-2 col-sm-3 col-xs-12" for="first-name">Discount <span class="required">*</span>
                              </label>
                               <div class="col-md-6 col-sm-6 col-xs-12">
                             <input type="text" id="discount" name="discount" required="required" class="form-control col-md-7 col-xs-12">
                            </div>

                              <div class="col-md-2 col-sm-6 col-xs-12">
                                <select name="discount" class="form-control">
                                <option>Fixed</option>
                                <option>Percentage</option>
                                </select>
                              </div>
                        </div>

                      
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title">Start Date<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <input type="date" id="start_date" name="start_date" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                       
                      <div class="form-group">
                        <label class="control-label col-md-2 col-sm-3 col-xs-12" for="title">End Date<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <input type="date" id="end_date" name="end_date" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="button">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @include('admin/layouts/scripts/form')
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#category_id').change(function() {
            // alert('changed');
            console.clear();
            console.log('changed');

            var cid = $(this).val();

            // var data = {
            //     category_id: cid
            // };

            // var a = {
            //     title: 'Mr',
            //     name: "",
            //     setName: function() {
            //         this.name = "Raju"   
            //     }
            // };

            // var b = {
            //     "title": "Mr",
            //     "name" : "Raju"
            // };

            $.ajax({
                url: "/admin/featured/ajaxproduct/" + cid,
                type: "get",
                success: function(response) {
                    // console.log('success')
                    // console.log(response)

                    var combobox = '<select name="product_id" class="form-control" id="product_id">';
                    $.each(response, function(k, v) {
                        // console.log(k);
                        // console.log(v);
                        // console.log(v.price)

                        combobox += '<option value="' + v.id + '">' + v.title + '</option>';
                    });

                    combobox += '</select>';

                    $('#productoption').html(combobox);



                }, 
                error: function(error) {
                    console.log('error')
                    console.log(error)
                }

            });



        });
    });
    </script>
@endsection

