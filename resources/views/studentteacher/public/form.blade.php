

		 {!! Form::open(array('url'=>'studentteacher/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> studentteacher</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="Type" class=" control-label col-md-4 text-left"> Type </label>
										<div class="col-md-7">
										  <?php $type = explode(",",$row['type']); ?>
					  
					<input type='checkbox' name='type[]' value ='Student'   class=' minimal-red' 
					@if(in_array('Student',$type))checked @endif 
					 /> Student  
					  
					<input type='checkbox' name='type[]' value ='Teacher'   class=' minimal-red' 
					@if(in_array('Teacher',$type))checked @endif 
					 /> Teacher   
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="IdNumber" class=" control-label col-md-4 text-left"> IdNumber </label>
										<div class="col-md-7">
										  <input  type='text' name='idNumber' id='idNumber' value='{{ $row['idNumber'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="FirstName" class=" control-label col-md-4 text-left"> FirstName </label>
										<div class="col-md-7">
										  <input  type='text' name='firstName' id='firstName' value='{{ $row['firstName'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="LastName" class=" control-label col-md-4 text-left"> LastName </label>
										<div class="col-md-7">
										  <input  type='text' name='lastName' id='lastName' value='{{ $row['lastName'] }}' 
						     class='form-control ' /> 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Image" class=" control-label col-md-4 text-left"> Image </label>
										<div class="col-md-7">
										  <input  type='file' name='image' id='image' class='inputfile  @if($row['image'] =='') class='required' @endif '  />

							<label for='image'><i class='fa fa-upload'></i> Choose a file</label>
							<div class='image_preview'></div>
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['image'],'/uploads/images') !!}
						
						</div>					
					 
										 </div> 
										 <div class="col-md-1">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Details" class=" control-label col-md-4 text-left"> Details </label>
										<div class="col-md-7">
										  <textarea name='details' rows='5' id='details' class='form-control '  
				           >{{ $row['details'] }}</textarea> 
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
