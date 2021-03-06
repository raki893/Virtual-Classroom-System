@extends('layouts.app')

@section('content')
<?php 


	$formats = array(
			'date'	=> 'Date',
			'image'	=> 'Image',
			'link'	=> 'Link',
			'checkbox'	=> 'Checkbox/Radio',
			'radio'	=> 'Radio',
			'file'	=> 'Files',
			'database'	=> 'Database'						
		);
	?>

    <section class="content-header">
      <h1> Module <small>Configuration</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('vcr/module') }}"><i class="fa fa-th"></i> Module</a></li>
        <li class="active">Grid Table </li>
         <li class="active">{{ $row->module_title }}</li>
      </ol>
    </section>

   <div class="content">

	
	

@if(Session::has('message'))
       {{ Session::get('message') }}
@endif

 {!! Form::open(array('url'=>'vcr/module/savetable/'.$module_name, 'class'=>'form-horizontal')) !!}
<div class="box box-primary">
 <div class="box-header with-border"> <h4>  {{ $row->module_title }} <small> : Table Editor ( Edit Table Setting ) </small></h4></div>
	<div class="box-body">	
		@include('vcr.module.tab',array('active'=>'table','type'=>$type))
	<div class="infobox infobox-success fade in">
	  <button type="button" class="close" data-dismiss="alert"> x </button>  
	  <p> <strong>New Feature ! ( LIMIT TO ) </strong> Type User ID's using (,) into spesific column to limit the column only viewd by them </p>	
	</div>

	 <div class="table-responsive">
			<table class="table table-striped " id="table">
			<thead class="no-border">
			  <tr>
				<th scope="col">No</th>
				<th scope="col">Table</th>
				<th scope="col">Field</th>
				<th scope="col" width="70"><i class="fa fa-key"></i> Limit To</th>
				<th scope="col"><i class="icon-link"></i></th>
				<th scope="col" data-hide="phone">Title / Caption </th>
				<th scope="col" data-hide="phone">Show</th>
				<th scope="col" data-hide="phone">VD </th>
				<th scope="col" data-hide="phone">ST</th>
				<th scope="col" data-hide="phone">DW</th>
				<th scope="col" data-hide="phone"> Format As </th>
			  </tr>
			 </thead> 
			<tbody class="no-border-x no-border-y">	
			<?php usort($tables, "SiteHelpers::_sort"); ?>
			  <?php $num=0; foreach($tables as $rows){
					$id = ++$num;
			  ?>
			  <tr >
				<td class="index"><?php echo $id;?></td>
				<td><?php echo $rows['alias'];?></td>
				<td ><strong><?php echo $rows['field'];?></strong>
				<input type="hidden" name="field[<?php echo $id;?>]" id="field" value="<?php echo $rows['alias'];?>" />			</td>
				<td>
					<?php
						 $limited_to = (isset($rows['limited']) ? $rows['limited'] : '');
					?>
					<input type="text" class="form-control" style="width: 30px" name="limited[<?php echo $id;?>]" class="limited" value="<?php echo $limited_to;?>" />

				</td>
				<td>	

				<span class=" xlick @if(isset($rows['conn']['valid']) && $rows['conn']['valid'] =='1') text-danger @endif " title="Lookup Display" 
				
					onclick="vcrModal('{{ URL::to('vcr/module/conn/'.$row->module_id.'?field='.$rows['field'].'&alias='.$rows['alias']) }}' ,' Connect Field : {{ $rows['field']}} ' )"
					>
						<i class="fa fa-external-link"></i>
					</span>
				</td>
				<td >           
					<input name="label[<?php echo $id;?>]" type="text" class="form-control input-sm " 
					id="label" value="<?php echo $rows['label'];?>" />
				</td>				
				<td>
				<label >
				<input name="view[<?php echo $id;?>]" type="checkbox" id="view" value="1"  class=""
				<?php if($rows['view'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="detail[<?php echo $id;?>]" type="checkbox" id="detail" value="1" class="" 
				<?php if($rows['detail'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="sortable[<?php echo $id;?>]" type="checkbox" id="sortable" value="1"  class=""
				<?php if($rows['sortable'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<label >
				<input name="download[<?php echo $id;?>]" type="checkbox" id="download" value="1"  class=""
				<?php if($rows['download'] == 1) echo 'checked="checked"';?>/>
				</label>
				</td>
				<td>
				<select class="select-alt" name="format_as[<?php echo $id;?>]">
					<option value=''> None </option>
					@foreach($formats as $key=>$val)
					<option value="{{ $key }}" <?php if(isset($rows['format_as']) && $rows['format_as'] ==$key) echo 'selected';?> > {{ $val }} </option>
					@endforeach
				</select>	
				
				<input type="text" name="format_value[<?php echo $id;?>]" value="<?php if(isset($rows['format_value'])) echo $rows['format_value'];?>" class="form-control" style="width:auto !important; display:inline;">

				<a href="javascript://ajax" data-html="true" class="text-success format_info" data-toggle="popover" title="Example Usage" data-content="  <b>Date </b> = dd-yy-mm <br /> <b>Image</b> = /uploads/path_to_upload <br />  <b>Link </b> = http://domain.com ? <br /> <b>Checkbox</b> = value:Display,...<br /> <b>Database</b> = table|id|field <br /> <b>Files</b> = /uploads/path_to_upload <br /><br /> All Field are accepted using tag {FieldName} . Example {<b><?php echo $rows['field'];?></b>} " data-placement="left">
				<i class="icon-question4"></i>
				</a>

				
				<input type="hidden" name="frozen[<?php echo $id;?>]" value="<?php echo $rows['frozen'];?>" />
				<input type="hidden" name="search[<?php echo $id;?>]" value="<?php echo $rows['search'];?>" />
				<input type="hidden" name="hidden[<?php echo $id;?>]" value="<?php if(isset($rows['hidden'])) echo $rows['hidden'];?>" />
				<input type="hidden" name="align[<?php echo $id;?>]" value="<?php if(isset($rows['align'])) echo $rows['align'];?>" />
				<input type="hidden" name="width[<?php echo $id;?>]" value="<?php echo $rows['width'];?>" />
				<input type="hidden" name="alias[<?php echo $id;?>]" value="<?php echo $rows['alias'];?>" />
				<input type="hidden" name="field[<?php echo $id;?>]" value="<?php echo $rows['field'];?>" />
				<input type="hidden" name="sortlist[<?php echo $id;?>]" class="reorder" value="<?php echo $rows['sortlist'];?>" />
	
				<input type="hidden" name="conn_valid[<?php echo $id;?>]"   
				value="<?php if(isset($rows['conn']['valid'])) echo $rows['conn']['valid'];?>"  />
				<input type="hidden" name="conn_db[<?php echo $id;?>]"   
				value="<?php if(isset($rows['conn']['db'])) echo $rows['conn']['db'];?>"  />	
				<input type="hidden" name="conn_key[<?php echo $id;?>]"  
				value="<?php if(isset($rows['conn']['key'])) echo  $rows['conn']['key'];?>"   />
				<input type="hidden" name="conn_display[<?php echo $id;?>]" 
				value="<?php if(isset($rows['conn']['display'])) echo   $rows['conn']['display'];?>"    />			 
				
				</td>
				
			  </tr>
			  <?php } ?>
			  </tbody>
			</table>
			</div>
	 <div class="infobox infobox-info fade in">
	  <button type="button" class="close" data-dismiss="alert"> x </button>  
	   <b> NOTE :  </b> | <b>(DW)</b>  = Download | <b> (VD) </b> = View Detail | <b>( ST )</b> = Sortable <br />
	  <p> <strong>Tips !</strong> Drag and drop rows to re ordering lists </p>	
	</div>	
					
			<button type="submit" class="btn btn-primary"> Save Changes </button>
			<input type="hidden" name="module_id" value="{{ $row->module_id }}" />
	{!! Form::close() !!}
		
	</div>	
</div></div>
<style type="text/css">
	.popover-content { font-size: 13px; }

</style>
<script type="text/javascript">

$(document).ready(function() {

	$('.format_info').popover()

	var fixHelperModified = function(e, tr) {
		var $originals = tr.children();
		var $helper = tr.clone();
		$helper.children().each(function(index) {
			$(this).width($originals.eq(index).width())
		});
		return $helper;
		},
		updateIndex = function(e, ui) {
			$('td.index', ui.item.parent()).each(function (i) {
				$(this).html(i + 1);
			});
			$('.reorder', ui.item.parent()).each(function (i) {
				$(this).val(i + 1);
			});			
		};
		
	$("#table tbody").sortable({
		helper: fixHelperModified,
		stop: updateIndex
	});		
});
</script>
<style>
	.xlick { cursor:pointer;}
	.popover { width:600px;}
</style>

@stop