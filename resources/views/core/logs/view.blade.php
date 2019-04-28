@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
   <i class="fa  fa-file-text-o "></i>  {{ $pageTitle }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="{{ url('core/logs') }}"><i class="fa fa-files-o"></i>  Logs </a></li>
    <li class="active">All</li>
  </ol>
</section>



 <div class="content">


<div class="box box-success ">
	<div class="box-header with-border">
			<div class="box-header-tools pull-left" >
					<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left"></i></a> 
				</div>		

	</div>
	<div class="box-body"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>IPs</td>
						<td>{{ $row->ipaddress }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Users</td>
						<td>{{ SiteHelpers::gridDisplayView($row->user_id,'user_id','1:tb_users:id:first_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Module</td>
						<td>{{ $row->module }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Task</td>
						<td>{{ $row->task }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Note</td>
						<td>{{ $row->note }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Logdate</td>
						<td>{{ $row->logdate }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	
	</div>
</div>	
</div>	  
@stop