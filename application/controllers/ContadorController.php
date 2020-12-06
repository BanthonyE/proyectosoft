<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContadorController extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('clienteModel');
		$this->load->model('docModel');
		$this->load->model('asientoModel');
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
		$this->output->set_header("Access-Control-Allow-Origin:*");
		
	}


	public function index()
	{
		
		$this->load->view('layout/menu');
		$this->load->view('layout/header');
		$this->load->view('contador/inicio.php');
		$this->load->view('layout/footer');
	}

	public function Clientes(){

		
		$this->load->view('layout/menu');
		$this->load->view('layout/header');
		$this->load->view('contador/contador.php');
		$this->load->view('layout/footer');
		
		
		
	}


	public function insertarCliente(){
        if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('nombre','Nombre','required');
			$this->form_validation->set_rules('apellido','Apellido','required');

			if ($this->form_validation->run() == FALSE){
					
				$data = array('responce' => 'error' , 'message' => validation_errors());

			}
			else{
				$ajax_data = $this->input->post();

				if($this->clienteModel->insertar($ajax_data)){
					$data = array('responce' => 'success' , 'message' => 'Se Agrego Cliente');
				}else{
					$data = array('responce' => 'error' , 'message' => 'Error al agregar cliente');
				}

				
			}

        }else{
            echo "No direct script access allowed";
		}
		
		echo json_encode($data);

    }


	public function listarCliente(){

		if( $this->input->is_ajax_request() ) {
			$posts = $this->clienteModel->listar();
			
			echo json_encode($posts);
		}

	}


	public function listarAsiento(){

		if( $this->input->is_ajax_request() ) {
			$posts = $this->asientoModel->listarAsiento();
			
			echo json_encode($posts);
		}

	}
	public function listarAsientoFecha(){
		$fecha1 = $this->input->post('fecha1');
		$fecha2 = $this->input->post('fecha2');

		if( $this->input->is_ajax_request() ) {
			$posts = $this->asientoModel->listarAsientoFecha($fecha1,$fecha2);
			
			echo json_encode($posts);
		}
	}
	

	public function eliminarCliente(){

		if( $this->input->is_ajax_request() ) {
			$del_id = $this->input->post('del_id');
			if( $this->clienteModel->eliminar($del_id)){
				$data = array('responce' => "success");
			}else{
				$data = array('responce' => "error");
			}
			
			echo json_encode($data);
		}
	}

		public function seleccionarCliente(){

			if( $this->input->is_ajax_request() ) {
				$edit_id = $this->input->post('edit_id');

				if( $post = $this->clienteModel->seleccionar($edit_id)){
					$data = array('responce' => "success" , 'post' => $post);
				}else{
					$data = array('responce' => "error", 'message' => 'failed');
				}
				
				echo json_encode($data);
			}


	}



	public function editarCliente(){

		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('edit_nombre','Nombre','required');
			$this->form_validation->set_rules('edit_apellido','Apellido','required');
			$this->form_validation->set_rules('edit_RUC','RUC','required');
			$this->form_validation->set_rules('edit_razon_social','Razon_social','required');

			if ($this->form_validation->run() == FALSE){
					
				$data = array('responce' => 'error' , 'message' => validation_errors());

			}
			else{
				$data['idCliente'] = $this->input->post('edit_id');
				$data['nombre'] = $this->input->post('edit_nombre');
				$data['apellido'] = $this->input->post('edit_apellido');
				$data['RUC'] = $this->input->post('edit_RUC');
				$data['razon_social'] = $this->input->post('edit_razon_social');

				if($this->clienteModel->editar($data)){
					$data = array('responce' => 'success' , 'message' => 'Se Actualizo Cliente');
				}else{
					$data = array('responce' => 'error' , 'message' => 'Error al agregar cliente');
				}

				
			}

        }else{
            echo "No direct script access allowed";
		}
		
		echo json_encode($data);


}




