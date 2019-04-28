<div class="m-t" style="padding-top:25px;">	
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />       
    </div>
</div>
<div class="m-t">
	<div class="table-responsive" > 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
			
					<tr>
						<td width='30%' class='label-view text-right'>Id</td>
						<td>{!! $row->id!!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Type</td>
						<td>{!! $row->type!!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>FirstName</td>
						<td>{!! $row->firstName!!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>LastName</td>
						<td>{!! $row->lastName!!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Image</td>
						<td>{!! SiteHelpers::formatRows($row->image,$fields['image'],$row ) !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Details</td>
						<td>{!! $row->details!!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>IdNumber</td>
						<td>{!! $row->idNumber!!} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	