@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
   <i class="fa fa-user"></i> {{ Lang::get('core.m_users') }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="{{ url('core/users') }}"><i class="fa fa-user"></i>  {{ Lang::get('core.m_users') }} </a></li>
    <li class="active"> View </li>
  </ol>
</section>



 <div class="content">

<div class="box box-primary ">
	<div class="box-header with-border"> 
		<div class="box-header-tools pull-left" >
			<a href="{{ url('core/users?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left"></i></a> 
		</div>
		<div class="box-header-tools " >
			@if(Session::get('gid') ==1)
				<a href="{{ URL::to('vcr/module/config/users') }}" class="tips btn btn-xs btn-default" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
			@endif 			
		</div>

	</div>
	<div class="box-body"> 	


	
	<table class="table table-striped" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Avatar</td>
						<td>
							<?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							<?php  } else { ?> 
							<img alt="" src="http://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
							<?php } ?>	
						</td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Group</td>
						<td>{{ SiteHelpers::gridDisplayView($row->group_id,'group_id','1:tb_groups:group_id:name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Username</td>
						<td>{{ $row->username }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>First Name</td>
						<td>{{ $row->first_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Last Name</td>
						<td>{{ $row->last_name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Email</td>
						<td>{{ $row->email }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created At</td>
						<td>{{ $row->created_at }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Last Login</td>
						<td>{{ $row->last_login }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Updated At</td>
						<td>{{ $row->updated_at }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Active</td>
						<td>{!! ($row->active ==1 ? '<lable class="label label-success">Active</label>' : '<lable class="label label-danger">Inactive</label>')  !!} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	
	</div>
</div>	


</div>
	  
@stop