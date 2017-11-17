<?php
	class orderController extends controller
	{	
		private $order;
		public function __construct()
		{
			parent::__construct();
			$this->order = new orderModel;
		}

		

		// 加载全部订单表
		public function index()
		{	
			if(empty($_GET['search'])  ){
            	  $where = '';
	          }else{
	              $where = 'orderNum like "%'.$_GET['search'].'%"';
	          }

            // 加载page
            $page = new page;

            // 求总个数
            $count = $this->order->count($where);

            // 分页
            $limit = $page ->getLimit($count,AP);

			$data = $this->order->index($limit,$where);

			include 'view/order/index.html';
		}

		// 加载订单详情
		
		public function order_info()
		{
			$id = $_GET['id'];

			$data = $this->order->order_info($id);

			// var_dump($data);die;
			include 'view/order/order_info.html';

		}

		//   更改发货状态
	
		public  function  doStatus()
		{
			$id = $_GET['id'];
			$ispay = $_GET['isPay'];
			$cancel = $_GET['cancel'];
			//  已经取消了
			if($cancel ==1)
			{
				notice('订单已取消');
			}
			//  未付款
			if($ispay==2)
			{
				notice('买家还未支付哦');
			}
          $status = $_GET['status']==1? 2:$_GET['status'];

			$this->order->doStatus($id,$status);

			notice('等待买家收货中','','1');
          	header('location:index.php?c=order');die;

		}

		// 修改订单状态
		
		public function cancel()
		{
			//   已发货状态下不能取消  status = 1 状态下可以取消
			$id = $_GET['id'];
			$status = $_GET['status'];
			$cancel = $_GET['cancel'];
			if($status != 1){
				notice('现在不能取消订单！！！');
			}
			//  将正常状态2  ->  取消状态 1
			 $cancel = 1;
			$data = $this->order->cancel($id,$cancel);
			
			if(empty($data)){
				notice('取消失败');
			}
			notice('订单已取消');
		}  
		
		//  修改订单相关信息
		
		public function edit()
		{
			notice('请先联系会员');
		}

	
	}