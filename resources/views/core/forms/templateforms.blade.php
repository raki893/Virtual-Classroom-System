<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Hello Admin , </h2>
		<p> You have new submited form   </p>
		
		<div style="border:solid 1px #ddd; padding: 10px;">
			{!! $message !!}
		</div>

		<p> Thank You </p><br /><br />
		
		{{ $vcrconfig['cnf_appname'] }} 
	</body>
</html>