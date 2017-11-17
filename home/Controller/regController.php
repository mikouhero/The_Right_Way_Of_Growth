<?php 
	
	class regController
	{
		private $v;
		private $reg;
		public function __construct()
		{
			$this->reg = new regModel();
			$this->v = new Validate;

		}
		// 加载注册页面 
		public function index()
		{
			include 'view/reg/reg.html';
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

		//  接收注册信息
		
		public function  getReg()
		{
			$data = $this->reg->getReg();
			if(empty($data) ){
				notice('账号已注册');
			}
			notice('注册成功！！！','index.php?c=login');
		}
	}