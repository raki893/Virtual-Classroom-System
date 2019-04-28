<?php namespace App\Http\Controllers;
use Mail;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Validator, Input, Redirect ;
use Illuminate\Support\Facades\Auth;


abstract class Controller extends BaseController {

	use DispatchesJobs, ValidatesRequests;

	public function __construct()
	{
		
		$this->middleware('ipblocked');
		
        $driver             = config('database.default');
        $database           = config('database.connections');
       
        $this->db           = $database[$driver]['database'];
        $this->dbuser       = $database[$driver]['username'];
        $this->dbpass       = $database[$driver]['password'];
        $this->dbhost       = $database[$driver]['host']; 
        $this->data 		= array();

        // Load vcr Config
        $vcr 	= config('vcr');
        $this->config = $vcr ;
        $this->data['vcrconfig'] = $vcr ;
           
		$data = array(
				'last_activity'=> strtotime(Carbon::now())
			);
		\DB::table('tb_users')->where('id',\Session::get('uid'))->update($data);   
	} 	



	function getComboselect( Request $request)
	{


		if($request->ajax() == true && \Auth::check() == true)
		{
			$param = explode(':',$request->input('filter'));
			$parent = (!is_null($request->input('parent')) ? $request->input('parent') : null);
			$limit = (!is_null($request->get('limit')) ? $request->get('limit') : null);
			$rows = $this->model->getComboselect($param,$limit,$parent);
			$items = array();
		
			$fields = explode("|",$param[2]);
			
			foreach($rows as $row) 
			{
				$value = "";
				foreach($fields as $item=>$val)
				{
					if($val != "") $value .= $row->{$val}." ";
				}
				$items[] = array($row->{$param['1']}, $value); 	
	
			}
			
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>" Ops .. Cant access the page !"));
		}	
	}

	public function getCombotable( Request $request)
	{
		if(Request::ajax() == true && Auth::check() == true)
		{				
			$rows = $this->model->getTableList($this->db);
			$items = array();
			foreach($rows as $row) $items[] = array($row , $row); 	
			return json_encode($items); 	
		} else {
			return json_encode(array('OMG'=>"  Ops .. Cant access the page !"));
		}				
	}		
	
	public function getCombotablefield( Request $request)
	{
		if($request->input('table') =='') return json_encode(array());	
		if(Request::ajax() == true && Auth::check() == true)
		{	

				
			$items = array();
			$table = $request->input('table');
			if($table !='')
			{
				$rows = $this->model->getTableField($request->input('table'));			
				foreach($rows as $row) 
					$items[] = array($row , $row); 				 	
			} 
			return json_encode($items);	
		} else {
			return json_encode(array('OMG'=>"  Ops .. Cant access the page !"));
		}					
	}

	function postMultisearch( Request $request)
	{
		$post = $_POST;
		$items ='';
		foreach($post as $item=>$val):
			if($_POST[$item] !='' and $item !='_token' and $item !='md' && $item !='id'):
				$items .= $item.':'.trim($val).'|';
			endif;	
		
		endforeach;
		
		return Redirect::to($this->module.'?search='.substr($items,0,strlen($items)-1).'&md='.$request->input('md'));
	}

	function buildSearch( $map = false)
	{

			$keywords = ''; $fields = '';	$param ='';
			$allowsearch = $this->info['config']['forms'];
			$arr = array();
			foreach($allowsearch as $as) $arr[$as['field']] = $as ;		
			$mapping = '';
			if($_GET['search'] !='')
			{
				$type = explode("|",$_GET['search'] );
				if(count($type) >= 1)
				{
					foreach($type as $t)
					{
						$keys = explode(":",$t);
						if(in_array($keys[0],array_keys($arr))):
							if($arr[$keys[0]]['type'] == 'select' || $arr[$keys[0]]['type'] == 'radio' )
							{
								$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." ".self::searchOperation($keys[1])." '".$keys[2]."' ";	
								$mapping .= $keys[0].' '.self::searchOperation($keys[1]).' '.$keys[2]. '<br />';

							} else {
								$operate = self::searchOperation($keys[1]);
								if($operate == 'like')
								{
									$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." LIKE '%".$keys[2]."%%' ";	
									$mapping .= $keys[0].' LIKE '.$keys[2]. '<br />';	
								} else if( $operate =='is_null') {
									$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." IS NULL ";
									$mapping .= $keys[0].' IS NULL <br />';

								} else if( $operate =='not_null') {
									$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." IS NOT NULL ";
									$mapping .= $keys[0].' IS NOT NULL <br />';

								} else if( $operate =='between') {
									$param .= " AND (".$arr[$keys[0]]['alias'].".".$keys[0]." BETWEEN '".$keys[2]."' AND '".$keys[3]."' ) ";								
									$mapping .= $keys[0].' BETWEEN '.$keys[2]. ' - '. $keys[3] .'<br />';
								} else {
									$param .= " AND ".$arr[$keys[0]]['alias'].".".$keys[0]." ".self::searchOperation($keys[1])." '".$keys[2]."' ";
									$mapping .= $keys[0].' '.self::searchOperation($keys[1]).' '.$keys[2]. '<br />';	
								}												
							}						
						endif;	
					}
				} 
			}

		if($map == true)
		{
			return $param = array(
					'param'	=> $param,
					'maps'	=> '
					<div class="infobox infobox-info fade in" style="font-size:10px;">
					  <button data-dismiss="alert" class="close" type="button"> x </button>  
					 <b class="text-danger"> Search Result </b> :  <br /> '.$mapping.'
					</div>
					'
				);			

		} else {
			return $param;
		}		
		
	
	}

	function onSearch( $params )
	{
		// Used for extracting URL GET search 
		$psearch = explode('|',$params);
		$currentSearch = array();
		foreach($psearch as $ps)
		{
			$tosearch = explode(':',$ps);
			if(count($tosearch) >=2)
			$currentSearch[$tosearch[0]] = $tosearch[2]; 
		}
		return $currentSearch;		
	}

	function searchOperation( $operate)
	{
		$val = '';
		switch ($operate) {
			case 'equal':
				$val = '=' ;
				break;
			case 'bigger_equal':
				$val = '>=' ;
				break;
			case 'smaller_equal':
				$val = '<=' ;
				break;				
			case 'smaller':
				$val = '<' ;
				break;
			case 'bigger':
				$val = '>' ;
				break;
			case 'not_null':
				$val = 'not_null' ;
				break;								

			case 'is_null':
				$val = 'is_null' ;
				break;	

			case 'like':
				$val = 'like' ;
				break;	

			case 'between':
				$val = 'between' ;
				break;					

			default:
				$val = '=' ;
				break;
		}
		return $val;
	}		

	function inputLogs(Request $request, $note = NULL)
	{
		$data = array(
			'module'	=> $request->segment(1),
			'task'		=> $request->segment(2),
			'user_id'	=> session('uid'),
			'ipaddress'	=> $request->getClientIp(),
			'note'		=> $note
		);
		\DB::table( 'tb_logs')->insert($data);		;
	
	}

	static public function validateFiles()
	{

	}

	function validateForm( $forms = array() )
	{
		$request = new Request;	
		if(count($forms) <= 0)
			$forms = $this->info['config']['forms'];
	
		$rules = array();
		foreach($forms as $form)
		{
			if($form['required']== '' || $form['required'] !='0')
			{
				$rules[$form['field']] = 'required';
			} elseif ($form['required'] == 'alpa'){
				$rules[$form['field']] = 'required|alpa';
			} elseif ($form['required'] == 'alpa_num'){
				$rules[$form['field']] = 'required|alpa_num';					
			} elseif ($form['required'] == 'alpa_dash'){
				$rules[$form['field']]='required|alpa_dash';																
			} elseif ($form['required'] == 'email'){
				$rules[$form['field']] ='required|email';
			} elseif ($form['required'] == 'numeric'){
				$rules[$form['field']] = 'required|numeric';		
			} elseif ($form['required'] == 'date'){
				$rules[$form['field']]='required|date';
			} else if($form['required'] == 'url'){
				$rules[$form['field']] = 'required|active_url';
			} else {
	
				if( $form['type'] =='file')
				{
					if($form['required'] =='required')
					{
						$validation = 'required';
						if($form['option']['upload_type'] =='image')
						{
							$validation .= '|mimes:jpg,jpeg,png,gif,bmp';

						} else {
							$validation .= '|mimes:zip,csv,xls,doc,docx,xlsx';						
						}

						if($form['option']['image_multiple'] != '1')
						{
							// IF SINGLE UPLOAD FILE OR IMAGE 	
							$rules[$form['field']] = $validation;

						}  else {
							// IF MULTIPLE UPLOAD FILE OR IMAGE 	
							$FilesArray = [];
							if(count($_FILES[$form['field']]) >=1 )
							{
								$nbr = count($_FILES[$form['field']]) - 1;
								foreach(range(0, $nbr) as $index) {
								   // $imagesArray['images.' . $index] = 'required|image';
								    $rules[$form['field'].'.'.$index] = $validation;
								}
							}

						}


						
					
					} else {
						
						if($form['option']['upload_type'] =='image')
						{
							$validation = 'mimes:jpg,jpeg,png,gif,bmp';

						} else {
							$validation = 'mimes:zip,csv,xls,doc,docx,xlsx,pdf,rtf';						
						}

						if($form['option']['image_multiple'] != '1')
						{
							// IF SINGLE UPLOAD FILE OR IMAGE 	
							$rules[$form['field']] = $validation;

						}  else {
							// IF MULTIPLE UPLOAD FILE OR IMAGE 	
							$FilesArray = [];
							if(count($_FILES[$form['field']]) >=1 )
							{
								$nbr = count($_FILES[$form['field']]) - 1;
								foreach(range(0, $nbr) as $index) {
								    $rules[$form['field'].'.'.$index] = $validation;
								}
							}

						}
					} 
				}

			}										
		}	
		return $rules ;
	}	

	function validatePost(  $request )
	{	
		$str = $this->info['config']['forms'];	
		$data = array();
		foreach($str as $f){
			$field = $f['field'];
			// Update for V5.1.5 issue on Autofilled createOn and updatedOn fields
			if($field == 'createdOn') $data['createdOn'] = date('Y-m-d H:i:s');
            if($field == 'updatedOn') $data['updatedOn'] = date('Y-m-d H:i:s');
			if($f['view'] ==1) 
			{
				if($f['type'] =='textarea_editor' || $f['type'] =='textarea')
				{
					 $data[$field] =$request->input( $field );
				} else {
					// Handle text Input
					if(!is_null ( $request->input( $field ) ))
					{
						$data[$field] = $request->input( $field );				
					}
					// Handle FILE OR IMAGE Upload 
					if($f['type'] =='file')
					{	
						$files ='';	
						if($f['option']['upload_type'] =='file')
						{

							if(isset($f['option']['image_multiple']) && $f['option']['image_multiple'] ==1)
							{								
								if(isset($_POST['curr'.$field]))
								{
									$curr =  '';
									for($i=0; $i<count($_POST['curr'.$field]);$i++)
									{
										$files .= $_POST['curr'.$field][$i].',';
									}
								}	

								if(!is_null($request->file($field)))
								{

									$destinationPath = '.'. $f['option']['path_to_upload']; 	
									foreach($_FILES[$field]['tmp_name'] as $key => $tmp_name ){
									 	$file_name = $_FILES[$field]['name'][$key];
										$file_tmp =$_FILES[$field]['tmp_name'][$key];
										if($file_name !='')
										{
											move_uploaded_file($file_tmp,$destinationPath.'/'.$file_name);
											$files .= $file_name.',';

										}
										
									}
									
									if($files !='')	$files = substr($files,0,strlen($files)-1);	
								}	
								$data[$field] = $files;													

							} else {
							
								if(!is_null($request->file($field)))
								{								

									$file = $request->file($field); 
								 	$destinationPath = '.'. $f['option']['path_to_upload']; 
									$filename = $file->getClientOriginalName();
									$extension =$file->getClientOriginalExtension(); //if you need extension of the file
									$rand = rand(1000,100000000);
									$newfilename = strtotime(date('Y-m-d H:i:s')).'-'.$rand.'.'.$extension;
									$uploadSuccess = $file->move($destinationPath, $newfilename);
									if( $uploadSuccess ) {
									   $data[$field] = $newfilename;
									}
								}	 
							}	

						} else {

							if(isset($f['option']['image_multiple']) && $f['option']['image_multiple'] ==1)
							{
								$files = '';
								if(isset($_POST['curr'.$field]))
								{
									$curr =  '';
									for($i=0; $i<count($_POST['curr'.$field]);$i++)
									{
										$files .= $_POST['curr'.$field][$i].',';
									}
								}

								$destinationPath = '.'. $f['option']['path_to_upload']; 
								if(count($request->file($f['field'])) >=1 )
								{
									
									$destinationPath = '.'. $f['option']['path_to_upload']; 
									foreach($_FILES[$field]['tmp_name'] as $key => $tmp_name ){
									 	$file_name = $_FILES[$field]['name'][$key];
										$file_tmp =$_FILES[$field]['tmp_name'][$key];
										if($file_name !='')
										{
											//move_uploaded_file($file_tmp,$destinationPath.'/'.$file_name);
											//echo  $file_name.'<br />';
											$file = $request->file($field)[$key];
											$filename = $file->getClientOriginalName();
											$extension =$file->getClientOriginalExtension(); //if you need extension of the file
											$rand = rand(1000,100000000);
											$newfilename = strtotime(date('Y-m-d H:i:s')).'-'.$rand.'.'.$extension;
											$files .= $newfilename.',';

											$uploadSuccess = $file->move($destinationPath, $newfilename);


											 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
											 {
											 	if( $f['option']['resize_height'] ==0 )
												{
													$f['option']['resize_height']	= $f['option']['resize_width'];
												}
											 	$orgFile = $destinationPath.'/'.$newfilename;
												 \SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;						 
											 }
										}										
									}								
								} 

								if($files !='')	$files = substr($files,0,strlen($files)-1);	
									$data[$field] = $files;	

							} else {

								if(!is_null($request->file($field)))
								{
									$file = $request->file($field); 
								 	$destinationPath = '.'. $f['option']['path_to_upload']; 
									$filename = $file->getClientOriginalName();
									$extension =$file->getClientOriginalExtension(); //if you need extension of the file
									$rand = rand(1000,100000000);
									$newfilename = strtotime(date('Y-m-d H:i:s')).'-'.$rand.'.'.$extension;


									$uploadSuccess = $file->move($destinationPath, $newfilename);


									 if($f['option']['resize_width'] != '0' && $f['option']['resize_width'] !='')
									 {
									 	if( $f['option']['resize_height'] ==0 )
										{
											$f['option']['resize_height']	= $f['option']['resize_width'];
										}
									 	$orgFile = $destinationPath.'/'.$newfilename;
										 \SiteHelpers::cropImage($f['option']['resize_width'] , $f['option']['resize_height'] , $orgFile ,  $extension,	 $orgFile)	;						 
									 }
									 
									if( $uploadSuccess ) {
									   $data[$field] = $newfilename;
									}
								}	 
							}		

						}

					}	

					// Handle Checkbox input 
					if($f['type'] =='checkbox')
					{
						if(!is_null ( $request->input( $field ) ))
						{
							$data[$field] = implode(",", $request->input( $field ) );
						} else {
							$data[$field] = '0';	
						}
					}
					// Handle Date 				
					if($f['type'] =='date')
					{
						$data[$field] = date("Y-m-d",strtotime($request->input($field)));
					}

					// Handle Date 				
					if($f['type'] =='date_time')
					{
						$data[$field] = date("Y-m-d H:i:s",strtotime($request->input($field)));
					}

					
					// if post is seelct multiple						
					if($f['type'] =='select')
					{
						if( isset($f['option']['select_multiple']) &&  $f['option']['select_multiple'] ==1 )
						{
							if(!is_null( $request->input( $field )))
							{
								$multival = implode(",", $request->input( $field ) ); 
								$data[$field] = $multival;
							}
						} else {
							$data[$field] = $request->input( $field );
						}	
					}									
					
				}	 						

			}	
		}
		$this->access = $this->model->validAccess($this->info['id'] , session('gid'));
		 $global	= (isset($this->access['is_global']) && $this->access['is_global'] != 0 ? $this->access['is_global'] : 0 );
		
		if($global == 0 )
			$data['entry_by'] = session('uid');

		/* Added for Compatibility laravel 5.2 */
		$values = array();
		foreach($data as $key=>$val)
		{
			if($val !='') $values[$key] = $val;
		}			
		return $values;
	}

	function postFilter( Request $request)
	{
		$module = $this->module;
		$sort 	= (!is_null($request->input('sort')) ? $request->input('sort') : '');
		$order 	= (!is_null($request->input('order')) ? $request->input('order') : '');
		$rows 	= (!is_null($request->input('rows')) ? $request->input('rows') : '');
		$md 	= (!is_null($request->input('md')) ? $request->input('md') : '');
		$sc 	= (!is_null($request->input('sc')) ? $request->input('sc') : '');
		
		$filter = '?';
		if($sort!='') $filter .= '&sort='.$sort; 
		if($order!='') $filter .= '&order='.$order; 
		if($rows!='') $filter .= '&rows='.$rows; 
		if($md !='') $filter .= '&md='.$md;
		if($sc !='') $filter .= '&search='.$sc;

		 
		 

		return Redirect::to($this->data['pageModule'] . $filter);
	
	}	

	function injectPaginate()
	{

		$sort 	= (isset($_GET['sort']) 	? $_GET['sort'] : '');
		$order 	= (isset($_GET['order']) 	? $_GET['order'] : '');
		$rows 	= (isset($_GET['rows']) 	? $_GET['rows'] : '');
		$search 	= (isset($_GET['search']) ? $_GET['search'] : '');

		$appends = array();
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		
		return $appends;
			
	}	

	function returnUrl()
	{
		$pages 	= (isset($_GET['page']) ? $_GET['page'] : '');
		$sort 	= (isset($_GET['sort']) ? $_GET['sort'] : '');
		$order 	= (isset($_GET['order']) ? $_GET['order'] : '');
		$rows 	= (isset($_GET['rows']) ? $_GET['rows'] : '');
		$search 	= (isset($_GET['search']) ? $_GET['search'] : '');
		
		$appends = array();
		if($pages!='') 	$appends['page'] = $pages; 
		if($sort!='') 	$appends['sort'] = $sort; 
		if($order!='') 	$appends['order'] = $order; 
		if($rows!='') 	$appends['rows'] = $rows; 
		if($search!='') $appends['search'] = $search; 
		
		$url = "";
		foreach($appends as $key=>$val)
		{
			$url .= "&$key=$val";
		}
		return $url;
			
	}	

	public function getRemovefiles( Request $request)
	{
		$files = '.'.$request->input('file');
		if(file_exists($files) && $files !='')
		{
			unlink( $files);
		}
	}

	public function getRemovecurrentfiles( Request $request)
	{
		$id 	= $request->input('id');
		$field 	= $request->input('field');
		$file 	= $request->input('file');
		if(file_exists('./'.$file) && $file !='')
		{
			if(unlink('.'.$file))
			{
				\DB::table($this->info['table'])->where($this->info['key'],$id)->update(array($field=>''));
			}
			return Response::json(array('status'=>'success'));
		} else {
			return Response::json(array('status'=>'error'));
		}
	}	

	public function getSearch()
	{

		$this->data['tableForm'] 	= $this->info['config']['forms'];	
		$this->data['tableGrid'] 	= $this->info['config']['grid'];

		$this->data['pageUrl']		= url($this->module);
		return view('vcr.module.utility.search',$this->data);
	
	}

	function getDownload( Request $request)
	{
		$this->access = $this->model->validAccess($this->info['id'] , session('gid'));
		if($this->access['is_excel'] ==0) 
			return Redirect::to('')->with('messagetext',\Lang::get('core.note_restric'))->with('msgstatus','error');   
	
		$info = $this->model->makeInfo( $this->module);
		// Take param master detail if any
		$filter = (!is_null($request->input('search')) ? $this->buildSearch() : '');
		$params = array(
			'params'	=> $filter,
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		
		$results 	= $this->model->getRows( $params );
		$fields		= $info['config']['grid'];
		$rows		= $results['rows'];
		
		$content = $this->data['pageTitle'];
		$content .= '<table border="1">';
		$content .= '<tr>';
		foreach($fields as $f )
		{
			if($f['download'] =='1')
			{
				$limited = isset($field['limited']) ? $field['limited'] :'';
				if(\SiteHelpers::filterColumn($limited ))
				{
					$content .= '<th style="background:#f9f9f9;">'. $f['label'] . '</th>';
					
				}
			}	
		}
		$content .= '</tr>';
		
		foreach ($rows as $row)
		{
			$content .= '<tr>';
			foreach($fields as $f )
			{
					
				if($f['download'] =='1')
				{
					$limited = isset($field['limited']) ? $field['limited'] :'';
					if(\SiteHelpers::filterColumn($limited ))
					{
						$content .= '<td> '. \SiteHelpers::formatRows($row->{$f['field']},$f,$row) . '</td>';
					}
				}	
	
			}
			$content .= '</tr>';
		}
		$content .= '</table>';
		
		@header('Content-Type: application/ms-excel');
		@header('Content-Length: '.strlen($content));
		@header('Content-disposition: inline; filename="'.$title.' '.date("d/m/Y").'.xls"');
		
		echo $content;
		exit;
	
	}	

	function getImport( Request $request)
	{
		$task = $request->input('template');
		if($task !='')
		{
			$fields =  $this->info['config']['grid'];
			$output = fopen('php://output', 'w');
			$head= array();
			foreach($fields as $f )
			{
				$head[] = $f['field'];
			}

			fputcsv($output, $head);
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename='.$this->module.'.csv');	

		} else {
			$this->data['url'] = url($this->module) ;
			$this->data['module'] = $this->module ;
			return view('vcr.module.utility.import', $this->data);
		}	

	}

	function postImport( Request $request)
	{

		if(!is_null($request->file('fileimport')))
		{
			$file = 	$request->file('fileimport');
			$filename = $file->getClientOriginalName();
			$uploadSuccess = $file->move('./uploads/' , $filename );
			if( $uploadSuccess ) {
				$csv = array_map('str_getcsv', file('./uploads/'.$filename));
				$table = $this->info['config']['grid'];
				$fields = array();
				foreach($table as $f )
				{
					$fields[] = $f['field'];
				}
				//print_r($fields);
				foreach($csv as $row) {
					$data = array();
					foreach($fields as $key=>$val)
					{
						if($key != 0 )
							$data[$val] = (isset($row[$key]) ? $row[$key] : '' ) ;	
					}
					//print_r($data);
					//echo $row[0];
					$this->model->insertRow($data ,$row[0]);	
											
				}
				
				return response()->json(array('status'	=> 'success','message'=>'Csv Imported Successful !'));			  
			} else {
				return response()->json(array('status'	=> 'error','message'=>'Upload Failed!'));	
			}
		} else {			
			return response()->json(array('status'	=> 'error','message'=>'Please select file to Upload!'));
		}	

	}

	function getLookup( Request $request, $id)
	{
		$args = explode("-",$id);
		if(count($args)>=2) 
		{

			$model = '\\App\\Models\\'.ucwords($args['3']);
			$model = new $model();
			$info = $model->makeInfo( $args['3'] );
			$data['pageTitle'] = $info['title'];
			$data['pageNote'] = $info['note'];			
			$params = array(
				'params'	=> " And ".$args['4'].".".$args['5']." ='". $args['6'] ."'",
				//'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
			);
			$results = $model->getRows( $params );	
			$data['access']		=$model->validAccess($info['id']);
			$data['rowData']		= $results['rows'];
			$data['tableGrid'] 	= $info['config']['grid'];
			$data['tableForm'] 	= $info['config']['forms'];	
			$data['colspan']		= \SiteHelpers::viewColSpan($info['config']['grid']);
			$data['nested_subgrid']	= (isset($info['config']['subgrid']) ? $info['config']['subgrid'] : array());
			//print_r($data['nested_subgrid']);exit;
			$data['id'] 		= $args[6];
			$data['key']		= $info['key'];
			//$data['ids']		= 'md'-$info['id'];
			return view('vcr.module.utility.masterdetail',$data);

		} else {
			return 'Invalid Argument';
		}
	}


	function detailview( $model , $detail , $id )
	{
		
		$info = $model->makeInfo( $detail['module'] );

		$params = array(
			'params'	=> " And `".$detail['key']."` ='". $id ."'",
			'global'	=> (isset($this->access['is_global']) ? $this->access['is_global'] : 0 )
		);
		$results = $model->getRows( $params );	
		
		$data['rowData']		= $results['rows'];
		$data['tableGrid'] 		= $info['config']['grid'];
		$data['tableForm'] 		= $info['config']['forms'];	
		
		return $data;

		
			
	}


function detailviewsave( $model ,$request , $detail , $id )

	{
		$info = $model->makeInfo( $detail['module'] );
		$relation_key = $info['key'];
		$access = $model->validAccess($info['id'] , session('gid'));

		if($access['is_add'] == '1' && $access['is_edit'] == '1' )
		{
			$str = $info['config']['forms'];
			$global	= (isset($access['is_global']) ? $access['is_global'] : 0 );
			$total = count($request['counter']);
			$mkeys = array();
			$getAllCurrentData = \DB::table($detail['table'])->where($detail['master_key'] , $id  )->get();

			$pkeys = array();
			for($i=0; $i<$total;$i++) 
					$pkeys[] = $request['bulk_'.$relation_key][$i];

			foreach ($getAllCurrentData as $keys) {	
				if(!in_array($keys->{$relation_key} , $pkeys))		
				{	
					// Remove If items is not resubmited
					\DB::table($detail['table'])->where($relation_key,$keys->{$relation_key})->delete();
				}
			}

			for($i=0; $i<$total;$i++)
			{
				$data =array();
				foreach($str as $f){
					$field = $f['field'];
					if($f['view'] ==1)
					{
						if(isset($request['bulk_'.$field][$i]) && $request['bulk_'.$field][$i] !='')

						{
							$data[$f['field']] = $request['bulk_'.$field][$i];
						}
					}			
				}

				$rules = self::validateForm($str);
				$validator = Validator::make($data, $rules);
				if($validator->passes()) {	
					$data[$detail['key']] =  $id ;
					if($global == 0 )
						$data['entry_by'] = \Session::get('uid');
					
					// Check if data currentry exist
					$check = \DB::table($detail['table'])->where($relation_key , $request['bulk_'.$relation_key][$i]  )->get();
					if(count($check) >=1)
					{
						\DB::table($detail['table'])->where($relation_key ,  $request['bulk_'.$relation_key][$i] )->update($data);
					} else {
						unset($data[$relation_key]);
						\DB::table($detail['table'])->insert($data);	
					}
				}			

			}	
		}	

		

	}



}

