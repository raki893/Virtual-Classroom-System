@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('rac?return='.$return) }}"><i class="fa fa-th"></i> {{ $pageTitle }} </a></li>
        <li  class="active"> Update </li>
      </ol>
    </section>

  <div class="content"> 

<div class="box box-primary">
	<div class="box-header with-border">

		<div class="box-header-tools pull-left" >
			<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left"></i></a> 
		</div>
		<div class="box-header-tools " >
			@if(Session::get('gid') ==1)
				<a href="{{ URL::to('vcr/module/config/'.$pageModule) }}" class="tips btn btn-xs btn-default" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
			@endif 			
		</div> 

	</div>
	<div class="box-body"> 	

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	

		 {!! Form::open(array('url'=>'vcr/rac/save?return='.$return, 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}
<div class="col-md-12">
						<fieldset><legend> RestAPI Client</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="Apiuser" class=" control-label col-md-4 text-left"> Apiuser </label>
										<div class="col-md-7">
										  <select name='apiuser' rows='5' id='apiuser' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
										@if($row['id'] !='')
											<div class="form-group  " >
												<label for="Apikey" class=" control-label col-md-4 text-left"> 
												Api Key </label>
												<div class="col-md-6">
												  {!! Form::text('apikey', $row['apikey'],array('class'=>'form-control', 'placeholder'=>'','readonly'=>'1' ,'style'=>'background : #f0f0f0 !important;'   )) !!} 
												 <p><i>  Use this apikey with useremail as basic authorization access to all your registered modules </i> </p>
												 </div> 
												 <div class="col-md-2">
												 	
												 </div>
											</div> 
										@endif
	 {!! Form::hidden('created', $row['created']) !!}					
									  <div class="form-group  " >
										<label for="Modules" class=" control-label col-md-4 text-left"> Modules </label>
										<div class="col-md-7">
										  <select name='modules[]' multiple rows='5' id='modules' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> </fieldset>
			</div>
			
			

		
			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="icon-checkmark-circle2"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="icon-bubble-check"></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('vcr/rac?return='.$return) }}' " class="btn btn-warning btn-sm "><i class="icon-cancel-circle2 "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					</div>	  
			
				  </div> 
		 
		 {!! Form::close() !!}
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#apiuser").jCombo("{!! url('vcr/rac/comboselect?filter=tb_users:id:email') !!}",
		{  selected_value : '{{ $row["apiuser"] }}' });
		
		$("#modules").jCombo("{!! url('vcr/rac/comboselect?filter=tb_module:module_name:module_title&limit=WHERE:module_type:!=:core') !!}",
		{  selected_value : '{{ $row["modules"] }}' });
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("vcr/rac/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop