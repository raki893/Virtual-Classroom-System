@extends('layouts.app')


@section('content')
    <section class="content-header">
      <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li  class="active"> Configuration </li>
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
	<div class="box-header with-border"> {{ $pageTitle }}  </div>
  <div class="box-body"> 
  		@include('vcr.config.tab')
		 {!! Form::open(array('url'=>'vcr/config/save/', 'class'=>'form-horizontal row', 'files' => true)) !!}

		<div class="col-sm-6 animated fadeInRight ">
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appname') }} </label>
			<div class="col-md-8">
			<input name="cnf_appname" type="text" id="cnf_appname" class="form-control input-sm" required  value="{{ $vcrconfig['cnf_appname'] }}" />  
			 </div> 
		  </div>  
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_appdesc') }} </label>
			<div class="col-md-8">
			<input name="cnf_appdesc" type="text" id="cnf_appdesc" class="form-control input-sm" value="{{ $vcrconfig['cnf_appdesc'] }}" /> 
			 </div> 
		  </div>  
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_comname') }} </label>
			<div class="col-md-8">
			<input name="cnf_comname" type="text" id="cnf_comname" class="form-control input-sm" value="{{ $vcrconfig['cnf_comname'] }}" />  
			 </div> 
		  </div>      

		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_emailsys') }} </label>
			<div class="col-md-8">
			<input name="cnf_email" type="text" id="cnf_email" class="form-control input-sm" value="{{ $vcrconfig['cnf_email'] }}" /> 
			 </div> 
		  </div>   
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.fr_multilanguage') }} <br />  </label>
			<div class="col-md-8">
				<div class="checkbox">
					<input name="cnf_multilang" type="checkbox" id="cnf_multilang" value="1" class="minimal-red" 
					@if($vcrconfig['cnf_multilang'] ==1) checked @endif
					  />  {{ Lang::get('core.fr_enable') }} 
				</div>	
			 </div> 
		  </div> 
		     
		   <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_mainlanguage') }} </label>
			<div class="col-md-8">

					<select class="form-control" name="cnf_lang">

					@foreach(SiteHelpers::langOption() as $lang)
						<option value="{{  $lang['folder'] }}"
						@if($vcrconfig['cnf_multilang'] ==$lang['folder']) selected @endif
						>{{  $lang['name'] }}</option>
					@endforeach
				</select>
			 </div> 
		  </div>   
		      

		   <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">{{ Lang::get('core.fr_fronttemplate') }}</label>
			<div class="col-md-8">
					
					<select class="form-control" name="cnf_theme">

					@foreach(SiteHelpers::themeOption() as $t)
						<option value="{{  $t['folder'] }}"
						@if($vcrconfig['cnf_theme'] ==$t['folder']) selected @endif
						>{{  $t['name'] }}</option>
					@endforeach
				</select>
			 </div> 
		  </div> 

		  <div class="form-group hide">
		    <label for="ipt" class=" control-label col-md-4"> Development Mode ?   </label>
			<div class="col-md-8">
				<div class="checkbox">
					<input name="cnf_mode" type="checkbox" id="cnf_mode" value="1"
					@if ($vcrconfig['cnf_mode'] =='production') checked @endif
					  />  Production
				</div>
				<small> If you need to debug mode , please unchecked this option </small>	
			 </div> 
		  </div> 		  
		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">&nbsp;</label>
			<div class="col-md-8">
				<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }} </button>
			 </div> 
		  </div> 
		</div>

		<div class="col-sm-6 animated fadeInRight ">

		  
		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4"> {{ Lang::get('core.fr_dateformat') }} </label>
			<div class="col-md-8">
				<select class="form-control" name="cnf_date">
				<?php $dates = array(
						'Y-m-d'=>' ( Y-m-d ) . Example : '.date('Y-m-d'),
						'Y/m/d'=>' ( Y/m/d ) . Example : '.date('Y/m/d'),
						'd-m-y'=>' ( D-M-Y ) . Example : '.date('d-m-y'),
						'd/m/y'=>' ( D/M/Y ) . Example : '.date('d/m/y'),
						'm-d-y'=>' ( m-d-Y ) . Example : '.date('m-d-Y'),
						'm/d/y'=>' ( m/d/Y ) . Example : '.date('m/d/Y'),
					  );
				foreach($dates as $key=>$val) {?>
					<option value="{{  $key }}"
					@if(defined('CNF_DATE') && CNF_DATE ==$key) selected @endif
					>{{  $val }}</option>

				<?php } ?>
				</select>
			 </div> 
		  </div>  			

		  <div class="form-group">
		    <label for="ipt" class=" control-label col-md-4">Metakey </label>
			<div class="col-md-8">
				<textarea class="form-control input-sm" name="cnf_metakey">{{ $vcrconfig['cnf_metakey'] }}</textarea>
			 </div> 
		  </div> 

		   <div class="form-group">
		    <label  class=" control-label col-md-4">Meta Description</label>
			<div class="col-md-8">
				<textarea class="form-control input-sm"  name="cnf_metadesc">{{ $vcrconfig['cnf_metadesc'] }}</textarea>
			 </div> 
		  </div>  

		   <div class="form-group">
		    <label  class=" control-label col-md-4">{{ Lang::get('core.fr_backendlogo') }}</label>
			<div class="col-md-8">
				<input type="file" name="logo">
				<p> <i>Please use image dimension 155px * 30px </i> </p>
				<div style="padding:5px; border:solid 1px #ddd; background:#f5f5f5; width:auto;">
				 	@if(file_exists(public_path().'/vcr/images/'.$vcrconfig['cnf_logo']) && $vcrconfig['cnf_logo'] !='')
				 	<img src="{{ asset('vcr/images/'.$vcrconfig['cnf_logo'])}}" alt="{{ $vcrconfig['cnf_appname'] }}" />
				 	@else
					<img src="{{ asset('vcr/images/logo.png')}}" alt="{{ $vcrconfig['cnf_appname'] }}" />
					@endif	
				</div>				
			 </div> 
		  </div>  		  

		</div>  
		 {!! Form::close() !!}
	</div>
	</div>	 
</div>








@stop