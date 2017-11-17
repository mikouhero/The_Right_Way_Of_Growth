<?php 
	
	class Controller
	{
		// 判断是否登录
		public function __construct()
		{
		
			if( empty($_SESSION['user']) ){
				header('location: index.php?c=login'); die;
			}
		}
		
		
		public function header()
		{
			 //  查询 所有的 1级分类
          
        	  $goods = new indexModel;
          	$data = $cate = $goods->getCate();
          	// var_dump($data);
			include "View/index/header.html";
		}

		public function footer()
		{
			include 'View/index/footer.html';
		}
		
		public function error()
		{
			include '../public/error.html';
		}

	}

