<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'srsnova',
	'database' => 'migration',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['gp'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'srsnova',
	'database' => 'gp',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['branch_server']['hostname'] = '192.168.133.100';
$db['branch_server']['username'] = 'markuser';
$db['branch_server']['password'] = 'tseug';
$db['branch_server']['database'] = 'SBSTAMARIA';
//$db['branch_server']['database'] = 'IMUS_92718';
//$db['branch_server']['dbdriver'] = 'sqlsrv';
$db['branch_server']['dbdriver'] = 'mssql';
$db['branch_server']['dbprefix'] = '';
$db['branch_server']['pconnect'] = TRUE;
$db['branch_server']['db_debug'] = FALSE;
$db['branch_server']['cache_on'] = FALSE;
$db['branch_server']['cachedir'] = '';
$db['branch_server']['char_set'] = 'utf8';
$db['branch_server']['dbcollat'] = 'utf8_general_ci';
$db['branch_server']['swap_pre'] = '';
$db['branch_server']['autoinit'] = TRUE;
$db['branch_server']['stricton'] = FALSE; 

$db['133']['hostname'] = '192.168.133.100';
$db['133']['username'] = 'markuser';
$db['133']['password'] = 'tseug';
$db['133']['database'] = 'SBSTAMARIA';
//$db133er']['database'] = 'IMUS_92718';
//$db133er']['dbdriver'] = 'sqlsrv';
$db['133']['dbdriver'] = 'mssql';
$db['133']['dbprefix'] = '';
$db['133']['pconnect'] = TRUE;
$db['133']['db_debug'] = FALSE;
$db['133']['cache_on'] = FALSE;
$db['133']['cachedir'] = '';
$db['133']['char_set'] = 'utf8';
$db['133']['dbcollat'] = 'utf8_general_ci';
$db['133']['swap_pre'] = '';
$db['133']['autoinit'] = TRUE;
$db['133']['stricton'] = FALSE; 

$db['po_received_server']['hostname'] = '192.168.0.217';
$db['po_received_server']['username'] = 'root';
$db['po_received_server']['password'] = 'srsnova';
$db['po_received_server']['database'] = 'received_po';
//$db['po_received_server']['dbdriver'] = 'sqlsrv';
$db['po_received_server']['dbdriver'] = 'mysql';
$db['po_received_server']['dbprefix'] = '';
$db['po_received_server']['pconnect'] = FALSE;
$db['po_received_server']['db_debug'] = FALSE;
$db['po_received_server']['cache_on'] = FALSE;
$db['po_received_server']['cachedir'] = '';
$db['po_received_server']['char_set'] = 'utf8';
$db['po_received_server']['dbcollat'] = 'utf8_general_ci';
$db['po_received_server']['swap_pre'] = '';
$db['po_received_server']['autoinit'] = TRUE;
$db['po_received_server']['stricton'] = FALSE; 

$db['TNOV']['hostname'] = "192.168.0.179";
$db['TNOV']['username'] = 'markuser';
$db['TNOV']['password'] = 'tseug';
$db['TNOV']['database'] = 'srspos';
//$db['TNOV']['dbdriver'] = 'sqlsrv';
$db['TNOV']['dbdriver'] = 'mssql';
$db['TNOV']['dbprefix'] = '';
$db['TNOV']['pconnect'] = TRUE;
$db['TNOV']['db_debug'] = FALSE;
$db['TNOV']['cache_on'] = FALSE;
$db['TNOV']['cachedir'] = '';
$db['TNOV']['char_set'] = 'utf8';
$db['TNOV']['dbcollat'] = 'utf8_general_ci';
$db['TNOV']['swap_pre'] = '';
$db['TNOV']['autoinit'] = TRUE;
$db['TNOV']['stricton'] = FALSE; 
