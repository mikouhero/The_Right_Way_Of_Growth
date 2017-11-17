<?php 
	
	class loginModel
	{
		private $db;
		public function __construct()
		{
			$this->db = new DB('admin');
		}	
		public function doLogin()
		{
			$data = $this->db->where('name = "'.$_POST['name'].'" and pwd = "'.md5($_POST['pwd']).'"')->find();

			//  判断
			if(empty($data) ){
				notice('您的账号或者密码有误');
			}

			// 判断是否记住密码
			if(!empty($_POST['status'])){
				setcookie('name',$data['name'],time()+7*24*3600);
				setcookie('pwd',$data['pwd'],time()+7*24*3600);

			}


			// 存储session
			
			$_SESSION['admin']['name'] =$data['name'];
			
		}

		public function doCookie()
		{
			// 判断数据是否正确
		
			$data = $this->db->where('name = "'.$_COOKIE['name'].'" and pwd = "'.$_COOKIE['pwd'].'"' )->find();
	
			// 判断用户是否存在

			if(empty($data)){

				setcookie('name',$_data['name'],time()-1);
				setcookie('pwd',$_data['pwd'],time()-1);
				
				header('location:index.php?c=login');die;
			}
		

			// 存储session
			
			$_SESSION['admin']['name'] =$data['name'];
			$_SESSION['admin']['link'] =1;
		}
	}