<?php 
	// 后台中心管理
	

	// 加载相关文件
		include '../Public/config.php';

	// 接收类名   方法名
	// 控制器 controller  c  方法 method  m
	// 
		$c  = empty($_GET['c'])? 'index': $_GET['c'];
		$c .='Controller'; 
		$m  = empty($_GET['m'])? 'index': $_GET['m'];

	// 实例化  和使用方法
		$control = new $c;

		// 判断方法是否存在
		if(  !method_exists($c,$m)  ){
			notice('不要乱看哦,去购物吧','index.php');
		}
		$control ->$m();


	// 自动加载类
	
		function  __autoload($k){
			if(file_exists("Controller/{$k}.php ") ){
				
				include "Controller/{$k}.php";


			}elseif(file_exists("Model/{$k}.php")){

				include "Model/{$k}.php";

			}elseif(file_exists("../Public/{$k}.php")){

				include "../Public/{$k}.php";

			}else{
				
				// var_dump($k);die;
				notice('系统维护','index.php');
			}
		}
		

		
			
