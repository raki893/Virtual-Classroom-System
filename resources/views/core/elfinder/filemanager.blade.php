@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>
   <i class="fa  fa-folder-o "></i>  {{ $pageTitle }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
     <li><a href="{{ url('core/elfinder') }}"><i class="fa fa-folder-o"></i>  My Files </a></li>
    <li class="active">All Folder & Files </li>
  </ol>
</section>



 <div class="content">

	<div class="box box-success ">
		<div class="box-header with-border"> My Files </div>
		<div class="box-body">
			<div id="elfinder"></div>
		</div>
	</div>
</div>	



<script src="http://code.jquery.com/jquery-migrate-1.0.0.js"></script>
<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/pepper-grinder/jquery-ui.css" />
<script type="text/javascript" src="{{ asset('vcr/js/plugins/elfinder/js/elfinder.min.js') }}"></script>
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('vcr/js/plugins/elfinder/css/elfinder.min.css')}}" />
<link rel="stylesheet" type="text/css" media="screen" href="{{ asset('vcr/js/plugins/elfinder/css/theme.css')}}" />




<script type="text/javascript" charset="utf-8">
    $().ready(function() {
        var elf = $('#elfinder').elfinder({
            // lang: 'ru',             // language (OPTIONAL)
            url : '{{ url("core/elfinder") }}'  ,// connector URL (REQUIRED)
			height:500,
        }).elfinder('instance');            
    });
</script>
@stop