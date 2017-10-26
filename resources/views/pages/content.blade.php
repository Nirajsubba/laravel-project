@extends('layouts.layout')

@section('body_content')

<div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">{{ $page->title }}</h2>    			    				    				
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-12">
	    			<div class="contact-info">
	    			{{ $page->content }}
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->

@endsection