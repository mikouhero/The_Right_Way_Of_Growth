<?php 

	class orderModel
	{
		private $db;
		 public function __construct()
		 {

		 	//   注意  所有的表名都要加反引号
		 	//    order  是关键字 
		 	$this->db = new DB('`order`');
		 }

		 	//  将订单信息导入数据库
		 public function submitOrder()
		 {
		 		//  $_SESSION['order'] 为空时  调到购物车 
		 		 if(empty($_SESSION['order'])){
				 	header("location:index.php?c=personal&m=allOrder");die;
				 }

			 	//   判断电话   收货人  地址
				 		if(empty($_POST['phone']) )
				 		{
				 			notice('请填写手机号码');
				 		}
				 		if(empty($_POST['receiver']) )
				 		{
				 			notice('请填写收件人');
				 		}
				 		if(empty($_POST['address']) )
				 		{
				 			notice('请填写手机号码');
				 		}

				 		$_POST['receiver'] = htmlentities($_POST['receiver']);
				 		$_POST['phone'] = htmlentities($_POST['phone']);
						$_POST['address'] = htmlentities($_POST['address']);


				 		//  电话号码格式
				 	
						$preg = '/^1[34578]\d{9}$/';
						if(!preg_match($preg,$_POST['phone'])){
								notice('手机格式不正确','','0.5');
						}

						//  收件人姓名格式 

						//   收货地址  含3个中文  /.*^[\u4E00-\u9FA5][\u4E00-\u9FA5]{2,}/
						 $preg = '/.*^[\x{4e00}-\x{9fa5}]/u';
						 if(!preg_match($preg,$_POST['address'])){
						 		notice('地址格式错误','','1');
						 }

			 	// 接收数据  传入数据库
			 	
			 

				 	$arr['orderNum'] = $_POST['orderNum'];
				 	$arr['uid'] =  $_SESSION['user']['id'];   
				 	$arr['receiver'] = $_POST['receiver'];
				 	$arr['phone'] = $_POST['phone'];
				 	$arr['address'] = $_POST['address'];
				 	
				 	// 总价
				 	$arr['amount'] = $_POST['lastTotal'];

				 	//  下单时间 
				 	$arr['time'] = time();

				 	$arr['orderWay']= 1;
				 	$arr['status']= 1;
				 	$arr['isPay']= 2;
				 	$arr['cancel']= 2;

				 	// var_dump($arr);
				 	//   将数据传入数据库 order 中  返回影响的id 
				 	$data =  $this->db->insert($arr);

			 	// 删除购物车内的购物信息
			    unset($_SESSION['shop']);

			 	// 拿出数据 
			 	 	$data = $this->db->where('id = '.$data)->find();
			 		// var_dump($_SESSION['order']);
			 		// var_dump($data);
			 		// oid   订单id   $data['id']
				 $brr = $_SESSION['order'];

			 	 //  将数据导入 ordergoods 
			 		 $oid = $data['id'];   //   oid
					 foreach($brr as $k =>$v){
					 		
					 		$gid = $k;  					// gid
					 		$price = $v['price']; 
					 		$count = $v['count'];

					 		//将以上数据 组成数组  插入数据库 ordergoods
					 		
					 		$crr['oid'] = $oid;
					 		$crr['gid'] = $gid;
					 		$crr['price'] = $price;
					 		$crr['count'] = $count;
					 		// var_Dump($crr);
					  		$this->db->table('ordergoods')->insert($crr);
					 }
					 
				//  成功提交订单之后的相关信息  order 表中的数据
					$_SESSION['subOrder'] =$data;
					return $data;
		 }

		 //  更改数据库的支付信息
		 public function successPay()
		 {		
		 		$arr['isPay'] =1;
		 		// var_dump($arr);
		 		$data = $this->db->where('id = '.$_SESSION['subOrder']['id'])->update($arr);
		 		// var_dump($_SESSION['order']);

		 		
			 	//  // oid   order 表中的id     $_SESSION['subOrder']['id']
				 // // gid   goods 表中的id  $_SESSION['order']  键
				 // // count  买的数量     $_SESSION[id][count]
				 // // price  买时的价格   $_SESSION[id] [price]
				 
				 // $brr = $_SESSION['order'];

		 		// // var_dump($_SESSION['subOrder']['id']);die;
				 // // var_dump($brr);
				 // foreach($brr as $k =>$v){
				 // 		$oid = $_SESSION['subOrder']['id'];   //   oid
				 // 		$gid = $k;  					// gid
				 // 		$price = $v['price']; 
				 // 		$count = $v['count'];

				 // 		//将以上数据 组成数组  插入数据库 ordergoods
				 		
				 // 		$crr['oid'] = $oid;
				 // 		$crr['gid'] = $gid;
				 // 		$crr['price'] = $price;
				 // 		$crr['count'] = $count;
				 // 		// var_Dump($crr);
				 // 	$data = $this->db->table('ordergoods')->insert($crr);
				 // }

				 // unset($_SESSION['order']);
				 // unset($_SESSION['subOrder']);
				 // var_dump($_SESSION);die;
				 
				 	//   有待优化
				 if(empty($_SESSION['subOrder'])){
				 	header("location:index.php?c=personal&m=allOrder");die;
				 }
				   return  $data ;
		 		
		 		// echo $this->db->sql;
		 		// var_dump($data);die;
		 		// $this->db->update();
		 }
	}
	