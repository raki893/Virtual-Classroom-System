<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual classroom system</title>

    <link href="{{ asset('frontend')}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('frontend')}}/css/font-awesome.min.css" rel="stylesheet"> 
    <link href="{{ asset('frontend')}}/css/style.css" rel="stylesheet"> 
  </head>
	<body>
		<section id="login_page">
			<div class="wrapper">
				<div class="container head_txt">
					<h1>Welcome to Virtual Classroom System</h1>
                    
                    
@extends('layouts.login')

@section('content')
<div class="container">
<div class="login-box">
	

	<div class="box" style="border: none !important">

		<div class="box-body  no-padding" >
			
  <div class="login-box-body" >
  	<div class="row">

	<div class="col-md-12">   	

    
		<div class="ajaxLoading"></div>
		<p class="message alert alert-danger " style="display:none;"></p>	
 
	    	@if(Session::has('message'))
				{!! Session::get('message') !!}
			@endif
		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	
		

		<div id="login-area">

			

	   	   {!! Form::open(array('url'=> 'user/signin', 'class'=>'form-vertical','id' => 'LoginAjax' , 'parsley-validate'=>'','novalidate'=>' ')) !!}
	      <div class="form-group has-feedback">
	       <input type="text" name="email" placeholder="{{ Lang::get('core.email') }}" class="form-control" required="email" />
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	       <input type="password" name="password" placeholder="{{ Lang::get('core.password') }}" class="form-control" required="true" />
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>

			@if(config('vcr')['cnf_recaptcha'] =='true') 
			<div class="form-group has-feedback ">
				<label class="text-left"> Are u human ? </label>	
				<br />
				{!! captcha_img() !!} <br /><br />
				<input type="text" name="captcha" placeholder="Type Security Code" class="form-control" required/>
				
				<div class="clr"></div>
			</div>	
		 	@endif	
		 	


	      <div class="row">
	        <div class="col-xs-8">
	         
	        </div>
	        <!-- /.col -->
	        <div class="col-xs-4">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">{{ Lang::get('core.signin') }}</button>
	        </div>
	        <!-- /.col -->
	      </div>
	



    
    </div>




	</div>     




 </div></div>
	
	</div>	


	
</div>

</div>


<script type="text/javascript">
	$(document).ready(function(){
		$('#forgot-area').hide();
		$('.forgot-button').click(function(){
			$('#login-area').toggle();
			$('#forgot-area').toggle();
		});

		var form = $('#LoginAjax'); 
		form.parsley();
		form.submit(function(){
			
			if(form.parsley('isValid') == true){			
				var options = { 
					dataType:      'json', 
					beforeSubmit :  showRequest,
					success:       showResponse  
				}  
				$(this).ajaxSubmit(options); 
				return false;
							
			} else {
				return false;
			}		
		
		});

	});

function showRequest()
{
	$('.ajaxLoading').show();		
}  
function showResponse(data)  {		
	
	if(data.status == 'success')
	{
		window.location.href = data.url;	
		$('.ajaxLoading').hide();
	} else {
		$('.message').html(data.message)	
		$('.ajaxLoading').hide();
		$('.message').show(data.message)	
		return false;
	}	
}	
</script>

@stop
                    
                    
                    
                    
                    
                    
                    
                    
					
				<!--	<form class="form custom_form">
						<input type="text" placeholder="Username">
						<input type="password" placeholder="Password">
						<button type="submit" id="login-button">Login</button>
					</form> -->
				
				
				<ul class="bg-bubbles">
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
		</section>
        
        
        </div>
        
<style>
.login-box, .register-box {
    position: relative;
    z-index: 100;
    margin-top: -443px !important;
}
button.btn.btn-primary.btn-block.btn-flat {
    font-size: 12px;
}
input.form-control.parsley-validated {
    height: 40px;
    font-size: 13px;
}

.wrapper {
    height: 700px;
    }
        
</style>
		<script src="{{ asset('frontend')}}/js/jquery.min.js"></script>
		<script src="{{ asset('frontend')}}/js/bootstrap.min.js"></script>
		<script src="{{ asset('frontend')}}/js/main.js"></script>
	</body>
</html>