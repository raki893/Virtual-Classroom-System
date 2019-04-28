@extends('layouts.app')


@section('content')

<section class="content-header">
	<h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
	<ol class="breadcrumb">
	    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
	    <li class="active">All</li>
	</ol>
</section>

<div class="content">
    <!-- Page header -->
    @if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>

   
	<div class="box box-primary ">
	
		<div class="box-header with-border"> 
			<div class="box-header-tools pull-left" >
				Languange Manager
			</div>
		</div>
		<div class="box-body"> 	
		 @include('vcr.config.tab',array('active'=>'translation'))
	 	{!! Form::open(array('url'=>'vcr/config/translation/', 'class'=>'form-vertical row')) !!}
			
			<div class="col-sm-9">
			
				<a href="{{ URL::to('vcr/config/addtranslation')}} " onclick="vcrModal(this.href,'Add New Language');return false;" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add New Translation </a>  
				<hr />
				<table class="table table-striped">
					<thead>
						<tr>
							<th> Name </th>
							<th> Folder </th>
							<th> Author </th>
							<th> Action </th>
						</tr>
					</thead>
					<tbody>		
				
					@foreach(SiteHelpers::langOption() as $lang)
						<tr>
							<td>  {{  $lang['name'] }}   </td>
							<td> {{  $lang['folder'] }} </td>
							<td> {{  $lang['author'] }} </td>
						  	<td>
							@if($lang['folder'] !='en')
							<a href="{{ URL::to('vcr/config/translation?edit='.$lang['folder'])}} " class="btn btn-sm btn-primary"> Manage </a>
							<a href="{{ URL::to('vcr/config/removetranslation/'.$lang['folder'])}} " class="btn btn-sm btn-danger"> Delete </a> 
							 
							@endif 
						
						</td>
						</tr>
					@endforeach
					
					</tbody>
				</table>
			</div> 

 		{!! Form::close() !!}


		</div>
	</div>
</div>


@endsection