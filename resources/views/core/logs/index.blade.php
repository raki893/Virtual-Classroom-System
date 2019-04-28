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
     <li><a href="{{ url('core/logs') }}"><i class="fa fa-files-o"></i>  Logs </a></li>
    <li class="active">All</li>
  </ol>
</section>



 <div class="content">

<div class="box box-success ">
	<div class="box-header with-border">
		<div class="box-header-tools pull-left" >
 
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="vcrDelete();" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_remove') }}">
			<i class="fa fa-trash-o"></i></a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('core/logs/download') }}" class="tips btn btn-sm btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="fa fa-cloud-download"></i></a>
			@endif			
		</div>	
	</div>
	<div class="box-body "> 	
	
	
	 {!! Form::open(array('url'=>'core/logs/delete/', 'class'=>'form-horizontal' ,'id' =>'vcrTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
    <table class="table table-bordered table-hover">
        <thead>
			<tr>
				<th class="number"> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
				<th width="70" >{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->auditID }}" />  </td>									
				 @foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 <td>					 
					 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}					 
					 </td>
					 @endif					 
				 @endforeach
				 <td>
					 	@if($access['is_detail'] ==1)
						<a href="{{ URL::to('core/logs/show/'.$row->auditID.'?return='.$return)}}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search "></i></a>
						@endif
						@if($access['is_edit'] ==1)
						<a  href="{{ URL::to('core/logs/update/'.$row->auditID.'?return='.$return) }}" class="tips btn btn-xs btn-white" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i></a>
						@endif
												
					
				</td>				 
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
		$('#vcrTable').attr('action','{{ URL::to("logs/multisearch")}}');
		$('#vcrTable').submit();
	});
	
});	
</script>		
@stop