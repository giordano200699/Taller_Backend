<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Usuarios extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function loggin ($user,$pass,$tipo){

    	if($tipo == 'Alumno'){  // verificar usuario y pass, si existe devolver modulos asignados
    		$query = $this->db->query("
                SELECT nom_alumno as nombre , cod_alumno as id FROM public.alumno_programa
                WHERE  cod_alumno = '".$pass."' AND lower(correo) = '".$user."'
                "
            );

            $data = $query->result_array();

            if(count($data) == 1){
                $array_out = array("return"=>"success","id"=>$data[0]['id'],"user"=>$data[0]['nombre']);
                $query = $this->db->query("
                    SELECT id_mod as modulos FROM public.perfil_modulo
                    WHERE id_perfil = 4 ORDER BY id_mod;
                ");
                $array_out['modulos'] = $query->result_array();
            }
            else{
                $array_out = array("return"=>"failure");
            }


    	}
    	else if( $tipo == 'Docente'){ // verificar usuario y pass, si existe devolver modulos asignados
    		$query = $this->db->query("
    			SELECT nombres as nombre, id FROM public.docente
    			WHERE  (codigo = '".$pass."' OR nro_document = '".$pass."') AND lower(email) = '".$user."'"
            );

    		$data = $query->result_array();

    		if(count($data) == 1){
    			$array_out = array("return"=>"success","id"=>$data[0]['id'],"user"=>$data[0]['nombre']);
                $query = $this->db->query("
                    SELECT id_mod as modulos FROM public.perfil_modulo
                    WHERE id_perfil = 3 ORDER BY id_mod;
                ");
                $array_out['modulos'] = $query->result_array();
    		}
    		else{
    			$array_out = array("return"=>"failure");
    		}
    	}


        else if ( $tipo == 'Administrativo'){ //verificar usuario, pass y de perfil, si existe devolver modulos asignados
            $query = $this->db->query("
                SELECT u.user_name as nombre, u.pass, u.id_usuario as id FROM usuario as u
                INNER JOIN usuario_perfil p on (u.id_usuario = p.id_usuario)
                INNER JOIN perfil i on (i.id_perfil = p.id_perfil)
                WHERE i.id_perfil = 2 AND lower(u.user_name) = '".$user."' AND u.pass = '".$pass."'"
            );

            $data = $query->result_array();

            if(count($data) == 1){
                $array_out = array("return"=>"success","id"=>$data[0]['id'],"user"=>$data[0]['nombre']);
                $query = $this->db->query("
                    SELECT id_mod as modulos FROM public.usuario_modulo
                    WHERE id_usuario = ".$data[0]['id']." ORDER BY id_mod;
                ");
                $array_out['modulos'] = $query->result_array();
            }
            else{
                $array_out = array("return"=>"failure");
            }
        }

    	else if( $tipo == 'Administrador'){ //verificar usuario, pass y de perfil, si existe devolver modulos asignados
             $query = $this->db->query("
                SELECT u.user_name as nombre, u.pass, u.id_usuario as id FROM usuario as u
                INNER JOIN usuario_perfil p on (u.id_usuario = p.id_usuario)
                INNER JOIN perfil i on (i.id_perfil = p.id_perfil)
                WHERE i.id_perfil = 1 AND lower(u.user_name) = '".$user."' AND u.pass = '".$pass."'"
            );


            $data = $query->result_array();

            if(count($data) == 1){
                $array_out = array("return"=>"success","id"=>$data[0]['id'],"user"=>$data[0]['nombre']);
                $query = $this->db->query("
                    SELECT id_mod as modulos FROM public.usuario_modulo
                    WHERE id_usuario = ".$data[0]['id']." ORDER BY id_mod;
                ");
                $array_out['modulos'] = $query->result_array();
            }
            else{
                $array_out = array("return"=>"failure");
            }
    	}

    	return $array_out;
    }

    public function getModulos(){
        $query = $this->db->query("
            SELECT nombre_tipo as modulo FROM public.perfil
        ");
        return $query->result_array();
    }
}
