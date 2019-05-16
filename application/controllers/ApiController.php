<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
/**
 *
 */
class ApiController extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('pago');
    }

    public function index_get(){
        $fecha_inicio = $this->get('inicio');
        $fecha_fin = $this->get('fin');
        $conceptos = $this->get('conceptos');
        if($fecha_inicio == '' || $fecha_fin == ''){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->pago->listarPorFechasCantidad($fecha_inicio, $fecha_fin,$conceptos);
        }
        $this->response($array_out);
    }

    public function importe_get(){
        $fecha_inicio = $this->get('inicio');
        $fecha_fin = $this->get('fin');
        $conceptos = $this->get('conceptos');
        if($fecha_inicio == '' || $fecha_fin == ''){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->pago->listarPorFechasImporte($fecha_inicio, $fecha_fin,$conceptos);
        }
        $this->response($array_out);
    }

    public function devolverAnioImporte_get(){
        $year = $this->get("year");
        $conceptos = $this->get("conceptos");
        if($year == ""){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->pago->listarAnioImporte($year,$conceptos);
        }
        $this->response($array_out);
    }
    public function devolverAnioCantidad_get(){
        $year = $this->get("year");
        $conceptos = $this->get("conceptos");
        if($year == ""){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->pago->listarAnioCantidad($year,$conceptos);
        }
        $this->response($array_out);
    }

    public function tablaFechas_get(){
        $fecha_inicio = $this->get('inicio');
        $fecha_fin = $this->get('fin');
        $conceptos = $this->get("conceptos");
        if($fecha_inicio == '' || $fecha_fin == ''){
            $array_out = array("result"=>"error1");
        }
        else{
            $array_out = $this->pago->registrosPorFechas($fecha_inicio, $fecha_fin,$conceptos);
        }
        $this->response($array_out);
    }

    public function tablaYear_get(){
        $year_inicio = $this->get("year_inicio");
        $year_fin = $this->get("year_fin");
        $conceptos = $this->get("conceptos");
        if($year_inicio == "" || $year_fin == "" ){
            $array_out = array("result"=>"error");
        }
        else{
            $array_out = $this->pago->registrosPorAnio($year_inicio, $year_fin,$conceptos);
        }
        $this->response($array_out);
    }

    public function tablaMonth_get(){
        $year = $this->get("year");
        $startMonth = $this->get("mes_inicio");
        $endMonth = $this->get("mes_fin");
        $conceptos = $this->get("conceptos");

        if($startMonth == "" or $endMonth == "" or $year == ""){
            $data = array('result'=>'error');
        }
        else if($startMonth > $endMonth){
            $data = array('result'=>'error');
        }
        else{
            $data = $this->pago->registrosPorMes($year,$startMonth,$endMonth, $conceptos);
        }
        $this->response($data);
    }

        //cambios diego
        public function listaConceptos_get(){
            //echo("Hola Mundo");
            //$array_out = $this->pago->listarConceptos();
            $array_out = $this->pago->listarProgramaXAnios();
            //echo(count($array_out));
            //echo($array_out[0]["sigla_programa"]." - ".$array_out[0]["anio_ingreso"]." - ".$array_out[0]["count"]);
            // $a1 = array('conceptos'=>array());
            //         $a1['conceptos'][] = 'giordano';
            //         $a1['conceptos'][] = 'gabriel';
            //echo($a1);
            //$array_out
            echo json_encode($array_out);
        }

        public function demandaSocial_get(){
            $fecha_inicio = $this->get("fecha_inicio");
            $fecha_fin = $this->get("fecha_fin");
            if($this->get("fecha_inicio")&& $this->get("fecha_fin")){
                $array_out = $this->pago->listarDemandaSocial($this->get("fecha_inicio"),$this->get("fecha_fin"));
                echo json_encode($array_out);
            }else{
                echo("Faltan algunos de los datos de la fecha_inicio o fecha_fin");
            }
        }
        public function relacionAlumnos_get(){
            $array_out = $this->pago->listarRelacionAlumnos();
            echo json_encode($array_out);
        }
        public function poblacionEstudiantil_get(){
            $array_out = $this->pago->listarPoblacionEstudiantil();
            echo json_encode($array_out);
        }
        public function poblacionDocente_get(){
            $array_out = $this->pago->listarPoblacionDocente();
            echo json_encode($array_out);
        }

        public function cantidadPorPeriodoAnio_get(){
            $yearStart = $this->get("year_inicio");
            $yearEnd = $this->get("year_fin");
            $conceptos = $this->get("conceptos");

            if($yearStart == "" or $yearEnd == ""){
                $data = array('result'=>'error');
            }
            else if($yearStart > $yearEnd){
                $data = array('result'=>'error');
            }
            else{
                $data = $this->pago->listarCantidadPeriodoAnual($yearStart,$yearEnd, $conceptos);
            }
            $this->response($data);
        }

        public function montoPorPeriodoAnio_get(){
            $yearStart = $this->get("year_inicio");
            $yearEnd = $this->get("year_fin");
            $conceptos = $this->get("conceptos");

            if($yearStart == "" or $yearEnd == ""){
                $data = array('result'=>'error');
            }
            else if($yearStart > $yearEnd){
                $data = array('result'=>'error');
            }
            else{
                $data = $this->pago->listarTotalPeriodoAnual($yearStart,$yearEnd, $conceptos);
            }
            $this->response($data);
        }

        public function cantidadPorPeriodoMes_get(){
            $year = $this->get("year");
            $startMonth = $this->get("mes_inicio");
            $endMonth = $this->get("mes_fin");
            $conceptos = $this->get("conceptos");

            if($startMonth == "" or $endMonth == "" or $year == ""){
                $data = array('result'=>'error');
            }
            else if($startMonth > $endMonth){
                $data = array('result'=>'error');
            }
            else{
                $data = $this->pago->listarCantidadPeriodoMensual($year,$startMonth,$endMonth , $conceptos);
            }
            $this->response($data);
        }
        public function totalPorPeriodoMes_get(){
            $year = $this->get("year");
            $startMonth = $this->get("mes_inicio");
            $endMonth = $this->get("mes_fin");
            $conceptos = $this->get("conceptos");

            if($startMonth == "" or $endMonth == "" or $year == ""){
                $data = array('result'=>'error');
            }
            else if($startMonth > $endMonth){
                $data = array('result'=>'error');
            }
            else{
                $data = $this->pago->listarTotalPeriodoMensual($year,$startMonth,$endMonth, $conceptos);
            }
            $this->response($data);
        }
}


 ?>
