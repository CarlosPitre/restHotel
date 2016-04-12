<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/clientes']            = 'clientes/clientes';
$route['api/clientes/(:num)']     = 'clientes/clientes/$1';
$route['api/habitaciones']        = 'habitaciones/habitaciones';
$route['api/habitaciones/(:num)'] = 'habitaciones/habitaciones/$1';
$route['api/reservas']            = 'reservas/reservas'; 
$route['api/reservas/(:num)']     = 'reservas/reservas/$1';
$route['api/checkin']             = 'checkin/checkin';
$route['api/checkin/(:num)']      = 'checkin/checkin/$1';
$route['api/checkout']            = 'checkout/checkout';
$route['api/checkout/(:num)']     = 'checkout/checkout/$1';
$route['api/usuarios']            = 'usuarios/usuarios';
$route['api/usuarios/(:num)']     = 'usuarios/usuarios/$1';
$route['api/login']			   	  = 'usuarios/login/login';
$route['api/menu/(:num)']		  = 'usuarios/menu/$1';
$route['api/perfiles']            = 'perfiles/perfiles';
$route['api/perfiles/(:num)']     = 'perfiles/perfiles/$1';
$route['api/servicios']           = 'servicios/servicios';
$route['api/servicios/(:num)']    = 'servicios/servicios/$1';
$route['api/categorias']          = 'categorias/categorias';
$route['api/categorias/(:num)']   = 'categorias/categorias/$1';
$route['api/departamentos']		  = 'clientes/departamentos';
$route['api/municipios/(:num)']		  = 'clientes/municipios/$1';
$route['api/cliente/(:num)/reservas'] = 'reservas/getReservasClientes/$1';
$route['api/reserva/(:num)/habitaciones'] = 'reservas/getHabitacionesReservas/$1';


