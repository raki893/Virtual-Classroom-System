@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1> Module <small>Configuration</small></h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('vcr/module') }}"><i class="fa fa-th"></i> Module</a></li>
    <li class="active">Config</li>
     <li class="active">{{ $row->module_title }}</li>
  </ol>
</section>

<div class="content">	
	
@if(Session::has('message'))
       {{ Session::get('message') }}
@endif
<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
</ul>	
<div class="box box-primary">
	<div class="box-header with-border"><h4> {{ $row->module_title }} <small>  :  Basic Info  ( Information of module ) </small> </h4></div>
	<div class="box-body ">	
		@include('vcr.module.tab',array('active'=>'config','type'=> $type))
		<hr />

	<div class="col-md-8">
	{!! Form::open(array('url'=>'vcr/module/saveconfig/'.$module_name, 'class'=>'form-horizontal ')) !!}
		<input  type='text' name='module_id' id='module_id'  value='{{ $row->module_id }}'  style="display:none; " />
		<div class="form-group">
		<label for="ipt" class=" control-label col-md-4">Name / Title </label>
		<div class="col-md-8">	
		<input  type='text' name='module_title' id='module_title' class="form-control " required value='{{ $row->module_title }}'  /> 
		 </div> 
		</div>  

		<div class="form-group">
		<label for="ipt" class=" control-label col-md-4">Module Note</label>
		<div class="col-md-8">
			<input  type='text' name='module_note' id='module_note'  value='{{ $row->module_note }}' class="form-control "  />
		 </div> 
		</div>    	

		<div class="form-group">
		<label for="ipt" class=" control-label col-md-4">Class Controller </label>
		<div class="col-md-8">
		<input  type='text' name='module_name' id='module_name' readonly="1"  class="form-control " required value='{{ $row->module_name }}'  />
		 </div> 
		</div>  

		<div class="form-group">
		<label for="ipt" class=" control-label col-md-4">Table Master</label>
		<div class="col-md-8">
		<input  type='text' name='module_db' id='module_db' readonly="1"  class="form-control " required value='{{ $row->module_db}}'  />
		  
		 </div> 
		</div>  

		<div class="form-group" style="display:none;" >
		<label for="ipt" class=" control-label col-md-4">Author </label>
		<div class="col-md-8">
		<input  type='text' name='module_author' id='module_author' class="form-control " required readonly="1"  value='{{ $row->module_author }}'  />
		 </div> 
		</div>  
		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"> ShortCode </label>
			<div class="col-md-8 " >
						<b>Form Shortcode : </b><code><br /><?php echo "!!vcrHelpers|showForm|".$row->module_name."!!"; ?></code><br />
					<b>Table Shortcode : </b><br />
					<code><?php echo htmlentities('<php>');?> use \App\Http\Controllers\<?php echo ucwords($row->module_name).'Controller;';?> <br />
					<?php echo ' echo '.ucwords($row->module_name).'Controller::display();'. htmlentities('</php>') ; ?></code>
			</div> 
		</div>   
	

		<div class="form-group">
			<label for="ipt" class=" control-label col-md-4"></label>
			<div class="col-md-8">
				<button type="submit" name="submit" class="btn btn-primary"> Update Module </button>
			</div> 
		</div>   
	
  	{!! Form::close() !!}
	
  
	</div>
	<div class="clr clear"></div>
	</div>
</div></div>
@stop