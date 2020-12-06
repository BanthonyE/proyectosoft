<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'loginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'loginController/login';
$route['volver'] = 'loginController/volver';
$route['ingresar'] = 'loginController/ingresar';
$route['ingresar1'] = 'loginController/ingresar1';


$route['inicio'] = 'contadorController';
$route['contador'] = 'contadorController/Clientes';
$route['insert'] = 'contadorController/insertarCliente';
$route['listar'] = 'contadorController/listarCliente';
$route['eliminar'] = 'contadorController/eliminarCliente';
$route['seleccionar'] = 'contadorController/seleccionarCliente';
$route['editar'] = 'contadorController/editarCliente';
$route['activo'] = 'contadorController/activoCliente';
$route['trabajo'] = 'contadorController/trabajoCliente';
$route['cuentas'] = 'contadorController/cuentas';

$route['libroDiario'] = 'contadorController/libroDiario';
$route['libroMayor'] = 'contadorController/libroMayor';
$route['ConsultarLibro'] = 'contadorController/ConsultarLibro';

$route['balanceComprobacion'] = 'contadorController/balanceComprobacion';

$route['estadoFinanciero'] = 'contadorController/estadoFinanciero';


$route['listarCTA'] = 'contadorController/listarCTA';
$route['registrarCuenta'] = 'contadorController/registrarCuenta';


$route['asientoCompras'] = 'contadorController/asientoCompras';
$route['listarDocCompras'] = 'contadorController/listarDocCompras';
$route['crearFormulario'] = 'contadorController/crearFormulario';
$route['registrarAsiento'] = 'contadorController/registrarAsiento';
$route['registrarAsiento2'] = 'contadorController/registrarAsiento2';



$route['asientoVentas'] = 'contadorController/asientoVentas';
$route['listarDocVentas'] = 'contadorController/listarDocVentas';
$route['crearFormularioVenta'] = 'contadorController/crearFormularioVenta';
$route['registrarAsientoVenta'] = 'contadorController/registrarAsientoVenta';


$route['asientoPagos'] = 'contadorController/asientoPagos';
$route['listarDocPagos'] = 'contadorController/listarDocPagos';
$route['crearFormularioPago'] = 'contadorController/crearFormularioPago';
$route['registrarAsientoPago'] = 'contadorController/registrarAsientoPago';


$route['asientoCobros'] = 'contadorController/asientoCobros';
$route['listarDocCobros'] = 'contadorController/listarDocCobros';
$route['crearFormularioCobro'] = 'contadorController/crearFormularioCobro';
$route['registrarAsientoCobro'] = 'contadorController/registrarAsientoCobro';


$route['listarAsiento'] = 'contadorController/listarAsiento';

$route['listarAsientoFecha'] = 'contadorController/listarAsientoFecha';




$route['docCompras'] = 'clienteController/docCompras';
$route['subirCompras'] = 'clienteController/subirCompras';


$route['docVentas'] = 'clienteController/docVentas';
$route['subirVentas'] = 'clienteController/subirVentas';



$route['listarCliente'] = 'clienteController/listarCliente';