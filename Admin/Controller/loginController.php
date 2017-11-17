<?php 

	class loginController
	{
		private $login;
		public function __construct()
		{
			$this->login = new loginModel;
		}

		public function index()
		{
			include 'View/login/index.html';
		}

		public function doLogin()
		{
			 $this->login->doLogin();
			
			notice('登录成功..','index.php');
			

		}

		public function doCookie()
		{
			$this->login->doCookie();

			header('location:index.php');
		}
	}