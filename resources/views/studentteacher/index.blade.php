@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li  class="active"> {{ $pageTitle }} </li>
      </ol>
    </section>
    
<style>
table.table.table-bordered.table-hover th:nth-child(4),table.table.table-bordered.table-hover td:nth-child(4),table.table.table-bordered.table-hover th:nth-child(8),table.table.table-bordered.table-hover td:nth-child(8) {
    display: none;
}

</style>

  <div class="content"> 

<div class="box box-primary">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('studentteacher/update?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa  fa-plus "></i></a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="vcrDelete();" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o"></i></a>
			@endif 
			<a href="{{ URL::to( 'studentteacher/search?return='.$return) }}" class="btn btn-xs btn-default" onclick="vcrModal(this.href,'Advance Search'); return false;" title="{{ Lang::get('core.btn_search') }}"><i class="fa  fa-search"></i></a>				


		</div>

		<div class="box-header-tools" >
			@if($access['is_add'] ==1)
			<a href="{{ URL::to('studentteacher/import?return='.$return) }}" onclick="vcrModal(this.href, 'Import CSV'); return false;" class="tips btn btn-xs btn-default" title="Import CSV">
			<i class="fa fa-upload"></i></a>
			@endif
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('studentteacher/download?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-cloud-download"></i></a>
			@endif

			<a href="{{ url($pageModule) }}" class=" tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_clearsearch') }}" ><i class="fa fa-spinner"></i>  </a>		
			@if(Session::get('gid') ==1)
				<a href="{{ URL::to('vcr/module/config/'.$pageModule) }}" class="tips btn btn-xs btn-default" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
			@endif 
		</div>
	</div>

	<div class="box-body "> 	
	

	 {!! (isset($search_map) ? $search_map : '') !!}
	
	 {!! Form::open(array('url'=>'studentteacher/delete/0?return='.$return, 'class'=>'form-horizontal' ,'id' =>'vcrTable' )) !!}
	 <div class="table-responsive" style="min-height:50px;  padding-bottom:60px;">
    <table class="table table-bordered table-hover  ">
        <thead>
			<tr>
				<th class="number"><span> No </span> </th>
				<th class="chbox-col"> <input type="checkbox" class="checkall" /></th>
				<th class="action-col" ><span>{{ Lang::get('core.btn_action') }}</span></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')				
						<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
						@if(SiteHelpers::filterColumn($limited ))
						<?php
						$addClass='class="tbl-sorting" ';
							if($insort ==$t['field'])
							{
								$dir_order = ($inorder =='desc' ? 'sort-desc' : 'sort-asc'); 
								$addClass='class="tbl-sorting '.$dir_order.'" ';
							}
						?>							
							<th {!! $addClass !!} ><span>{{ $t['label'] }}</span></th>			
						@endif 
					@endif
				@endforeach
				
			  </tr>
        </thead>

        <tbody>        						
            @foreach ($rowData as $row)
                <tr>
					<td class="number"> {{ ++$i }} </td>
					<td class="chbox-col"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->id }}" />  </td>	
					<td  class="action-col">
					 	<div class="dropdown">
						  <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa  fa-cog"></i>
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						 	@if($access['is_detail'] ==1)
							<li><a href="{{ URL::to('studentteacher/show/'.$row->id.'?return='.$return)}}" class="tips" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i> {{ Lang::get('core.btn_view') }} </a></li>
							@endif
							@if($access['is_edit'] ==1)
							<li><a  href="{{ URL::to('studentteacher/update/'.$row->id.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i> {{ Lang::get('core.btn_edit') }} </a></li>
							@endif
						  </ul>
						</div>

					</td>

				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(SiteHelpers::filterColumn($limited ))
					 	  <?php $addClass= ($insort ==$field['field'] ? 'class="tbl-sorting-active" ' : ''); ?>
						 <td {!! $addClass !!} >					 
						 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}						 
						 </td>
						@endif	
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
	
@stop