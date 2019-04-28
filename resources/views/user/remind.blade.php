@extends('layouts.login')

@section('content')
<div class="container">
<div class="login-box">


	<div class="box" style="border: none !important">
		<div class="box-header box-with-header" style="padding-left: 40px;"  > 
				
		</div>
		<div class="box-body  no-padding" >

		<h3 class="login-title"> Reset My Password  </h3>
			<div class="login-box-body" >

		
				<p class="message alert alert-danger " style="display:none;"></p>	
		 
			{!! Form::open(array('url' => 'user/doreset/'.$verCode, 'class'=>'form-vertical sky-form boxed')) !!}

				    	@if(Session::has('message'))
							{!! Session::get('message') !!}
						@endif

			<ul class="parsley-error-list">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>	


				<div class="form-group has-feedback animated fadeInLeft delayp1">
					{!! Form::password('password',  array('class'=>'form-control', 'placeholder'=>'New Password')) !!}				
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback animated fadeInLeft delayp1">
					{!! Form::password('password_confirmation', array('class'=>'form-control', 'placeholder'=>'Confirm Password')) !!}
					<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
				</div>

				<div class="form-group has-feedback animated fadeInLeft delayp1">
					<label>	</label>
					<button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-check"></i> Do Reset </button>
				</div>			
				 {!! Form::close() !!}	


			</div>
		</div>

		<div class="box-footer" style="">
			<a href="{{url('')}}" > {{ Lang::get('core.backtosite') }} </a>				

		</div>
	</div>
</div>			
</div>

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