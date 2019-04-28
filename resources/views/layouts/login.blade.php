<?php $vcrconfig  = config('vcr');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $vcrconfig['cnf_appname']  }}</title>
<link rel="shortcut icon" href="{{ asset('favicon.ico')}}" type="image/x-icon">

		<link rel="stylesheet" href="{{ asset('adminlte')}}/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link href="{{ asset('vcr/js/plugins/toastr/toastr.css')}}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('adminlte')}}/dist/css/AdminLTE.css">
		 <link href="{{ asset('vcr/css/vcr5.css')}}" rel="stylesheet">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		   folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="{{ asset('adminlte')}}/dist/css/skins/_all-skins.min.css">
		 <link rel="stylesheet" href="{{ asset('adminlte')}}/plugins/iCheck/flat/blue.css">
		   <link rel="stylesheet" href="{{ asset('adminlte')}}/plugins/iCheck/square/blue.css">


		<script src="{{ asset('adminlte')}}/plugins/jQuery/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="{{ asset('vcr/js/plugins/parsley.js') }}"></script>			
		<script src="{{ asset('adminlte')}}/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="{{ asset('vcr/js/plugins/jquery.form.js') }}"></script>	
		<script type="text/javascript" src="{{ asset('vcr/js/plugins/toastr/toastr.js') }}"></script>

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	

		<script src="{{ asset('adminlte')}}/plugins/iCheck/icheck.min.js"></script>
	
	
  	</head>

	<body class="hold-transition login-page" style="background: #364150  ">
		@yield('content')	
	</body>


</body> 
</html>