

		 {!! Form::open(array('url'=>'rac/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> RestAPI Client</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="Apiuser" class=" control-label col-md-4 text-left"> Apiuser </label>
										<div class="col-md-7">
										  <select name='apiuser' rows='5' id='apiuser' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Apikey" class=" control-label col-md-4 text-left"> Apikey </label>
										<div class="col-md-7">
										  <input  type='text' name='apikey' id='apikey' value='{{ $row['apikey'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> {!! Form::hidden('created', $row['created']) !!}					
									  <div class="form-group  " >
										<label for="Modules" class=" control-label col-md-4 text-left"> Modules </label>
										<div class="col-md-7">
										  <select name='modules[]' multiple rows='5' id='modules' class='select2 '   ></select> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> </fieldset>
			</div>
			
			

			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				  </div>	  
			
		</div> 
		 
		 {!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#apiuser").jCombo("{!! url('rac/comboselect?filter=tb_users:id:email') !!}",
		{  selected_value : '{{ $row["apiuser"] }}' });
		
		$("#modules").jCombo("{!! url('rac/comboselect?filter=tb_module:module_name:module_title') !!}",
		{  selected_value : '{{ $row["modules"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
