<?php 
	
	class orderController extends Controller
	{
		private $order;
		public function __construct()
		{
			parent::__construct();
			$this->order = new orderModel;
		}

		
		//  加载订单页面
		public function order()
		{
			

			// var_dump($_SESSION);
			$_SESSION['order'] = $_SESSION['shop'];

			if(empty($_SESSION['order']) ){
				$this->error();die;
			}
			include 'View/order/order.html';
		}

		// 确认提交订单 
		public function submitOrder()
		{
			// 订单编号
			$_POST['orderNum'] ='C'.date('YmdHis',time() );

			
			// model 内判断手机 地址等
			
			// 将下单的相关信息传入数据库 
			 $data = $this->order->submitOrder();
			include 'view/order/payment.html';
			//   删除SESSION中的order数据  防止刷新生成多个订单
				 unset($_SESSION['order']);
		}


		// 支付成功
		public function successPay()
		{

			$this->order->successPay();

			include 'view/order/successPay.html';
			
			unset($_SESSION['subOrder']);
		}
		
	}