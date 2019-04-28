
 @extends('layouts.app')

@section('content')
    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('vcr/config') }}"><i class="fa fa-th"></i> Configuration</a></li>
        <li  class="active"> Email Setting </li>
      </ol>
    </section>

  <div class="content">  
  	
<div class="box box-primary">
	<div class="box-header with-border"> {{ Lang::get('core.t_emailtemplatesmall') }}  </div>
	<div class="box-body">

		@include('vcr.config.tab')
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
		
<div class="tab-content m-t">
	  <div class="tab-pane active use-padding" id="info">	
	 {!! Form::open(array('url'=>'vcr/config/email/', 'class'=>'form-vertical row')) !!}
	
	<div class="col-sm-6 animated fadeInRight">
		<div class="box box-danger  "> 
			<div class="box-header with-border"> {{ Lang::get('core.registernew') }}  </div>
			<div class="box-body"> 	
				  <div class="form-group">
					<label for="ipt" class=" control-label"> {{ Lang::get('core.tab_email') }} </label>		
					<textarea rows="20" name="regEmail" class="form-control input-sm  markItUp">{{ $regEmail }}</textarea>		
				  </div>  
				

				<div class="form-group">   
					<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
				</div>
			
			</div>	
		</div>
		


</div> 


	<div class="col-sm-6 animated fadeInRight">
		<div class="box box-danger  "> 
			<div class="box-header with-border">  {{ Lang::get('core.forgotpassword') }}</div>
			<div class="box-body"> 	
				  <div class="form-group">
					<label for="ipt" class=" control-label ">{{ Lang::get('core.tab_email') }} </label>					
					<textarea rows="20" name="resetEmail" class="form-control input-sm markItUp">{{ $resetEmail }}</textarea>					 
				  </div> 

			  <div class="form-group">
					<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
				 </div> 
			</div>	 
	  </div>	  
	
 	
 </div>
 {!! Form::close() !!}
</div>
</div>
</div></div></div>
@stop





