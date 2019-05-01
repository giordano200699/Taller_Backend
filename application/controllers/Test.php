<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('pago');
    }

    public function index(){
        $data = array('content'=>'test/index');
        $this->load->view("layout",$data);
    }

    public function prueba(){
        print_r($this->pago->listarTodos());
    }
}

?>
