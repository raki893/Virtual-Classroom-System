@extends('layouts.login')

@section('content')
<div class="container">
<div class="login-box">

	<div class="box" style="border: none !important;">
		<div class="box-header box-with-header" style="padding-left: 40px;"  > 
				
		</div>
		<div class="box-body  no-padding" >
			<h3 class="login-title"> Sign Up </h3>
  <div class="login-box-body">

   
		<div class="ajaxLoading"></div>

 {!! Form::open(array('url'=>'user/create', 'class'=>'form-signup', 'parsley-validate'=>'','novalidate'=>' ')) !!}
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	
	<div class="form-group has-feedback">
	  {!! Form::text('username', null, array('class'=>'form-control', 'placeholder'=> Lang::get('core.username') ,'required'=>'' )) !!}
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group has-feedback">
			  {!! Form::text('firstname', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.firstname') ,'required'=>'' )) !!}
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
		</div>
		
		<div class="col-md-6">	
	
			<div class="form-group has-feedback">
			 {!! Form::text('lastname', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.lastname'),'required'=>'')) !!}
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
		</div>
	</div>	

	<div class="form-group has-feedback">
	 	{!! Form::text('email', null, array('class'=>'form-control', 'placeholder'=>Lang::get('core.email'),'required'=>'email')) !!}
		 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</div>		

	<div class="row">
		<div class="col-md-6">
			<div class="form-group has-feedback">
			 {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>Lang::get('core.password'),'required'=>'')) !!}
				 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group has-feedback">
			 {!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>Lang::get('core.repassword'),'required'=>'')) !!}
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>

		</div>
	</div>		
	

    @if(config('vcr')['cnf_recaptcha'] =='true') 
    <div class="form-group has-feedback  animated fadeInLeft delayp1">
        <label class="text-left"> Are u human ? </label>    
        <br />
        {!! captcha_img() !!} <br /><br />
        <input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>

        <div class="clr"></div>
    </div>
    @endif		
    	 <div class="row">
	        <div class="col-xs-8">
	          <div class="checkbox icheck">
	            <label>
	              
	            </label>
	          </div>
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat"> {{ Lang::get('core.signup') }}</button>
	        </div>
	        <!-- /.col -->
	      </div>

	  
 {!! Form::close() !!}

	</div>
</div>
<div class="box-footer">
	  <a href="{{ URL::to('user/login')}}"> {{ Lang::get('core.signin') }}  </a> | <a href="{{ URL::to('')}}"> {{ Lang::get('core.backtosite') }}  </a> 
   		</div>

</div></div></div>
<style type="text/css">
	.login-title{
	    color: #32c5d2 ;
	    font-size: 30px;
	    font-weight: 400 !important;
	    text-align: center;
	}
	.box-footer { background: #6c7a8d;  text-align: center; color: #fff; }
	.box-footer a{ color: #fff;  }
</style>
@stop
