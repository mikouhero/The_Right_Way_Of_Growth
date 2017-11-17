<?php 
	class regModel{
		private $db;
		public function __construct()
		{
			$this->db = new DB('`user`');
		}

		public function getReg()
		{
			

				$_POST['pwd'] = htmlentities($_POST['pwd']);
				$_POST['repwd'] = htmlentities($_POST['repwd']);
				
				// 1.1 验证电话	
					$preg = '/^1[34578]\d{9}$/';
					if(!preg_match($preg,$_POST['tel'])){
							notice('手机格式不正确');
						}

				// 1.2   验证码不区分大小写  strcasecmp  如果两者相等，返回 0。
						if(strcasecmp($_POST['code'],$_SESSION['code'])){
							notice('验证码错误');
						}
						unset($_POST['code']);
						unset($_SESSION['code']);

				//1.3 判断密码是否为空
					if(empty($_POST['pwd'])){
						notice('密码不能为空');
					}

				//1.4 判断两次密码是否一致
					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}else{
						unset($_POST['repwd']);
						$_POST['pwd'] = md5($_POST['pwd']);
					}
			
				//  注册时间
					$_POST['regtime'] = time();

				// 执行insert  返回新增的ID
				$data = $this->db->insert();
				return $data;
		}
	}