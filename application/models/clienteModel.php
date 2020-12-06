<?php
class clienteModel extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function listar(){
               $query = $this->db->get('cliente');
                if(count($query->result()) > 0){
                        return $query->result();
                }

        
        }

        public function insertar($data){
                
                return $this->db->insert('cliente', $data);
                
                /* $this->db->set('nombre',$data['nombre']);
                 $this->db->set('apellido',$data['apellido']);
                 return $this->db->insert('cliente');
                */

        }

        public function eliminar($id){
                return $this->db->delete('cliente', array('idCliente' => $id));
        }

        public function seleccionar($id){
                $this->db->select("*");
                $this->db->from("cliente");
                $this->db->where("idCliente", $id);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->row();
                }
        }

        public function editar($data){
               return  $this->db->update('cliente', $data, array( 'idCliente' => $data['idCliente']));
        }

        public function activo($data){
                $this->db->select("activo");
                $this->db->from("cliente");
                $this->db->where("idCliente", $data['idCliente']);
                $query = $this->db->get();
                $resultado = $query->row_array();
                        
                        if(  $resultado['activo'] == "N"){
                                $data['activo'] = 'Y';
                                return $this->db->update('cliente',$data , array( 'idCliente' => $data['idCliente']));
                        }else{
                                $data['activo'] = 'N';
                                return $this->db->update('cliente',$data , array( 'idCliente' => $data['idCliente']));
                        }
                }

}