<?php
define('DEFAULT_TITLE', 'Tasks');// titulo general para toda la pagina

$config = array(); //

$config ['production']= array();
$config ['production']['db'] = array();
$config ['production']['db']['host'] ='68.178.217.47';
$config ['production']['db']['name'] ='colsuizauser';
$config ['production']['db']['user'] ='colsuizauser';
$config ['production']['db']['password'] ='Colsuiza2018@';
$config ['production']['db']['port'] ='3306';
$config ['production']['db']['engine'] ='mysql';

$config ['staging']= array();
$config ['staging']['db'] = array();
$config ['staging']['db']['host'] ='localhost';
$config ['staging']['db']['name'] ='omegasol_revista_suiza';
$config ['staging']['db']['user'] ='omegasol_admin';
$config ['staging']['db']['password'] ='admin.2008';
$config ['staging']['db']['port'] ='3306';
$config ['staging']['db']['engine'] ='mysql';

$config ['development']= array();
$config ['development']['db'] = array();
$config ['development']['db']['host'] ='localhost';
$config ['development']['db']['name'] ='ng_task_db';
$config ['development']['db']['user'] ='root';
$config ['development']['db']['password'] = '';
$config ['development']['db']['port'] ='3306';
$config ['development']['db']['engine'] ='mysql';

