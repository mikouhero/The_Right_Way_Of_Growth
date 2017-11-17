<?php 

	
	class personalModel
	{
		private $db;
		public function  __construct()
		{
			$this->db = new DB('`order`');
		}

		public function index()
		{
			$data= $this->db
						->table('user')
						->field('icon ,nickname,tel')
						->where('id = '.$_SESSION['user']['id'])
						->find();
			return $data;
		}

		public function count($where='')
		{
			$data = $this->db->field('count(id)
		 as sum')->where($where)->select();
			// 返回个数
		 return $data[0]['sum'];
		}
		
		public function allOrder($limit,$where)
		{

		   //  uid  通过session 获取  已知条件 
		   $uid = $_SESSION['user']['id'];

		  //   订单号	order orderNum
		  //    点单时间 order time
		  //    单价 	ordergoods price
		  //    数量   ordergoods count 
		  //    总价	order amount
		  //    商品图片  goodsimg icon
		  //     商品名  goods name  全部
		  
		   // select  o.orderNum, o.time ,og.price,og.count ,o.amount, gi.icon ,g.name 
		   // from  `order` o,ordergoods og ,goods g,  goodsimg gi
		   // where  (o.id =oid and g.id =og.gid and face = 1) and (o.uid =11) ;

			// select  o.orderNum, o.time ,og.price,og.count ,o.amount ,g.name, gi.icon
		 //   from  `order` o,ordergoods og,goods g,goodsimg gi
		 //   where  o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and o.uid =11;


		   $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field('o.*, og.price,og.count ,g.name, gi.icon')
		   			->limit($limit)
		   			->order('time desc')

		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and o.uid ='.$uid)
		   			->select();
		   	// var_dump($data);die;
		   	return $data ;
		}

		public function waitPay()
		{
		    $uid = $_SESSION['user']['id'];
			//   未支付 order isPay= 2
			 $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field(' o.orderNum, o.time ,og.price,og.count ,o.amount ,g.name, gi.icon')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=2 and o.uid ='.$uid)
		   			->select();
		   	return $data ;
		}

		public function waitSend()
		{
		    $uid = $_SESSION['user']['id'];

			//   支付 order isPay= 1  order  status = 1
			 $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field(' o.orderNum, o.time ,og.price,og.count ,o.amount ,g.name, gi.icon')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and status=1 and o.uid ='.$uid)
		   			->select();
		   	return $data ;
		}

		public function waitRec()
		{
		    $uid = $_SESSION['user']['id']; 
			//   支付 order isPay= 1  order  status = 2  
			 $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field(' o.orderNum, o.time ,og.price,og.count ,o.amount ,g.name, gi.icon')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and status=2 and o.uid = '.$uid)
		   			->select();
		   	return $data ;
		}

		public function haveDone()
		{
		    $uid = $_SESSION['user']['id'];
			//   支付 order isPay= 1  order  status = 3  
			 $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field(' o.orderNum, o.time ,og.price,og.count ,o.amount ,g.name, gi.icon')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and status=3 and o.uid ='.$uid)
		   			->select();
		   	return $data ;
		}





		public function personalData()
		{
			$data= $this->db
						->table('user')
						->field('icon,nickname,tel,sex,birthday,address,regtime')
						->where('id = '.$_SESSION['user']['id'])
						->find();
			return $data;
		}	
		
		public function doEdit()
		{	

			$_POST['nickname'] = htmlentities($_POST['nickname']);
			$_POST['address'] = htmlentities($_POST['address']);


			if(empty($_POST['tel'])){
					notice('电话号码不能为空','','1');
			}
			if(empty($_POST['address'])){
				notice('地址不能为空','','1');
			}
			if(empty($_POST['nickname'])){
				notice('昵称不能为空','','1');
			}
			// 1.1 验证电话	
				$preg = '/^1[34578]\d{9}$/';
				if(!preg_match($preg,$_POST['tel'])){
						notice('手机格式不正确');
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
			$data = $this->db->table('user')->where('id = '.$_SESSION['user']['id'])->update();


			// $data1 = $this->db->table('user')->where('id= '.$_SESSION['user']['id'] and  $data['tel'].' = '.$_SESSION['tel'])->find();
			// echo $this->db->sql;
			if(empty($data)){
				notice('修改失败');
			}

			//   修改手机号 需要重新登录
			$data1 = $this->db->table('user')->where('id = '.$_SESSION['user']['id'])->find();


			if(  $data1['tel'] != ($_SESSION['user']['tel']) ){

				unset($_SESSION['user']);
				notice('你已经修改了手机号,请重新登录','index.php?c=login');
			}

			  
			return $data;
		}
		public function doChangePwd()
		{

			$data = $this->db
					->table('user')
					->field('pwd')
					->where('id = '.$_SESSION['user']['id'])
					->find();

			//   判断原密码是否正确
			if(  md5($_POST['oldpwd'])  !=  $data['pwd']){
				notice('原密码不正确');die;
			}
				unset($_POST['oldpwd']);
			// 密码不能为空
			if(empty($_POST['pwd'])){
				notice('密码不能为空');
			}

			// 两次密码是否相同
			if($_POST['pwd'] != $_POST['repwd']){
				notice('两次密码不一致');
			}else{
				unset($_POST['repwd']);
				$_POST['pwd'] = md5($_POST['pwd']);
			}

			// 更新数据库
			$data1 = $this->db->table('user')->where('id ='.$_SESSION['user']['id'])->update();

			if(empty($data1)){
				notice('新旧密码相同哟!!!');
			}

			//  修改密码需要重新登录
				if($data){
					unset($_SESSION['user']);
					notice('修改密码成功,请重新登录','index.php?c=login','1');
				}

		}

		public function goPay($orderNum)
		{
			//  数据库查询 
			
			$data = $this->db->where('orderNum = "'.$orderNum.'"')->find();
			return $data;
		}

		public  function doGoPay($orderNum)
		{
			$arr['isPay'] = 1;
			$data = $this->db->where('orderNum = "'.$orderNum.'"')->update($arr);
			return $data;
				
		}
		public  function confirm($orderNum)
		{
			$arr['status'] = 3;
			$data = $this->db->where('orderNum = "'.$orderNum.'"')->update($arr);
			return $data;
		}


		//待评价
		public function wait($orderNum)
		{ 

			// 订单完成后 强行添加数据到 evalutae  
		   $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field('o.orderNum,g.id')
		   			->limit($limit)
		   			->order('time desc')

		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1 and isPay=1 and status=3  and o.orderNum ="'.$orderNum.'"')
		   			->select();
		   			
		   		foreach($data as $k=>$v){
		   			$brr['odNum'] =$v['orderNum'];
		   			$brr['gid'] = $v['id'];
		   			$brr['state'] = 1;
		   			$bata[] = $this->db->table('evaluate')->insert($brr);
		   		}
		   		return $bata;
		  
		}

		public  function cancel($orderNum)
		{
			$arr['cancel'] = 1;
			$data = $this->db->where('orderNum = "'.$orderNum.'"')->update($arr);
			// echo $this->db->sql;die;
			return $data;
		}

		public function orderInfo($orderNum)
		{

			 $data = $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field('o.*, og.price,og.count ,g.name, gi.icon')
		   			->limit($limit)
		   			->order('time desc')

		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and o.orderNum ="'.$orderNum.'"')
		   			->select();

			return $data;

		}


//   评价   
		public  function evaluate()
		{
			 $uid = $_SESSION['user']['id'];
			//   支付 order isPay= 1  order  status = 3  
			//   未评价 evaluate  state = 1
			 $data= $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi ,evaluate ev')
		   			->field(' o.orderNum, o.time ,g.id,g.name, gi.icon,ev.gid,ev.state,ev.info')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and status=3 and  ev.gid=og.gid and ev.gid=gi.gid and ev.odNum=o.orderNum and o.uid ='.$uid)
		   			->select();
		   	//  查询 evaluate  内的内容
		   	


		   	return $data ;	
		}



		public function doEvaluate()
		{
			
			$_POST['info'] = htmlentities($_POST['info']);
			$_POST['state'] = 2;
			$data = $this->db->table('`evaluate`')
							 ->where(('odNum = "'.$_POST['odNum']) .'" and '. (' gid = '.$_POST['gid']))
							 ->update($_POST);
			return $data;
		}

	}