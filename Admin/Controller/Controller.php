<?php 
	
	class Controller
	{
		// 判断是否登录
		public function __construct()
		{
			// 防止死循环 
			if(empty($_SESSION['admin']['link'])){
				// 如果有cookie值, 先判断cookie
				if( $_COOKIE['name'] && $_COOKIE['pwd']   ){
					header('location: index.php?c=login&m=doCookie'); die;
				}
			}

			// 没有cookie, 直接判断session
			if( empty($_SESSION['admin']['name']) ){
				header('location: index.php?c=login'); die;
			}
		}

		public function error()
		{
			include '../public/error.html';
		}

	}

