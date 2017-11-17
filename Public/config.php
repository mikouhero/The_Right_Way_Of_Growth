<?php 
	include 'function.php';

	define('DSN', 'mysql:dbname=s70;charset=utf8;host=localhost');

	define('USER', 'root');

	define('PWD', '');

	session_start();

	header('content-type: text/html; charset=utf-8');

	date_default_timezone_set("PRC");

	error_reporting(E_ALL ^E_NOTICE);


	//后台的css   js   image 的地址


	define('AC','Include/css/'); 
	define('AJ','Include/js/'); 
	define('AI','Include/images/'); 


	// 后台每页显示的个数
	define('AP',5);

