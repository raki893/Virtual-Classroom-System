

		 {!! Form::open(array('url'=>'attendace/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> attendace</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="UserId" class=" control-label col-md-4 text-left"> UserId </label>
										<div class="col-md-7">
										  <input  type='text' name='userId' id='userId' value='{{ $row['userId'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Date" class=" control-label col-md-4 text-left"> Date </label>
										<div class="col-md-7">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('date', $row['date'],array('class'=>'form-control date','id'=>'date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Status" class=" control-label col-md-4 text-left"> Status </label>
										<div class="col-md-7">
										  <?php $status = explode(",",$row['status']); ?>
					  
					<input type='checkbox' name='status[]' value ='Absent'   class=' minimal-red' 
					@if(in_array('Absent',$status))checked @endif 
					 /> Absent  
					  
					<input type='checkbox' name='status[]' value ='Present'   class=' minimal-red' 
					@if(in_array('Present',$status))checked @endif 
					 /> Present   
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Course" class=" control-label col-md-4 text-left"> Course </label>
										<div class="col-md-7">
										  <input  type='text' name='course' id='course' value='{{ $row['course'] }}' 
						     class='form-control ' /> 
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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
