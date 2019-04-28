@extends('layouts.app')

@section('content')


    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('vcr/config') }}"><i class="fa fa-th"></i> Configuration</a></li>
        <li  class="active"> {{ $pageTitle }} </li>
      </ol>
    </section>

  <div class="content">
	@if(Session::has('message'))
	  
		   {{ Session::get('message') }}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		

			

<div class="box box-primary">
	<div class="box-header with-border">  {{ $pageTitle }}  </div>
	<div class="box-body"> 

	@include('vcr.config.tab')
 {!! Form::open(array('url'=>'vcr/config/login/', 'class'=>'form-horizontal')) !!}

	<div class="col-sm-6">
		

 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4">  {{ Lang::get('core.fr_emailsys') }}  </label>	
			<div class="col-sm-8">
					
					<label class="radio">
					<input type="radio" name="CNF_MAIL" value="phpmail" class="minimal-red"  @if($vcrconfig['cnf_mail'] =='phpmail') checked @endif /> 
					PHP MAIL System
					</label>
					
					<label class="radio">
					<input type="radio" name="CNF_MAIL" value="swift" class="minimal-red"  @if($vcrconfig['cnf_mail'] =='swift') checked @endif /> 
					SWIFT Mail ( Required Configuration )
					</label>			
			</div>
		</div>					
  
		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_registrationdefault') }}  </label>	
			<div class="col-sm-8">
					<div >
						
						<select class="form-control" name="CNF_GROUP">
							@foreach($groups as $group)
							<option value="{{ $group->group_id }}"
							 @if($vcrconfig['cnf_group'] == $group->group_id ) selected @endif
							>{{ $group->name }}</option>
							@endforeach
						</select>
						
					</div>				
			</div>	
					
		  </div> 

		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4">{{ Lang::get('core.fr_registration') }} </label>	
			<div class="col-sm-8">
					
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="auto" @if($vcrconfig['cnf_activation'] =='auto') checked @endif class="minimal-red"  /> 
					{{ Lang::get('core.fr_registrationauto') }}
					</label>
					
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="manual" @if($vcrconfig['cnf_activation'] =='manual') checked @endif class="minimal-red"  /> 
					{{ Lang::get('core.fr_registrationmanual') }}
					</label>								
					<label class="radio">
					<input type="radio" name="CNF_ACTIVATION" value="confirmation" @if($vcrconfig['cnf_activation'] =='confirmation') checked @endif class="minimal-red"  />
					{{ Lang::get('core.fr_registrationemail') }}
					</label>	
				
							
			</div>	
					
		  </div> 
		  
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_allowregistration') }} </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_REGIST" value="true"  @if($vcrconfig['cnf_regist'] =='true') checked @endif class="minimal-red"  /> 
					{{ Lang::get('core.fr_enable') }}
					</label>			
			</div>
		</div>	
		
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_allowfrontend') }} </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_FRONT" value="false" @if($vcrconfig['cnf_front'] =='true') checked @endif class="minimal-red"  /> 
					{{ Lang::get('core.fr_enable') }}
					</label>			
			</div>
		</div>		
	
 		  <div class="form-group">
			<label for="ipt" class=" control-label col-sm-4"> Captcha </label>	
			<div class="col-sm-8">
					<label class="checkbox">
					<input type="checkbox" name="CNF_RECAPTCHA" value="false" @if($vcrconfig['cnf_recaptcha'] =='true') checked @endif class="minimal-red"  /> 
					{{ Lang::get('core.fr_enable') }}
					</label>	
										
			</div>
		</div>		
		
		  		  
	  <div class="form-group">
		<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
		<div class="col-md-8">
			<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
		 </div> 
	 
	  </div>	  
	
 </div>

	<div class="col-sm-6">
	
					<div class="form-vertical">
						<div class="form-group">
							<label> {{ Lang::get('core.fr_restrictip') }} </label>	
							
							<p><small><i>
								
								{{ Lang::get('core.fr_restrictipsmall') }}  <br />
								{{ Lang::get('core.fr_restrictipexam') }} : <code> 192.116.134 , 194.111.606.21 </code>
							</i></small></p>
							<textarea rows="5" class="form-control" name="CNF_RESTRICIP">{{ $vcrconfig['cnf_restrictip'] }}</textarea>
						</div>
						
						<div class="form-group">
							<label> {{ Lang::get('core.fr_allowip') }} </label>	
							<p><small><i>
								
								{{ Lang::get('core.fr_allowipsmall') }}  <br />
								{{ Lang::get('core.fr_allowipexam') }} : <code> 192.116.134 , 194.111.606.21 </code>
							</i></small></p>							
							<textarea rows="5" class="form-control" name="CNF_ALLOWIP">{{ $vcrconfig['cnf_allowip'] }}</textarea>
						</div>

						<p> {{ Lang::get('core.fr_ipnote') }} </p>
					</div>	
							


	 </div>
 {!! Form::close() !!}
</div>
</div>
</div>

@stop




