<?php
class asientoModel extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function registrarAsiento($data){
            return $this->db->insert('asiento',$data);
        }

        public function listarAsiento(){
                $this->db->select("*");
                $this->db->from("asiento");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
 
         
         }

         public function listarAsientoFecha( $fecha1 , $fecha2){
                $this->db->select("*");
                $this->db->from("asiento");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
 
         
         }



         public function listarAsientos($cuenta){

                $this->db->select("*");
                $this->db->from("asiento");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $this->db->where("cuenta", $cuenta);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }

         }

         public function obtenerCorrelativo1(){
                $var = $this->db->query('
                SELECT * FROM `asiento` order by idAsiento DESC limit 1
                '                    
                );
             if(count($var->result()) > 0){
                                return $var->result();
                }else{
                        return FALSE;
                }
                   
         }
        
}