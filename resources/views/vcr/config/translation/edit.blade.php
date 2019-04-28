@extends('layouts.app')

@section('content')

<section class="content-header">
  <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">All</li>
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
	
    <!-- Page header -->
	<div class="box box-primary ">
		<div class="box-header with-border"> 
			<div class="box-header-tools pull-left" >
				Languange Manager
			</div>
		</div>
		<div class="box-body">
		@include('vcr.config.tab',array('active'=>'translation'))
		 	
			<div class="col-sm-8">
				<ul class="nav nav-tabs" >
				@foreach($files as $f)
					@if($f != "." and $f != ".." and $f != 'info.json')
					<li @if($file == $f) class="active" @endif  >
					<a href="{{ URL::to('vcr/config/translation?edit='.$lang.'&file='.$f)}}">{{ $f }} </a></li>
					@endif
				@endforeach
				</ul>
				<hr />
				{!! Form::open(array('url'=>'vcr/config/savetranslation/', 'class'=>'form-vertical ')) !!}
					<table class="table table-striped">
						<thead>
							<tr>
								<th> Pharse </th>
								<th> Translation </th>

							</tr>
						</thead>
						<tbody>	
							
							<?php foreach($stringLang as $key => $val) : 
								if(!is_array($val)) 
								{
								?>
								<tr>	
									<td><?php echo $key ;?></td>
									<td><input type="text" name="<?php echo $key ;?>" value="<?php echo $val ;?>" class="form-control" />
									
									</td>
								</tr>
								<?php 
								} else {
									foreach($val as $k=>$v)
									{ ?>
										<tr>	
											<td><?php echo $key .' - '.$k ;?></td>
											<td><input type="text" name="<?php echo $key ;?>[<?php echo $k ;?>]" value="<?php echo $v ;?>" class="form-control" />
											
											</td>
										</tr>						
									<?php }
								}
							endforeach; ?>
						</tbody>
						
					</table>
					<input type="hidden" name="lang" value="{{ $lang }}"  />
					<input type="hidden" name="file" value="{{ $file }}"  />
					<button type="submit" class="btn btn-info"> Save Translation</button>
				{!! Form::close() !!}
			</div>
			<div class="clr"></div>
		</div>
	</div>
</div>


@endsection