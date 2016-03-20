<?php
/*
 * 下面别修改
 */
//medoo

error_reporting(0);

//Define DB Table Name
$db_table['user'] = "user";

//Version
$version   ="7.6.6";

//Safe is very important
foreach($_GET as $k => $v){
	if(is_array($v)){
		die('Array is not allowed to give in this system');
	}
}
foreach($_POST as $k => $v){
	if(is_array($v)){
		die('Array is not allowed to give in this system');
	}
}
foreach($_COOKIE as $k => $v){
	if(is_array($v)){
		die('Array is not allowed to give in this system');
	}
}

//set timezone
date_default_timezone_set('PRC');


//Define system Path
$ss_path = __DIR__;
$ss_path = substr($ss_path,0,strlen($ss_path)-4);
define('SS_PATH',$ss_path);
//autoload class
spl_autoload_register('autoload');
function autoload($class){
    require_once SS_PATH.'/lib/'.str_replace('\\','/',$class).'.php';
}
require_once 'Ss/Ext/Medoo.php';
$db = new medoo([
    // required
    'database_type' => DB_TYPE,
    'database_name' => DB_DBNAME,
    'server' => DB_HOST,
    'username' => DB_USER,
    'password' => DB_PWD,
    'charset' => DB_CHARSET,

    // optional
    'port' => 3306,
    // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
    'option' => [
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);
$Runtime= new \Ss\Etc\Runtime();
$Runtime->Start();
