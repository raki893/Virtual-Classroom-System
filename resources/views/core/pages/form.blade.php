@extends('layouts.app')

@section('content')
<section class="content-header">
  <h1>
   <i class="fa  fa-file-text-o "></i>  {{ $pageTitle }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="{{ url('core/posts') }}"><i class="fa fa-files-o"></i>  PageCMS </a></li>
    <li class="active">Edit / Update</li>
  </ol>
</section>



 <div class="content">

<div class="box box-danger ">
	<div class="box-header with-border"> 
				<div class="box-header-tools pull-left" >
					<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_back') }}" ><i class="fa  fa-arrow-left"></i></a> 
				</div>
				<div class="box-header-tools pull-right" >
					@if(Session::get('gid') ==1)
						<a href="{{ URL::to('vcr/module/config/pages') }}" class="tips btn btn-xs btn-default" title=" {{ Lang::get('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
					@endif 			
				</div> 
			 </div>	
			<div class="box-body">	

			@if(Session::has('message'))	  
				   {{ Session::get('message') }}
			@endif	
			
			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		 {!! Form::open(array('url'=>'core/pages/save', 'class'=>'form-vertical row ','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}			

			<div class="col-sm-9 ">
	

						<ul class="nav nav-tabs" >
						  <li class="active"><a href="#info" data-toggle="tab"> Page Content </a></li>
						  <li ><a href="#meta" data-toggle="tab"> Meta & Description </a></li>
						</ul>	

						<div class="tab-content">
						  <div class="tab-pane active m-t" id="info">
				  <div class="form-group  " >
					<label for="ipt" > Title </label>
					
					  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" class=" btn-primary  btn btn-sm">  {!! url('')!!}/  </label>						 
						{!! Form::text('alias', $row['alias'],array('class'=>'form-control', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;'   )) !!} 
				  </div> 

							  <div class="form-group  " >
								
								<div class="" style="background:#fff;">
								  <textarea name='note' rows='35' id='note'    class='form-control editor'  
									 >{{ $row['note'] }}</textarea> 
								 </div> 
							  </div> 						  

						  </div>

						  <div class="tab-pane m-t" id="meta">

					  		<div class="form-group  " >
								<label class=""> Metakey </label>
								<div class="" style="background:#fff;">
								  <textarea name='metakey' rows='5' id='metakey' class='form-control markItUp'>{{ $row['metakey'] }}</textarea> 
								 </div> 
							  </div> 

				  			<div class="form-group  " >
								<label class=""> Meta Description </label>
								<div class="" style="background:#fff;">
								  <textarea name='metadesc' rows='10' id='metadesc' class='form-control markItUp'>{{ $row['metadesc'] }}</textarea> 
								 </div> 
							  </div> 							  						  

						  </div>

						</div>  
		 	</div>		 
		 
		 	<div class="col-sm-3 ">
					
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>
					
					  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					
				  </div> 					
					

				  <div class="form-group  " >
				  <label for="ipt"> Who can view this page ? </label>
					@foreach($groups as $group) 
					<label class="checkbox">					
					  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}"
					  @if($group['access'] ==1 or $group['id'] ==1)
					  	checked
					  @endif	
					  class="minimal-red" 			 
					   /> 
					  {{ $group['name'] }}
					</label>  
					@endforeach	
						  
				  </div> 
				  <div class="form-group  " >
					<label> Show for Guest ? unlogged  </label>
					<label class="checkbox"><input  type='checkbox' name='allow_guest'  class="minimal-red" 
 						@if($row['allow_guest'] ==1 ) checked  @endif	
					   value="1"	/> Allow Guest ?  </lable>
				  </div>


				  	
	
				  <div class="form-group  " >
					<label> Status </label>
					<label class="radio">					
					  <input  type='radio' name='status'  value="enable" required class="minimal-red" 
					  @if( $row['status'] =='enable')  	checked	  @endif				  
					   /> 
					  Enable
					</label> 
					<label class="radio">					
					  <input  type='radio' name='status'  value="disabled" required class="minimal-red" 
					   @if( $row['status'] =='disabled')  	checked	  @endif				  
					   /> 
					  Disabled
					</label> 					 
				  </div> 

				  <div class="form-group  " >
					<label> Template </label>
					<label class="radio">					
					  <input  type='radio' name='template'  value="frontend" required class="minimal-red" 
					  @if( $row['template'] =='frontend')  	checked	  @endif				  
					   /> 
					  Frontend
					</label> 
					<label class="radio">					
					  <input  type='radio' name='template'  value="backend" required class="minimal-red" 
					   @if( $row['template'] =='backend')  	checked	  @endif				  
					   /> 
					  Backend
					</label> 					 
				  </div> 	

				  <div class="form-group  " >
					<label> Set As Homepage ? </label>
					<label class="checkbox"><input  type='checkbox' name='default' class="minimal-red" 
 						@if($row['default'] ==1 ) checked  @endif	
					   value="1"	/> Yes  
					</lable>					 
				  </div> 
				  <div class="form-group  " >
					<label for="ipt" > Page Template </label>

					<select class="form-control" name="filename">
						<option value="page"> Select Template </option>
						@foreach($pagetemplate['template'] as $key=> $val)
							<option value="{{ $val }}" @if($row['filename'] == $val) selected @endif>{{ $key}}</option>
						@endforeach


					</select>
					
					  
					
				  </div> 

				  
			  <div class="form-group">
				
				<button type="submit" class="btn btn-success " name="apply">  Apply </button>
				<button type="submit" class="btn btn-primary ">  Submit </button>
				<a href="{{ url('core/pages')}}" class="btn btn-info"> Cancel </a>
				 
		
			  </div> 
						  				  
				  		
			</div>
			 {!! Form::close() !!}
			<div style="clear: both;"></div>
			</div>
		</div>

		
	

</div>	
			 	 
@stop