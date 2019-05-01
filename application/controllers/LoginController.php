<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class LoginController extends REST_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('usuarios');
    }

    public function index_post(){ //autentificar usuario

        $user = $this->post('user');
        $pass = $this->post('pass');
        $tipo = $this->post('tipo');

        if($user == '' || $pass == '' || $tipo == ''){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->usuarios->loggin(strtolower($user),$pass,$tipo);
        }
        $this->response($array_out);
    }

	public function modulos_get(){ //listar perfiles
		$this->response($this->usuarios->getModulos());
	}
}

 ?>
