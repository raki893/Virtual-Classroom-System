@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1>{{ $pageTitle }}
    <small>{{ $pageNote }}</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{ $pageTitle }} </li>
  </ol>
</section>



 <div class="content">

	<div class="box box-primary">
	  	<div class="box-header with-border">  {{ $pageTitle }} </div>
	    <div class="box-body">
	    	<?php echo $content ;?>
	    </div>
	</div>

</div>    





@stop