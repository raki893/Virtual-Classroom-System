@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}

    <section class="content-header">
      <h1>
       <i class="fa fa-user text-primary"></i>  {{ Lang::get('core.m_users') }} 
        <small>{{ $pageNote }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('core/users') }}"><i class="fa fa-user"></i>  {{ Lang::get('core.m_users') }}</a></li>
        <li class="active">All</li>
      </ol>
    </section>



 <div class="content">
    <!-- Page header -->

	
	


<div class="box box-primary ">
	<div class="box-header with-border"> 
		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('core/users/update') }}" class="tips btn btn-sm btn-default"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa  fa-plus "></i></a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="vcrDelete();" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o"></i></a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('core/users/download') }}" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-cloud-download"></i></a>
			@endif	
			<a href="{{ URL::to( 'core/users/search') }}" class="btn btn-sm btn-default" onclick="vcrModal(this.href,'Advance Search'); return false;" ><i class="fa fa-search"></i> </a>		
		 
		</div> 
	

<div class="box-header-tools" >
		<a href="{{ url($pageModule) }}" class="btn btn-sm btn-default tips" title="Clear Search" ><i class="fa fa-spinner"></i></a>
		@if(Session::get('gid') ==1)
			<a href="{{ URL::to('vcr/module/config/users') }}" class="btn btn-sm btn-default tips" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
		@endif 
		</div>
	</div>
	<div class="box-body "> 	

	<div class="table-header">
		<ul class="nav nav-tabs " >
		  <li class="active"><a href="{{ URL::to('core/users')}}"> {{ Lang::get('core.m_users') }}  </a></li>
		  <li ><a href="{{ URL::to('core/groups')}}"> {{ Lang::get('core.m_groups') }} </a></li>
		  <li class=""><a href="{{ URL::to('core/users/blast')}}"> Send Email </a></li>
		</ul>
	</div>	
	
	
	 {!! Form::open(array('url'=>'core/users/delete/', 'class'=>'form-horizontal' ,'id' =>'vcrTable' )) !!}
	 <div class="table-responsive" style="min-height:70px; padding-bottom: 70px;">
    <table class="table table-bordered table-hover">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th ><span>{{ Lang::get('core.btn_action') }}</span></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
				
			  </tr>
        </thead>

        <tbody>
						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>	
					<td>
					 	<div class="dropdown">
						  <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa  fa-cog"></i>
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						 	@if($access['is_detail'] ==1)
							<li><a href="{{ URL::to('core/users/show/'.$row->id.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i> {{ Lang::get('core.btn_view') }} </a></li>
							@endif
							@if($access['is_edit'] ==1)
							<li><a  href="{{ URL::to('core/users/update/'.$row->id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i> {{ Lang::get('core.btn_edit') }} </a></li>
							@endif
						  </ul>
						</div>

					</td>

				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>	
						@if($field['field'] == 'avatar')
							<?php if( file_exists( './uploads/users/'.$row->avatar) && $row->avatar !='') { ?>
							<a href="{{ asset('uploads/users').'/'.$row->avatar }}" class="previewImage">
							<img src="{{ URL::to('uploads/users').'/'.$row->avatar }} " border="0" width="40" class="img-circle" />
							</a>
							<?php  } else { ?> 
							<img alt="" src="http://www.gravatar.com/avatar/{{ md5($row->email) }}" width="40" class="img-circle" />
							<?php } ?>					 				 
					 	@elseif($field['field'] =='active')
					 		@if($row->active ==1)
					 			<lable class="label label-success">Active</label>
					 		@elseif($row->active ==2)
					 			<lable class="label label-danger"> Banned </label>
					 		@else
					 			<lable class="label label-warning">InActive</label>
					 		@endif
							
								
						@else	
							{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}		
						@endif						 
					 </td>
					 @endif					 
				 @endforeach
				 				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>	
	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#vcrTable').attr('action','{{ URL::to("core/users/multisearch")}}');
		$('#vcrTable').submit();
	});
	
});	
</script>		
@stop