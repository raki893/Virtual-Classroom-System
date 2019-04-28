@extends('layouts.app')

@section('content')

    <section class="content-header">
      <h1>
       <i class="fa fa-users text-warning"></i>  {{ Lang::get('core.m_groups') }} 
        <small>{{ $pageNote }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('core/groups') }}"><i class="fa fa-user"></i>  {{ Lang::get('core.m_groups') }}</a></li>
        <li class="active"> View </li>
      </ol>
    </section>



 <div class="content">  		   	  
		
<div class="box box-primary ">
	<div class="box-header with-border"> 
		<div class="box-header-tools pull-left" >
			<a href="{{ url('core/groups?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left"></i></a> 
		</div>
		<div class="box-header-tools " >
					
		</div>

	</div>
	<div class="box-body"> 	


	
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>ID</td>
						<td>{{ $row->group_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Name</td>
						<td>{{ $row->name }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Description</td>
						<td>{{ $row->description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Level</td>
						<td>{{ $row->level }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	
	</div>
</div>	

</div>
@stop	  