public function activoCliente(){

	if($this->input->is_ajax_request()){

		$data['idCliente'] = $this->input->post('act_id');

		if($this->clienteModel->activo($data)){
			$data = array('responce' => 'success' , 'message' => 'Se Actualizo cliente' );
		}else{
			$data = array('responce' => 'error'  , 'message' => 'Error al Actualizar cliente');
		}
	
	}else{
		echo "No direct script access allowed";
	}
	
	echo json_encode($data);


}

public function trabajoCliente(){
	if($this->input->is_ajax_request()){

		

		if($this->session->set_userdata('idCliente', $this->input->post('id'))){
			$data = array('responce' => 'success' , 'message' => 'Cliente listo' );
		}else{
			$data = array('responce' => 'error'  , 'message' => 'Error al seleccionar cliente');
		}
	
	}else{
		echo "No direct script access allowed";
	}
	
	echo json_encode($data);

}


public function asientoCompras(){

		$this->load->view('layout/menu');
		$this->load->view('layout/header');
		$this->load->view('contador/asientoCompras.php');
		$this->load->view('layout/footer');

}

public function asientoVentas(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/asientoVentas.php');
	$this->load->view('layout/footer');
}

public function asientoCobros(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/asientoCobros.php');
	$this->load->view('layout/footer');
}

public function asientoPagos(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/asientoPagos.php');
	$this->load->view('layout/footer');
}

public function ConsultarLibro(){
	if( $this->input->is_ajax_request() ) {

		$cuenta = $this->input->post('select1');
		$asientos = $this->asientoModel->listarAsientos($cuenta);
		$data['cuenta'] = $cuenta ;
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['saldoDeudor'] = 0;
		$data['saldoAcreedor'] = 0;
		foreach ($asientos as $a) {
			$data['saldoDeudor'] += $a->debito;
			$data['saldoAcreedor'] += $a->credito;
		}
		if($data['saldoAcreedor']>$data['saldoDeudor']){
			$data['saldoAcreedor'] = $data['saldoAcreedor'] - $data['saldoDeudor'];
			$data['saldoDeudor'] = 0;
		}else{
			$data['saldoDeudor'] = $data['saldoDeudor'] - $data['saldoAcreedor'];
			$data['saldoAcreedor'] = 0;
		}


		
	}
	echo json_encode($data);
}
public function listarDocCompras(){

	if( $this->input->is_ajax_request() ) {
		$posts = $this->docModel->listarCompras();
		
		echo json_encode($posts);
	}

}

public function listarDocVentas(){

	if( $this->input->is_ajax_request() ) {
		$posts = $this->docModel->listarVentas();
		
		echo json_encode($posts);
	}

}

public function listarDocPagos(){

	if( $this->input->is_ajax_request() ) {
		$posts = $this->docModel->listarPagos();
		
		echo json_encode($posts);
	}

}


public function listarDocCobros(){

	if( $this->input->is_ajax_request() ) {
		$posts = $this->docModel->listarCobros();
		
		echo json_encode($posts);
	}

}

public function listarCTA(){
	if( $this->input->is_ajax_request() ) {
		$data["cuentas"] = $this->docModel->listarCuentas();
		$data["asiento"] = $this->asientoModel->listarAsiento();
		echo json_encode($data);
	}
}

public function crearFormulario(){
	if( $this->input->is_ajax_request() ) {
		$data["cuentas"] = $this->docModel->listarCuentas();
		$data["proveedor"] = $this->docModel->listarProveedor();
		
		echo json_encode($data);
	}
}


