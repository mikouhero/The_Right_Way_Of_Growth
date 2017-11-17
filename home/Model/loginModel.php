<?php 
	
	class loginModel
	{
		private $db;
		public function __construct()
		{
			$this->db = new DB('user');
		}	
		public function doLogin()
		{


			//   验证码  
			if(strcasecmp($_POST['code'],$_SESSION['code'])){
				notice('验证码错误','index.php?c=login','0.5');
			}
			//  删除验证码
			unset($_POST['code']);
			unset($_SESSION['code']);

			//  数据库查询
			$data = $this->db->where('tel = "'.$_POST['tel'].'" and pwd = "'.md5($_POST['pwd']).'"')->find();
			
			//  判断
			if(empty($data) ){
				notice('您的账号或者密码有误');
			}
			//  判断禁用情况
			$data =  $this->db->where('tel = "'.$_POST['tel'].'" and pwd = "'.md5($_POST['pwd']).'" and status = 1')->find();

			if(empty($data)){
				notice('您的账号被禁用，请联系客服');
			}
			// 存储session
			
			$_SESSION['user'] = $data;
			unset($data);

		}

		
	}