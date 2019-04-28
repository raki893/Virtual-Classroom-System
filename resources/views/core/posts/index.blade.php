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
         <li><a href="{{ url('core/pages') }}"><i class="fa fa-file-text-o"></i>  Post Article </a></li>
        <li class="active">All</li>
      </ol>
    </section>



 <div class="content">

		<ul class="nav nav-tabs " style="border-bottom: none !important" >
		  <li class="active"><a href="#info" data-toggle="tab"><i class="fa  fa-info-circle"></i> All Posts </a></li>
		  <li ><a href="#config" data-toggle="tab"><i class="fa fa-cog"></i> Post Setting </a></li>
		</ul>

	<div class="tab-content">
		  <div class="tab-pane active" id="info">



			<div class="box box-info ">
				<div class="box-header with-border"> 
					<div class="box-header-tools pull-left" >
						@if($access['is_add'] ==1)
				   		<a href="{{ URL::to('core/posts/update?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_create') }}">
						<i class="fa  fa-plus "></i></a>
						@endif  
						@if($access['is_remove'] ==1)
						<a href="javascript://ajax"  onclick="vcrDelete();" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_remove') }}">
						<i class="fa fa-trash-o"></i></a>
						@endif 
						<a href="{{ URL::to( 'core/posts/search') }}" class="btn btn-xs btn-default" onclick="vcrModal(this.href,'Advance Search'); return false;" title="{{ Lang::get('core.btn_search') }}"><i class="fa  fa-search"></i> </a>	
						<span class="label label-warning"> Beta Version <sup>1.0</sup></span>	
							


					</div>

					<div class="box-header-tools pull-right" >
						@if($access['is_excel'] ==1)
						<a href="{{ URL::to('core/posts/download?return='.$return) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
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
				
				 {!! Form::open(array('url'=>'core/posts/delete?return='.$return, 'class'=>'form-horizontal' ,'id' =>'vcrTable' )) !!}
				 <div class="table-responsive" style="min-height:300px;  padding-bottom:60px;">
			    <table class="table table-bordered table-hover ">
			        <thead>
						<tr>
							<th class="number"><span> No </span> </th>
							<th> <input type="checkbox" class="checkall" /></th>
							<th ><span>{{ Lang::get('core.btn_action') }}</span></th>
							
							@foreach ($tableGrid as $t)
								@if($t['view'] =='1')				
									<?php $limited = isset($t['limited']) ? $t['limited'] :''; ?>
									@if(SiteHelpers::filterColumn($limited ))
									
										<th><span>{{ $t['label'] }}</span></th>			
									@endif 
								@endif
							@endforeach
							
						  </tr>
			        </thead>

			        <tbody>        						
			            @foreach ($rowData as $row)
			                <tr>
								<td width="30"> {{ ++$i }} </td>
								<td width="50"><input type="checkbox" class="ids" name="ids[]" value="{{ $row->pageID }}" />  </td>	
								<td>
								 	<div class="dropdown">
									  <button class="btn btn-success btn-sm  dropdown-toggle" type="button" data-toggle="dropdown"> <i class="fa  fa-cog"></i>
									  <span class="caret"></span>
									 </button>
									  <ul class="dropdown-menu">
									 	@if($access['is_detail'] ==1)
										<li><a href="{{ url('post/view/'. $row->pageID.'/'.$row->alias)}}" class="tips" title="{{ Lang::get('core.btn_view') }}" target="_blank"><i class="fa  fa-search "></i> {{ Lang::get('core.btn_view') }} </a></li>
										@endif
										@if($access['is_edit'] ==1)
										<li><a  href="{{ URL::to('core/posts/update/'.$row->pageID.'?return='.$return) }}" class="tips" title="{{ Lang::get('core.btn_edit') }}"><i class="fa fa-edit "></i> {{ Lang::get('core.btn_edit') }} </a></li>
										@endif
									  </ul>
									</div>

								</td>

							 @foreach ($tableGrid as $field)
								 @if($field['view'] =='1')
								 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
								 	@if(SiteHelpers::filterColumn($limited ))
									 <td>	
								 	@if($field['field'] =='status')
								 		{!! $row->status == 'enable' ? '<i class="text-success fa fa-check-circle"></i>' : '<i class="text-danger fa fa-minus-circle"></i>'  !!}

								 	@else 						 				 
									 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}
									@endif 							 
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

		   <div class="tab-pane" id="config">

			<div class="box box-primary ">
				<div class="box-header with-border"> Post Configuration </div>
				<div class="box-body"> 

				{!! Form::open(array('url'=>'core/posts/config', 'class'=>'form-horizontal' ,'id' =>'' )) !!}
				 <div class="form-group  " >
						<label class="col-md-4" > Allow Comment system    </label>
						<div class="col-md-8">									
					  		<input type="checkbox" name="commsys" class="checkbox minimal-red" value="1"
					  		@if($conpost['commsys'] ==1) checked @endif
					  		 />	
					  	</div>					
				  </div> 
				 <div class="form-group  " >
						<label class="col-md-4" > Display Image in every post(s)   </label>	
						<div class="col-md-8">								
					  		<input type="checkbox" name="commimage" class="checkbox minimal-red" value="1"
					  		@if($conpost['commimage'] ==1) checked @endif
					  		 />
					  	</div>						
				  </div> 
				 <div class="form-group  " >
						<label class="col-md-4" > Display Latest post(s)   </label>	
						<div class="col-md-8">								
					  		<input type="checkbox" name="commlatest" class="checkbox minimal-red" value="1"
					  		@if($conpost['commlatest'] ==1) checked @endif
					  		 />
					  	</div>						
				  </div>

				 <div class="form-group  " >
						<label class="col-md-4" > Display Popular post(s)   </label>	
						<div class="col-md-8">								
					  		<input type="checkbox" name="commpopular" class="checkbox minimal-red" value="1" 
					  		@if($conpost['commpopular'] ==1) checked @endif
					  		/>
					  	</div>						
				  </div>				  

				 <div class="form-group  " >
						<label class="col-md-4" > Allow Share post(s) :    </label>	
						<div class="col-md-8">								
					  		<input type="checkbox" name="commshare" class="checkbox minimal-red" value="1" 
					  		@if($conpost['commshare'] ==1) checked @endif
					  		/>
					  	</div>							
				  </div> 
				  	  	

				 <div class="form-group  " >
						<label class="col-md-4" > Display post(s) per/page  </label>
						<div class="col-md-8">									
					  		<input type="text" name="commperpage" class="form-control" style="width: 50px;" value="{{ $conpost['commperpage'] }}" />
					  	</div>							
				  </div> 
				 <div class="form-group  " >
						<label class="col-md-4" >   </label>
						<div class="col-md-8">									
					  		<button type="submit" class="btn btn-primary"> Save Configuration </button>
					  	</div>							
				  </div> 

				  {!! Form::close() !!}
			</div>	
			</div>  


		</div>
	</div>  
</div>	


@stop