<?php 

	class loginController extends Controller
	{
		private $login;
		private $v;
		public function __construct()
		{
			$this->login = new loginModel;
			$this->v = new Validate;
		}

		// 加载登录界面
		public function index()
		{
			include 'View/login/index.html';
		}


		//  验证码的更换
		public function code()
		{
			$a = $this->v->doimg();

			// 获取系统生成的验证码
			$c = $v->code;
			// 将系统验证码 存入session, 以便登录时进行验证 
			// 记住: 系统验证码存在session中
			$_SESSION['code'] = $this->v->code;

		}

		// 执行登录
		public function doLogin()
		{
			 $this->login->doLogin();
			
			notice('登录成功...','index.php','1');

		}

		//  退出登录
		
		public function signOut()
		{
			unset($_SESSION['user']);
			unset($_SESSION['shop']);
			notice('退出成功','index.php');
		}

	
	}