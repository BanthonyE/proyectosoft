<?php
class docModel extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        public function subirCompras($data){
            
            return $this->db->insert('documento', $data);

        }

        public function registrarCuenta($data){
                return $this->db->insert('cuentas', $data);
        }

        public function listarCompras(){
            
                $this->db->select("*");
                $this->db->from("documento");
                $this->db->where("tipo", "compra");
                $this->db->where("activo", "Y");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
    
        }
        public function listarVentas(){
            
                $this->db->select("*");
                $this->db->from("documento");
                $this->db->where("tipo", "venta");
                $this->db->where("activo", "Y");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
    
        }

        public function listarPagos(){
            
                $this->db->select("*");
                $this->db->from("documento");
                $this->db->where("tipo", "compra");
                $this->db->where("activo", "N");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
    
        }

        public function listarCobros(){
            
                $this->db->select("*");
                $this->db->from("documento");
                $this->db->where("tipo", "venta");
                $this->db->where("activo", "N");
                $this->db->where("idCliente", $this->session->userdata('idCliente'));
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
    
        }

        public function listarCuentas(){
               $query = $this->db->select("*")
                                ->from("cuentas")
                                ->get();
                return $query->result();

        } 
        public function listarProveedor(){
                $query = $this->db->select("*")
                                 ->from("proveedor")
                                 ->where("idCliente", $this->session->userdata('idCliente'))
                                 ->get();
                 return $query->result();
 
         }
         public function listarEmpresa(){
                $query = $this->db->select("*")
                                 ->from("empresa")
                                 ->where("idCliente", $this->session->userdata('idCliente'))
                                 ->get();
                 return $query->result();
 
         }
         
        public function seleccionarDescripcion($codigo){
                $this->db->select("*");
                $this->db->from("cuentas");
                $this->db->where("codigo", $codigo);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
        }
        public function seleccionarRazonsocial($ruc){
                $this->db->select("*");
                $this->db->from("proveedor");
                $this->db->where("RUC", $ruc);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
        }
        public function seleccionarRazonsocialEmpresa($ruc){
                $this->db->select("*");
                $this->db->from("empresa");
                $this->db->where("RUC", $ruc);
                $query = $this->db->get();
                if(count($query->result()) > 0){
                        return $query->result();
                }
        }

        public function editarEstado($ruta){
                return  $this->db->update('documento', array('activo' => "N") , array( 'ruta' => $ruta));
         }
         public function editarEstado1($ruta){
                return  $this->db->update('documento', array('activo' => "F") , array( 'ruta' => $ruta));
         }

        

}