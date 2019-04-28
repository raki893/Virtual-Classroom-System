@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="{{ asset('vcr/js/simpleclone.js') }}"></script>
    <section class="content-header">
      <h1> <i class="fa fa-th"></i>   Form Generator <small> Manage FOrm  </small></h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('core/forms') }}"><i class="fa fa-th"></i> Form Generator</a></li>
        <li  class="active"> View </li>
      </ol>
    </section>

  <div class="content"> 	

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
	   		<a href="{{ url('core/forms?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="fa  fa-arrow-left"></i></a>
			@if($access['is_add'] ==1)
	   		<a href="{{ url('core/forms/update/'.$id.'?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
			@endif 
					
		</div>	

		<div class="box-header-tools pull-right" >
			<a href="{{ ($prevnext['prev'] != '' ? url('core/forms/show/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-xs btn-default"><i class="fa fa-arrow-left"></i>  </a>	
			<a href="{{ ($prevnext['next'] != '' ? url('core/forms/show/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-xs btn-default"> <i class="fa fa-arrow-right"></i>  </a>
			@if(Session::get('gid') ==1)
				<a href="{{ URL::to('core/vcr/module/config/'.$pageModule) }}" class="tips btn btn-xs btn-default" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
			@endif 			
		</div>


	</div>
	<div class="box-body" > 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
					<tr>
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Method</td>
						<td>{{ $row->method}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Tablename</td>
						<td>{{ $row->tablename}} </td>
						
					</tr>
					<tr>
						<td width='30%' class='label-view text-right'>Send To Email </td>
						<td>{{ $row->email}} </td>
						
					</tr>					
				
					<tr>
						<td width='30%' class='label-view text-right'>Success</td>
						<td>{{ $row->success}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Failed</td>
						<td>{{ $row->failed}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Redirect</td>
						<td>{{ $row->redirect}} </td>
						
					</tr>
				
			</tbody>	
		</table>   

		<div  style="background: #e9e9e9; min-height: 600px; border: solid 1px #ddd;padding: 20px;" > 			
				<div class="col-md-2"></div>
				<div class="col-md-8" style=" border:solid 1px #ddd; background: #fff;" id="formConfig">
					<div style="padding: 20px;"> 
					
					 @include('core.forms.forms.form-'.$row->formID)
					</div>
				</div>
				<div class="col-md-2"></div>
		</div>		 
	
	
	</div>
</div>	

	
</div>
	  
@stop