public function registrarAsiento(){
	if($this->input->is_ajax_request()){
		
		$data['origen'] = "compras";
		$data['correlativo'] = (int)$this->obtenerCorrelativo() + 1;
		$data['idCliente'] =$this->session->userdata('idCliente');
		$data['cuenta'] = $this->input->post('select1');
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['debito'] = (float)$this->input->post('importe');
		$data['credito'] = (int)0;
		$data['moneda'] = $this->input->post('tipoMoneda');
		$data['tipoCambio'] = (float)1;
		$data['fecha'] = $this->input->post('fechaComprobante');
		$data['concepto'] = $this->input->post('glosaM');
		$data['codigo'] = $this->input->post('RUCProveedor');
		$data['razon_social'] = $this->seleccionarRazonSocial($this->input->post('RUCProveedor'))[0]->razon_social; 
		$data['tipoDocumento'] = $this->input->post('selectTipoCompr');
		$data['numero'] = $this->input->post('numeroComprobante');
		$data['fechaEmision'] = $this->input->post('fechaEmision');
		$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
		$data['ruta'] = $this->input->post('ruta');
		
		if( $this->asientoModel->registrarAsiento($data)){

			if($this->input->post('IGV') == "true"){
				$data['debito']= 0.18 * (float)$this->input->post('importe');
				$data['cuenta'] = "40111001";
				$data['descripcion'] =  $this->seleccionarDescripcion("40111001")[0]->descripcion;
				if( $this->asientoModel->registrarAsiento($data)){
					$data['credito']= (float)$this->input->post('importe') + (float)$data['debito'];
					$var = (float)$this->input->post('importe');
					$data['debito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 
					if( $this->asientoModel->registrarAsiento($data)){
						$dato = array(
							'responce' => 'success' ,
							'message' => 'Se REGISTRO ASIENTO',
							'importe' => $var 
						);
							
					}else{	
						$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
								
									
					}

						
					
				}
				
			}else{
					$data['credito']= (float)$this->input->post('importe') ;
					$var = (float)$this->input->post('importe');
					$data['debito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 
					if( $this->asientoModel->registrarAsiento($data)){
						$dato = array(
							'responce' => 'success' ,
							'message' => 'Se REGISTRO ASIENTO',
							'importe' => $var 
						);
							
					}else{	
						$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
								
									
					}



			}

		}
		

	}
	
	echo json_encode($dato);
}

public function registrarAsiento2(){
	if($this->input->is_ajax_request()){
		
		$data['origen'] = "compras";
		$data['correlativo'] = (int)$this->obtenerCorrelativo() + 1;
		$data['idCliente'] =$this->session->userdata('idCliente');
		$data['cuenta'] = $this->input->post('select1');
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['debito'] = (float)$this->input->post('importe');
		$data['credito'] = (int)0;
		$data['moneda'] = $this->input->post('tipoMoneda');
		$data['tipoCambio'] = (float)1;
		$data['fecha'] = $this->input->post('fechaComprobante');
		$data['concepto'] = $this->input->post('glosaM');
		$data['codigo'] = $this->input->post('RUCProveedor');
		$data['razon_social'] = $this->seleccionarRazonSocial($this->input->post('RUCProveedor'))[0]->razon_social; 
		$data['tipoDocumento'] = $this->input->post('selectTipoCompr');
		$data['numero'] = $this->input->post('numeroComprobante');
		$data['fechaEmision'] = $this->input->post('fechaEmision');
		$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
		$data['ruta'] = $this->input->post('ruta');
		
		if( $this->asientoModel->registrarAsiento($data)){

			
				
				
					$data['credito']= (float)$this->input->post('importe');
					$data['debito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 
					if( $this->asientoModel->registrarAsiento($data)){
						
						
							
						$ruta = $this->input->post('ruta');
						if($this->docModel->editarEstado($ruta)){
							$dato = array('responce' => 'success' , 'message' => 'Se REGISTRO ASIENTO' );
						}else{
							$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
						}

						
					}
				
				
			

		}
		

	}
	
	echo json_encode($dato);
}



public function seleccionarDescripcion($codigo){
	return $this->docModel->seleccionarDescripcion($codigo);
}

public function seleccionarRazonSocial($ruc){
	return $this->docModel->seleccionarRazonSocial($ruc);
}

public function seleccionarRazonSocialEmpresa($ruc){
	return $this->docModel->seleccionarRazonSocialEmpresa($ruc);
}



public function crearFormularioVenta(){
	if( $this->input->is_ajax_request() ) {
		$data["cuentas"] = $this->docModel->listarCuentas();
		$data["empresa"] = $this->docModel->listarEmpresa();
		
		echo json_encode($data);
	}
}


public function registrarAsientoVenta(){
	if( $this->input->is_ajax_request() ){
		
		
		$data['origen'] = "ventas";
		$data['correlativo'] = 1 + (int)$this->obtenerCorrelativo();
		
		$data['idCliente'] =$this->session->userdata('idCliente');
		$data['cuenta'] = $this->input->post('select1');
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['debito'] = (int)0;
		$data['credito'] = (float)$this->input->post('importe');
		$data['moneda'] = $this->input->post('tipoMoneda');
		$data['tipoCambio'] = (float)1;
		$data['fecha'] = $this->input->post('fechaComprobante');
		$data['concepto'] = $this->input->post('glosaM');
		$data['codigo'] = $this->input->post('RUCEmpresa');
		$data['razon_social'] = $this->seleccionarRazonSocialEmpresa($this->input->post('RUCEmpresa'))[0]->razon_social; 
		$data['tipoDocumento'] = $this->input->post('selectTipoCompr');
		$data['numero'] = $this->input->post('numeroComprobante');
		$data['fechaEmision'] = $this->input->post('fechaEmision');
		$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
		$data['ruta'] = $this->input->post('ruta');
		
		
		if( $this->asientoModel->registrarAsiento($data)){

			if($this->input->post('IGV') == "true"){

				$data['credito']= 0.18 * (float)$this->input->post('importe');
				$data['cuenta'] = "40111001";
				$data['descripcion'] =  $this->seleccionarDescripcion("40111001")[0]->descripcion;

				if( $this->asientoModel->registrarAsiento($data)){

					$data['debito']= (float)$this->input->post('importe') + (float)$data['credito'];
					$data['credito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 

					if( $this->asientoModel->registrarAsiento($data)){

						$ruta = $this->input->post('ruta');
						if($this->docModel->editarEstado($ruta)){
							$dato = array('responce' => 'success' , 'message' => 'Se REGISTRO ASIENTO' );
						}else{
							$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
						}
									
							

						
					}
				}
				
			}else{
					$data['debito']= (float)$this->input->post('importe');
					$data['credito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 

				if( $this->asientoModel->registrarAsiento($data)){

					$ruta = $this->input->post('ruta');

					if($this->docModel->editarEstado($ruta)){
						$dato = array('responce' => 'success' , 'message' => 'Se REGISTRO ASIENTO' );
					}else{
						$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
					}
								
						

					
				}

			}

		}
		
	
	}
	
	echo json_encode($dato);
}




public function crearFormularioCobro(){
	if( $this->input->is_ajax_request() ) {
		$data["cuentas"] = $this->docModel->listarCuentas();
		$data["empresa"] = $this->docModel->listarEmpresa();
		
		echo json_encode($data);
	}
}


public function registrarAsientoCobro(){
	if($this->input->is_ajax_request()){
		
		$data['origen'] = "cobros";
		$data['correlativo'] = (int)$this->obtenerCorrelativo() + 1;
		$data['idCliente'] =$this->session->userdata('idCliente');
		$data['cuenta'] = $this->input->post('select1');
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['debito'] = (float)$this->input->post('importe');
		$data['credito'] = (int)0;
		$data['moneda'] = $this->input->post('tipoMoneda');
		$data['tipoCambio'] = (float)1;
		$data['fecha'] = $this->input->post('fechaComprobante');
		$data['concepto'] = $this->input->post('glosaM');
		$data['codigo'] = $this->input->post('RUCEmpresa');
		$data['razon_social'] = $this->seleccionarRazonSocialEmpresa($this->input->post('RUCEmpresa'))[0]->razon_social; 
		$data['tipoDocumento'] = $this->input->post('selectTipoCompr');
		$data['numero'] = $this->input->post('numeroComprobante');
		$data['fechaEmision'] = $this->input->post('fechaEmision');
		$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
		$data['ruta'] =$this->input->post('ruta');

		if( $this->asientoModel->registrarAsiento($data)){

			
				$data['credito']= (float)$this->input->post('importe');
				$data['debito']= (float)0;
				$data['cuenta'] = $this->input->post('select2');
				$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion;
							if( $this->asientoModel->registrarAsiento($data)){

									$ruta = $this->input->post('ruta');
									if($this->docModel->editarEstado1($ruta)){
										$dato = array('responce' => 'success' , 'message' => 'Se REGISTRO ASIENTO' );
									}else{
										$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
							}
									
							

						
					}
				
				
			

		}
		

	}
	
	echo json_encode($dato);
}



public function crearFormularioPago(){
	if( $this->input->is_ajax_request() ) {
		$data["cuentas"] = $this->docModel->listarCuentas();
		$data["proveedor"] = $this->docModel->listarProveedor();
		
		echo json_encode($data);
	}
}


public function registrarAsientoPago(){
	if($this->input->is_ajax_request()){
		
		$data['origen'] = "pagos";
		$data['correlativo'] = (int)$this->obtenerCorrelativo() + 1;
		$data['idCliente'] =$this->session->userdata('idCliente');
		$data['cuenta'] = $this->input->post('select1');
		$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select1'))[0]->descripcion; 
		$data['debito'] = (float)$this->input->post('importe');
		$data['credito'] = (int)0;
		$data['moneda'] = $this->input->post('tipoMoneda');
		$data['tipoCambio'] = (float)1;
		$data['fecha'] = $this->input->post('fechaComprobante');
		$data['concepto'] = $this->input->post('glosaM');
		$data['codigo'] = $this->input->post('RUCProveedor');
		$data['razon_social'] = $this->seleccionarRazonSocial($this->input->post('RUCProveedor'))[0]->razon_social; 
		$data['tipoDocumento'] = $this->input->post('selectTipoCompr');
		$data['numero'] = $this->input->post('numeroComprobante');
		$data['fechaEmision'] = $this->input->post('fechaEmision');
		$data['fechaVencimiento'] = $this->input->post('fechaVencimiento');
		$data['ruta'] =$this->input->post('ruta');

		if( $this->asientoModel->registrarAsiento($data)){

			
				
					$data['credito']= (float)$this->input->post('importe') ;
					$data['debito']= (float)0;
					$data['cuenta'] = $this->input->post('select2');
					$data['descripcion'] =  $this->seleccionarDescripcion($this->input->post('select2'))[0]->descripcion; 
					if( $this->asientoModel->registrarAsiento($data)){
						
						
								$ruta = $this->input->post('ruta');
								if($this->docModel->editarEstado1($ruta)){
									$dato = array('responce' => 'success' , 'message' => 'Se REGISTRO ASIENTO' );
								}else{
									$dato = array('responce' => 'error' , 'message' => 'HUBO UN ERROR AL REGISTRAR' );
								}
									
							

						
					}
				
				
			

		}
		

	}
	
	echo json_encode($dato);
}


public function obtenerCorrelativo(){
	if($this->asientoModel->obtenerCorrelativo1()){
		$resultado = $this->asientoModel->obtenerCorrelativo1();
		return (int)$resultado[0]->correlativo;
	}else{
		return (int)0;
	}
	
}




public function libroDiario(){
		$this->load->view('layout/menu');
		$this->load->view('layout/header');
		$this->load->view('contador/libroDiario.php');
		$this->load->view('layout/footer');
}


public function BalanceComprobacion(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/BalanceComprobacion.php');
	$this->load->view('layout/footer');
}
public function estadoFinanciero(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/estadoFinanciero.php');
	$this->load->view('layout/footer');
}

public function libroMayor(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/libroMayor.php');
	$this->load->view('layout/footer');
}


public function cuentas(){
	$this->load->view('layout/menu');
	$this->load->view('layout/header');
	$this->load->view('contador/cuentas.php');
	$this->load->view('layout/footer');
}

public function registrarCuenta(){
	if( $this->input->is_ajax_request() ) {
		$data['codigo'] = $this->input->post('codigo');
		$data['descripcion'] = $this->input->post('descripcion');
		$data['tipo'] = $this->input->post('tipo');

		if($this->docModel->registrarCuenta($data)){
			$dato = array('responce' => 'success' , 'message' => 'Se Registro Cuenta' );
		}else{
			$dato = array('responce' => 'error' , 'message' => 'Hubo un error al Registrar Cuenta' );
		}
		
		
		echo json_encode($dato);
	}
}


}