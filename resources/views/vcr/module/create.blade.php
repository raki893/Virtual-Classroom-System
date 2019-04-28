@extends('layouts.app')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ Lang::get('core.t_module') }}
        <small>{{ Lang::get('core.create') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="{{ url('vcr/module') }}"><i class="fa fa-th"></i> Module</a></li>
        <li class="active">Create</li>
      </ol>
    </section>

    <div class="content">
    
	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">CRUD Form Fill</h3>
            </div>

      <div class="box-body">

 {!! Form::open(array('url'=>'vcr/module/create/', 'class'=>'form-horizontal', 'parsley-validate'=>'','novalidate'=>'')) !!}

	
      <div class="form-group">
		<label class="col-sm-3 text-right"></label>
		<div class="col-sm-9">	
	  
			<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul> 
		
		</div>	  
      </div>	

	<div class="form-group has-feedback">
		<label class="col-sm-3 text-right"> {{ Lang::get('core.fr_modtitle') }} </label>
		<div class="col-sm-9">	
	  {!! Form::text('module_title', null, array('class'=>'form-control', 'placeholder'=>'Title Name', 'required'=>'true')) !!}
		</div>
	</div>		
	
	<div class="form-group ">
		<label class="col-sm-3 text-right"> {{ Lang::get('core.fr_modnote') }}  </label>
		<div class="col-sm-9">	
	  {!! Form::text('module_note', null, array('class'=>'form-control', 'placeholder'=>'Short description module')) !!}
		
		</div>
	</div>

	<div class="form-group ">
		<label class="col-sm-3 text-right"> Template :  </label>
		<div class="col-sm-9">	
			<label class="radio">	
				<input type="radio" name="module_template" value="addon" checked="checked" class="minimal-red" /> Full CRUD   <br />
				<small style="font-style:italic"> Add,Edit,View in new page , Native php sorting and pagination </small> 
			</label>
			<label class="radio">	
				<input type="radio" name="module_template" value="generic" class="minimal-red"/>  Blank Module <br />				
				
				<small style="font-style:italic">  Create template controller , model and views files for your own custom module</small> 
				
			</label>

			<label class="radio">	
				<input type="radio" name="module_template" value="report" class="minimal-red" />  Report Module <br />				
				
				<small style="font-style:italic"> Used for table view (  MySQL View Table Schema) </small> 
				
			</label>		
					
		</div>
	</div>		


	<div class="form-group ">
		<label class="col-sm-3 text-right">Class Controller </label>
		<div class="col-sm-9">	
	  {!! Form::text('module_name', null, array('class'=>'form-control', 'placeholder'=>'Class Controller / Module Name' ,  'required'=>'true')) !!}
		
		</div>
	</div>	
		
	
	<div class="form-group">
		<label class="col-sm-3 text-right"> {{ Lang::get('core.fr_modtable') }}  </label>
		<div class="col-sm-9">	
		{!! Form::select('module_db', $tables , '' , 
			array('class'=>'form-control ', 'required'=>'true' )); 
		!!}
	 	
		</div>
	</div>	
		
	<div class="form-group " style="display:none;">
		<label class="col-sm-3 text-right">Author </label>
		<div class="col-sm-9">	
	  {!! Form::text('module_author',  null, array('class'=>'form-control', 'placeholder'=>'Author')) !!}
		
		</div>
	</div>	
		


	<div class="form-group switchSql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">	
			<label class="radio radio-inline">
				<input type="radio" name="creation" value="auto"  checked="checked"  class="minimal-red"/> 
				{{ Lang::get('core.fr_modautosql') }} 
			</label>		
			<label class="radio radio-inline">
				<input type="radio" name="creation" value="manual"  class="minimal-red" />
				{{ Lang::get('core.fr_modmanualsql') }}
			</label>		
		</div>
	</div>	
	
	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
			{!! Form::textarea('sql_select', null, array('class'=>'form-control', 'placeholder'=>'SQL Select & Join Statement' ,'rows'=>'3' ,'id'=>'sql_select')) !!}
		  
		</div> 
	</div>	
	
	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
		{!! Form::textarea('sql_where', null, array('class'=>'form-control', 'placeholder'=>'SQL Where Statement' ,'rows'=>'2','id'=>'sql_where')) !!}
		</div> 
	</div>		

	<div class="form-group manualsql">
		<label class="col-sm-3 text-right">  </label>
		<div class="col-sm-9">
			{!! Form::textarea('sql_group', null, array('class'=>'form-control', 'placeholder'=>'SQL Grouping Statement' ,'rows'=>'2')) !!}
		</div> 
	</div>	
	
		
      <div class="form-group">
		<label class="col-sm-3 text-right">&nbsp;</label>
		<div class="col-sm-9">	
	  	<button type="submit" class="btn btn-primary "><i class="icon-checkmark-circle2"></i>  {{ Lang::get('core.sb_submit') }}</button>
	  	<a href="{{ url('vcr/module')}}" class="btn btn-warning"> <i class="icon-backward"></i> Cancel </a>
		</div>	  

      </div>
  </div>
    
    </div>
 {!! Form::close() !!}

    </div>


<script type="text/javascript">
	$(document).ready(function(){



		$('.manualsql').hide();
		$('.switchSql input:radio').on('ifClicked', function() {
		  val = $(this).val(); 
			if(val == 'manual')
			{
				$('.manualsql').show();
				$('#sql_select').attr("required","true");
				$('#sql_where').attr("required","true");
				
			} else {
				$('.manualsql').hide();
				$('#sql_select').removeAttr("required");
				$('#sql_where').removeAttr("required");
	
			}		  
		  
		});

	});
	
</script>
@stop
