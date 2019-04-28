@extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.fileTree/jqueryFileTree.js') }}"></script>	
<link href="{{ asset('vcr/js/plugins/jquery.fileTree/jqueryFileTree.css') }}" rel="stylesheet">

    <section class="content-header">
      <h1> Code Editor <small> Edit and modify codes </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li  class="active">Code Editor </li>
      </ol>
    </section>

  <div class="content"> 

    	<div class="ajaxLoading"></div>


<div class="box box-primary">
	<div class="box-header with-border"><h4> Source Code Editor </h4> </div>
		  <div class="box-body"> 

			<p class="text-center text-danger"></i>Becarefful !! Do with your own Risk  </p>		  

	 		<div class="row">
	 			<div class="col-md-1"></div>
	 			<div class="col-md-3">
	 				<div class="sbox  "> 
	 					<div class="sbox-title"><h4><i class="fa fa-folder"></i> Folder & File </h4></div>
	 					<div class="sbox-content" style="min-height: 300px;">
	 						<div id="container_id"></div>
	 					</div>	
	 				</div>
				
	 			</div>

	 			<div class="col-md-8">
	 				<div style="padding:10px; background:#fff; min-height:300px; border:solid 1px #ddd;display:none;" class="result">
	 				{!! Form::open(array('url'=>'vcr/code/save', 'class'=>'form-horizontal','id'=>'FormCode' )) !!}
	 					<b> File Location : </b> <span class="file_location text-danger"></span>  <hr />
	 					<div class="message"></div>
	 					<textarea id="content_html" name="content_html" class="form-control markItUp" rows="20"></textarea>
	 					<input type="hidden" name="path" class="path" value="" >
	 					<br />
	 					<button class="btn btn-primary"> Save Change(s) </button>
	 				{!! Form::close() !!}	

	 				</div>

	 			</div>
			</div> 				

		  </div>
	  </div>

    </div>


<script type="text/javascript">
    $(document).ready( function() {
        $('#container_id').fileTree({
            root: '/',
            script: '{{ url("vcr/code/source/folder")}}',
            expandSpeed: 1000,
            collapseSpeed: 1000,
            multiFolder: false
        }, function(file) {
        	$('.ajaxLoading').show();	
        	$.get( "{{ url('vcr/code/edit/')}}",{ path:file}, function( data ) {
        		$('#content_html').val(data.content);
        		$('.file_location').html(data.path);
        		$('.path').val(data.path);
				 $('.ajaxLoading').hide();	
				 $('.result').show();
			});
           
        });

		var form = $('#FormCode'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley('isValid') == true){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  showRequest,
					success:       showResponse  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}		
		
		});        
    });



	

function showRequest()
{
	$('.ajaxLoading').show();		
}  
function showResponse(data)  {		
	
	if(data.status == 'success')
	{	
		$('.ajaxLoading').hide();
		$('.message').html(data.message);
					
	} else {
		//$('.message').html(data.message)	
		$('.ajaxLoading').hide();
		$('.message').html(data.message);
	}	
}	


</script> 

 @stop 
 	    