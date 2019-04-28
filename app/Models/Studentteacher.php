<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class studentteacher extends vcr  {
	
	protected $table = 'details';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT details.* FROM details  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE details.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
