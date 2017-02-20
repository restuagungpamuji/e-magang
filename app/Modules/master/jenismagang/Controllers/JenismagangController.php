<?php namespace App\Modules\master\jenismagang\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\master\jenismagang\Models\JenismagangModel;
use Input,View, Request, Form, File;

/**
* Jenismagang Controller
* @var Jenismagang
* Generate from Custom Laravel 5.1 by Aa Gun. 
*
* Developed by Divisi Software Development - Dinustek. 
* Please write log when you do some modification, don't change anything unless you know what you do
* Semarang, 2016
*/

class JenismagangController extends Controller {
    protected $jenismagang;

    public function __construct(JenismagangModel $jenismagang){
        $this->jenismagang = $jenismagang;
    }

        public function getIndex(){
        cekAjax();
        if (Input::has('search')) {
            if(strlen(Input::has('search')) > 0){
                $jenismagangs = $this->jenismagang
                			->orWhere('nama', 'LIKE', '%'.Input::get('search').'%')
			->orWhere('keterangan', 'LIKE', '%'.Input::get('search').'%')

                ->paginate($_ENV['configurations']['list-limit']);
            }else{
                $jenismagangs = $this->jenismagang->all();
            }
        }else{
            $jenismagangs = $this->jenismagang->all();
        }
        return View::make('jenismagang::index', compact('jenismagangs'));
    }


        public function getCreate(){
        cekAjax();
        return View::make('jenismagang::create');
    }

    public function postCreate(){
        cekAjax();
        $input = Input::all();
        $validation = \Validator::make($input, JenismagangModel::$rules);
        if ($validation->passes()){
            $input['user_id'] = \Session::get('user_id');
            $input['role_id'] = \Session::get('role_id');
            echo ($this->jenismagang->create($input))?1:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }



    //{controller-show}

        public function getEdit($id = false){
        cekAjax();
        $id = ($id == false)?Input::get('id'):'';
        $jenismagang = $this->jenismagang->find($id);
        //if (is_null($jenismagang)){return \Redirect::to('master/jenismagang/index');}
        return View::make('jenismagang::edit', compact('jenismagang'));
    }
    
    public function postEdit(){
        cekAjax();
        $id = Input::get('id');
        $input = Input::all();
        $validation = \Validator::make($input, JenismagangModel::$rules);
        
        if ($validation->passes()){
            $jenismagang = $this->jenismagang->find($id);
            echo ($jenismagang->update($input))?4:"Gagal Disimpan";
        }
        else{
            echo 'Input tidak valid';
        }
    }


	
        public function postDelete(){
        cekAjax();
        $ids = Input::get('id');
        if (is_array($ids)){
            foreach($ids as $id){
                $this->jenismagang->find($id)->delete();
            }
            echo 'Data berhasil dihapus';
        }
        else{
            echo ($this->jenismagang->find($ids)->delete())?9:0;
        }
    }

}
