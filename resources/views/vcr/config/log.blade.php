@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('vcr/config') }}"><i class="fa fa-th"></i> Configuration</a></li>
        <li  class="active">Caches </li>
      </ol>
    </section>

  <div class="content">
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>	

	
<div class="box box-primary">
	<div class="box-header with-border"> <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small> </h3> </div>
			
	<div class="box-body">

	@include('vcr.config.tab')	
	  
	 {!! Form::open(array('url'=>'config/email/', 'class'=>'form-vertical row')) !!}
	
	<div class="col-sm-6 m-t">
	

		
		  <div class="form-group">
			<label for="ipt" class=" control-label"> Template Cache </label>		
				
		  </div>  
		  
		<div class="form-group">   
			<a href="{{ URL::to('vcr/config/clearlog') }}" class="btn btn-primary btn-flat clearCache" ><i class="fa fa-trash"></i> {{ Lang::get('core.dash_clearcache') }} </a>	 
		</div>

	</div> 


 {!! Form::close() !!}

 </div></div></div>

@endsection