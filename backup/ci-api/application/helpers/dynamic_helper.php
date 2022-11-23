<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function db_master($ip, $username, $password, $db){
    $db = array(
        'dsn'	=> '',
        'hostname' => $ip,
        'port' => '1433',
        'username' => $username,
        'password' => $password,
        'database' => $db,
        'dbdriver' => 'sqlsrv',
        'dbprefix' => '',
        'pconnect' => FALSE,
        'db_debug' => FALSE,
        'cache_on' => FALSE,
        'cachedir' => '',
        'char_set' => 'utf8',
        'dbcollat' => 'utf8_general_ci',
        'swap_pre' => '',
        'encrypt' => FALSE,
        'compress' => FALSE,
        'stricton' => FALSE,
        'autoinit' => FALSE,
        'failover' => array(),
        'save_queries' => TRUE
        );
    return $db;
}

