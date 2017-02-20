<?php namespace App\Modules\master\jenismagang\Models;
use Illuminate\Database\Eloquent\Model;


/**
* Jenismagang Model
* @var Jenismagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class JenismagangModel extends Model {
	protected $guarded = array();
	
	protected $table = "ms_jenis_magang";

	public static $rules = array(
    		'nama' => 'required',
		'keterangan' => 'required',

    );

	public static function all($columns = array('*')){
		$instance = new static;
		if (\PermissionsLibrary::hasPermission('mod-jenismagang-listall')){
			return $instance->newQuery()->paginate($_ENV['configurations']['list-limit']);
		}else{
			return $instance->newQuery()
			->where('role_id', \Session::get('role_id'))
			->paginate($_ENV['configurations']['list-limit']);	
			
		}
	}

}
