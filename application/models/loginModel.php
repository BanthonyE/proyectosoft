<?php
class loginModel extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function validar($username){
               
                $this->db->select("*");
                $this->db->from("cliente");
                $this->db->where('nombre',$username);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        $var = $query->row();
                        $sess_array = array(
                                'idCliente' => $var->idCliente,
                                
                                'log' => true
                            );           
                            $this->session->set_userdata($sess_array);
                            
                        return $query->result();
                }

        }
        public function obtenerCliente($id){
                $this->db->select("*");
                $this->db->from("cliente");
                $this->db->where('idCliente',$id);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
        }

        public function crearSesion(){
                        $sess_array = array(
                                'idCliente' => "",
                                'log' => true
                        );           
                        $this->session->set_userdata($sess_array);
        }
}