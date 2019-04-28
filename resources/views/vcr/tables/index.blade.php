@extends('layouts.app')

@section('content')
  <script type="text/javascript" src="{{ asset('vcr/js/simpleclone.js') }}"></script>
    <section class="content-header">
      <h1>   Database <small> Manage tables </small></h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
        <li  class="active"> Database </li>
      </ol>
    </section>

  <div class="content"> 

 		<div class="ajaxLoading"></div>
<div class="box box-primary">
	<div class="box-header with-border"> 
			<div class="box-header-tools pull-left">	
				<a href="{{ url('vcr/tables/tableconfig/')}}" class="btn btn-sm btn-default linkConfig tips" title="New Table "><i class="fa fa-plus"></i> </a>
				<a href="{{ url('vcr/tables/mysqleditor/')}}" class="btn btn-sm btn-default linkConfig tips" title="MySQL Editor"><i class="fa fa-pencil"></i>  </a>
			</div>	
			</div>
			<div class="box-body">

			

			<div class="row">
				<div class="col-md-3">
					{!! Form::open(array('url'=>'vcr/tables/tableremove/', 'class'=>'form-horizontal','id'=>'removeTable' )) !!}
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									
									<th width="30"> <input type="checkbox" class="checkall i-checks-all " /></th>
									<th> Table Name </th>
									<th width="50"> Action </th>
								</tr>
							</thead>
							<tbody>
							@foreach($tables as $table)
								<tr>
									<td><input type="checkbox" class="ids  i-checks" name="id[]" value="{{ $table }}" /> </td>
									<td><a href="{{ URL::TO('vcr/tables/tableconfig/'.$table)}}" class="linkConfig" > {{ $table }}</a></td>
									<td>
									<a href="javascript:void(0)" onclick="droptable()" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i></a>
									</td>
								</tr>
							@endforeach
							</tbody>
						
						</table>
					
					</div>
					{!! Form::close() !!}		
				</div>
				<div class="col-md-9">
					
					<div class="tableconfig" style="background:#fff; padding:10px; min-height:300px; border:solid 1px #ddd;">

					</div>

				</div>

			</div>
		</div>
		</div>
	
	
</div>	  
<script type="text/javascript">
$(document).ready(function(){

	$('.linkConfig').click(function(){
		$('.ajaxLoading').show();
		var url =  $(this).attr('href');
		$.get( url , function( data ) {
			$( ".tableconfig" ).html( data );
			$('.ajaxLoading').hide();
			
			
		});
		return false;
	});
});

function droptable()
{
	if(confirm('are you sure remove selected table(s) ?'))
	{
		$('#removeTable').submit();
	} else {
		return false;
	}
}

</script>
@endsection