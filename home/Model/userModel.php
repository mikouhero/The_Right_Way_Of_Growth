<?php 
	
	class userModel
	{
		private $db;

		public function __construct()
		{
			$this->db = new DB('user');
		}

		// 加载所有用户 
		public function index($limit,$where = '')
		{
	
			$data = $this->db->where($where)->limit($limit)->order('id desc')->select();
			// 防止查询报错
			if(empty($data)){
				notice('查无此人');
			}

			return $data;

		}

		// 新增用户
		
		public function doAdd()
		{

				$_POST['nickname'] = htmlentities($_POST['nickname']);
				$_POST['address'] = htmlentities($_POST['address']);
				// var_dump($_POST);die;
				// 1. 判断数据
				// 1.1 验证电话	
					$preg = '/^1[34578]\d{9}$/';
					if(!preg_match($preg,$_POST['tel'])){
							notice('手机格式不正确');
						}


				//1.2 判断密码是否为空
					if(empty($_POST['pwd'])){
						notice('密码不能为空');
					}

				//1.3  判断两次密码是否一致
					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}else{
						unset($_POST['repwd']);
						$_POST['pwd'] = md5($_POST['pwd']);
					}


				// 1.4  上传头像
				// var_dump($_FILES);die;
				$up = new Uploads;
				$file = $up->singleUp();
				if(is_string($file)){
					notice($file);
				}
				// var_dump($_POST);
				// var_dump($_FILES);die;
				// 2  完善数据  
			
				//  注册时间
					$_POST['regtime'] = time();

				//  头像名  
					$_POST['icon'] = $file[0];
						
					// 执行insert  返回新增的ID
				$data = $this->db->insert();
						// var_dump($data);die;
						return $data;
		}


		// 执行删除
		
		public  function doDel($id)
		{
			$data = $this->db->where('id ='.$id)->delete();
			// var_dump($data);die;
			return $data;
		}

		public function find($id)
		{
			$data= $this->db->where('id = '.$id)->find();
			// var_dump($data);

			return $data;
		}

		// 执行编辑
		
		public function doEdit($id)
		{			
			$_POST['nickname'] = htmlentities($_POST['nickname']);
			$_POST['address'] = htmlentities($_POST['address']);

				// 1.1 验证电话	
					$preg = '/^1[34578]\d{9}$/';
					if(!preg_match($preg,$_POST['tel'])){
							notice('手机格式不正确');
						}

				//1.2 判断密码是否为空
					if(empty($_POST['pwd'])){

						unset($_POST['pwd']);
						unset($_POST['repwd']);

					}

				//1.3  判断两次密码是否一致
					if($_POST['pwd'] != $_POST['repwd']){
						notice('两次密码不一致');
					}else{
						unset($_POST['repwd']);
						$_POST['pwd'] = md5($_POST['pwd']);
					}


					// 1.4 头像
					
						$up = new Uploads;
						$isUp = $up->is_up();

						// 编辑状态:  如果上传了文件, 则调用singleUp
						// 			  如果没有上传, 则直接跳过
						if(!$isUp){
							$file = $up->singleUp();

							if( is_string($file)){
								notice($file);
							}
							$_POST['icon'] = $file[0];
						}

				// 执行update 
				$data = $this->db->where('id = '.$id)->update();
					// var_dump($data);die;
				return $data;

		}

		// 执行状态修改 
		
		public function doStatus($id,$status)
		{
			$arr['status'] = $status;

			$data = $this->db->where(' id = '.$id)->update($arr);
			
			// var_dump($data);die;
		}

		public function count($where='')
		{
			$data = $this->db->field('count(id)
		 as sum')->where($where)->select();
			// 返回个数
		 return $data[0]['sum'];

		}
		
	}