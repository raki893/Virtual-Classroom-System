@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
<section class="content-header">
  <h1>
   <i class="fa  fa-file-text-o "></i>  {{ $pageTitle }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="{{ url('core/posts') }}"><i class="fa fa-files-o"></i>  PageCMS </a></li>
    <li class="active">All</li>
  </ol>
</section>



 <div class="content">

<div class="box box-success ">
	<div class="box-header with-border"> 
	    <div class="box-header-tools pull-left ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('core/pages/update') }}" class="tips btn btn-sm btn-default"  title="{{ Lang::get('core.btn_create') }}">
			<i class="fa  fa-plus"></i></a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="vcrDelete();" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o"></i></a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('core/pages/download') }}" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-cloud-download"></i></a>
			@endif			
		 
		</div> 

	</div>
	<div class="box-body "> 	
		
	
	
	 {!! Form::open(array('url'=>'core/pages/delete/', 'class'=>'form-horizontal' ,'id' =>'vcrTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;  padding-bottom: 70px;">
    <table class="table table-bordered table-hover  ">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
				
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
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->pageID }}" />  </td>		
					<td>
						<div class="dropdown">
						  <button class="btn btn-success btn-sm dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa  fa-cog"></i>
						  <span class="caret"></span></button>
						  <ul class="dropdown-menu">
						 	@if($access['is_detail'] ==1)
							<li>

								<a href="{{ url($row->alias)}}" class="tips" title="{{ Lang::get('core.btn_view') }}" target="_blank"><i class="fa  fa-search "></i> {{ Lang::get('core.btn_view') }} </a>
								
								</li>
								
							@endif
							@if($access['is_edit'] ==1)
							<li><a  href="{{ URL::to('core/pages/update/'.$row->pageID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i> {{ Lang::get('core.btn_edit') }} </a></li>
							@endif
						  </ul>
						</div>
					</td>											
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>	
					 	@if($field['field'] =='default')
					 		{!! $row->default == 1 ? '<i class="text-success fa fa-check-circle"></i>' : '<i class="text-danger fa fa-minus-circle"></i>'  !!}

					 	@else 
					 		{!! SiteHelpers::formatRows($row->{$field['field']},$field) !!}	
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
		$('#vcrTable').attr('action','{{ URL::to("core/pages/multisearch")}}');
		$('#vcrTable').submit();
	});
	
});	
</script>		
@stop