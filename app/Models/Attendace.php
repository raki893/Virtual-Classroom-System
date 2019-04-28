<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class attendace extends vcr  {
	
	protected $table = 'attendance';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT attendance.* FROM attendance  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE attendance.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	
    	public static function querySelect2(  ){
		
		return "  SELECT 'userId' FROM attendance  ";
	}

}
