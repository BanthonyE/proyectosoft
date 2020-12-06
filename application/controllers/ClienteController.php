<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClienteController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('cliente_model');
		$this->load->model('doc_model');
		$this->load->model('login_model');
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->output->set_header("Access-Control-Allow-Origin:*");
		
	}



	public function index()
	{
		$this->load->view('layout/menu1');
		$this->load->view('layout/header1');
		$this->load->view('layout/footer');
	}

	public function listarCliente(){

		if( $this->input->is_ajax_request() ) {
			$posts = $this->loginModel->obtenerCliente($this->session->userdata('idCliente'));
			
			echo json_encode($posts);
		}

	}


	public function docCompras(){
		$this->load->view('layout/menu1');
		$this->load->view('layout/header1');
		$this->load->view('cliente/docCompras');
		$this->load->view('layout/footer');
	}

	public function docVentas(){
		$this->load->view('layout/menu1');
		$this->load->view('layout/header1');
		$this->load->view('cliente/docVentas');
		$this->load->view('layout/footer');
	}

	/*public function docPagos(){
		$this->load->view('layout/menu1');
		$this->load->view('layout/header1');
		$this->load->view('cliente/docPagos');
		$this->load->view('layout/footer');
	}


	public function docCobros(){
		$this->load->view('layout/menu1');
		$this->load->view('layout/header1');
		$this->load->view('cliente/docCobros');
		$this->load->view('layout/footer');
	}
*/



public function subirCompras(){
	 
		$mi_archivo = "mi_archivo";
		$nombre = $this->input->post('nombre_archivo');
        $config['upload_path'] = "assets/documentos/compras";
        $config['file_name'] = "compras";
        $config['allowed_types'] = "pdf";
        $config['max_size'] = "500";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('layout/menu1');
			$this->load->view('layout/header1');
			$this->load->view('cliente/docCompras',$data);
			$this->load->view('layout/footer');
        }else{
			$file_info = $this->upload->data();
			
			$datos['idCliente'] = $this->session->userdata('idCliente');
			$datos['ruta'] = $file_info['file_name'];
			$datos['tipo'] = "compra";
			if($this->docModel->subirCompras($datos)){
				$data['mensaje'] = "Se Cargo el Archivo Correctamente";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docCompras',$data);
				$this->load->view('layout/footer');
			}else{
				$data['error'] = "No se pudo Subir el documento";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docCompras',$data);
				$this->load->view('layout/footer');
			}

			
		}

		
    }




	public function subirVentas(){
	 
		$mi_archivo = "mi_archivo";
		$nombre = $this->input->post('nombre_archivo');
        $config['upload_path'] = "assets/documentos/ventas";
        $config['file_name'] = "ventas";
        $config['allowed_types'] = "pdf";
        $config['max_size'] = "500";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('layout/menu1');
			$this->load->view('layout/header1');
			$this->load->view('cliente/docVentas',$data);
			$this->load->view('layout/footer');
        }else{
			$file_info = $this->upload->data();
			
			$datos['idCliente'] = $this->session->userdata('idCliente');
			$datos['ruta'] = $file_info['file_name'];
			$datos['tipo'] = "venta";
			if($this->docModel->subirCompras($datos)){
				$data['mensaje'] = "Se Cargo el Archivo Correctamente";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docVentas',$data);
				$this->load->view('layout/footer');
			}else{
				$data['error'] = "No se pudo Subir el documento";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docVentas',$data);
				$this->load->view('layout/footer');
			}

			
		}

		
    }
/*
	public function subirPagos(){
	 
		$mi_archivo = "mi_archivo";
		$nombre = $this->input->post('nombre_archivo');
        $config['upload_path'] = "assets/documentos/pagos";
        $config['file_name'] = "pagos";
        $config['allowed_types'] = "pdf";
        $config['max_size'] = "500";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('layout/menu1');
			$this->load->view('layout/header1');
			$this->load->view('cliente/docPagos',$data);
			$this->load->view('layout/footer');
        }else{
			$file_info = $this->upload->data();
			
			$datos['idCliente'] = $this->session->userdata('idCliente');
			$datos['ruta'] = $file_info['file_name'];
			$datos['tipo'] = "pago";
			if($this->docModel->subirCompras($datos)){
				$data['mensaje'] = "Se Cargo el Archivo Correctamente";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docPagos',$data);
				$this->load->view('layout/footer');
			}else{
				$data['error'] = "No se pudo Subir el documento";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docPagos',$data);
				$this->load->view('layout/footer');
			}

			
		}

		
	}
	
	public function subirCobros(){
	 
		$mi_archivo = "mi_archivo";
		$nombre = $this->input->post('nombre_archivo');
        $config['upload_path'] = "assets/documentos/cobros";
        $config['file_name'] = "cobros";
        $config['allowed_types'] = "pdf";
        $config['max_size'] = "500";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";

        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('layout/menu1');
			$this->load->view('layout/header1');
			$this->load->view('cliente/docCobros',$data);
			$this->load->view('layout/footer');
        }else{
			$file_info = $this->upload->data();
			
			$datos['idCliente'] = $this->session->userdata('idCliente');
			$datos['ruta'] = $file_info['file_name'];
			$datos['tipo'] = "cobro";
			if($this->docModel->subirCompras($datos)){
				$data['mensaje'] = "Se Cargo el Archivo Correctamente";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docCobros',$data);
				$this->load->view('layout/footer');
			}else{
				$data['error'] = "No se pudo Subir el documento";
				$this->load->view('layout/menu1');
				$this->load->view('layout/header1');
				$this->load->view('cliente/docCobros',$data);
				$this->load->view('layout/footer');
			}

			
		}

		
    }
	  
*/


}
