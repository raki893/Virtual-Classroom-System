 @extends('layouts.app')

@section('content')
<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.fileTree/jqueryFileTree.js') }}"></script>	
<link href="{{ asset('vcr/js/plugins/jquery.fileTree/jqueryFileTree.css') }}" rel="stylesheet">


    <section class="content-header">
      <h1> Module <small>Configuration</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('vcr/module') }}"><i class="fa fa-th"></i> Module</a></li>
        <li class="active">Code Editor  </li>
         <li class="active">{{ $row->module_title }}</li>
      </ol>
    </section>

   <div class="content">

<div class="box box-primary">
 <div class="box-header with-border"> <h4> {{ $row->module_title }} <small> : Code Editor </small></h4></div>
	<div class="box-body ">	

 	<div class="ajaxLoading"></div>
 	@include('vcr.module.tab',array('active'=>'source','type'=> 'addon'))
 		<div class="box">
 		<div class="box-header"><h4> {{ $row->module_title }} <small> : Source Code Editor</small></h4> </div>
 		<div class="box-body">
	 		<div class="row">
	 			<div class="col-md-3">
				<div id="container_id"></div>

	 			</div>

	 			<div class="col-md-9" style="height: 600px;">
	 				<div style="padding:10px; background:#fff; min-height:300px; border:solid 1px #ddd;display:none;" class="result">
	 				{!! Form::open(array('url'=>'vcr/module/code/'.$module_name, 'class'=>'form-horizontal','id'=>'FormCode' )) !!}
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
</div></div>


<script type="text/javascript">
    $(document).ready( function() {
        $('#container_id').fileTree({
            root: '/{{ $module_name}}/',
            script: '{{ url("vcr/module/source/folder")}}',
            expandSpeed: 1000,
            collapseSpeed: 1000,
            multiFolder: false
        }, function(file) {
        	$('.ajaxLoading').show();	
        	$.get( "{{ url('vcr/module/code/'.$module_name)}}",{ path:file}, function( data ) {
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
