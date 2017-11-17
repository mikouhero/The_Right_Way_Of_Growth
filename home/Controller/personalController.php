<?php 
	
	class personalController  extends Controller
	{

		private $personal;
		
		public function __construct()
		{
			parent::__construct();
			$this->personal = new personalModel;
		}
		//   个人中心界面
		public  function index()
		{	

			include 'view/personal/index.html';

		}

		//  加载左边公共区域  作为公共方法
	
		public function comment()
		{
			$data = $this->personal->index();
			include 'view/personal/comment.html';
		}


		//  加载无相关订单的页面

		public function noOrder()
		{
			include 'view/personal/noOrder.html';
		}

		//  加载全部订单页面
		public function allOrder()
		{	
			  // 搜索条件

		    //      if(empty($_GET['search'])  ){
		    //          $where = '';
		    //      }else{
		    //          $where = 'tel like "%'.$_GET['search'].'%"';
		    //      }
					 // // 加载page
	    	 //       	 $page = new page;
	     	//        // 求总个数
	    	 //        $count = $this->personal->count($where);

	    	 //        // 分页
	    	 //        $limit = $page ->getLimit($count,AP);


			$data = $this->personal->allOrder($limit,$where);
			if(empty($data)){
				$this->noOrder();
			}
			
			include'view/personal/allOrder.html';
		}

		// 加载待付款页面
		public function waitPay()
		{
			$data = $this->personal->waitPay();
			if(empty($data)){
				$this->noOrder();
			}
			include 'view/personal/waitPay.html';
		}

		// 加载待发货页面
		public function waitSend()
		{

			$data = $this->personal->waitSend();
			if(empty($data)){
				$this->noOrder();
			}
			include 'view/personal/waitSend.html';
		}

		// 加载待收货页面
		public function waitRec()
		{
			$data = $this->personal->waitRec();
			if(empty($data)){
				$this->noOrder();
			}
			include 'view/personal/waitRec.html';
		}

		//  加载已完成页面
		
		public function haveDone()
		{
			$data = $this->personal->haveDone();
			if(empty($data)){
				$this->noOrder();
			}
			include 'view/personal/haveDone.html';
		}

	

		//  加载个人资料页面
		
		public function personalData()
		{
			$data = $this->personal->personalData();
			include 'view/personal/personalData.html';
		}

		//  加载修改个人资料页面
		public function edit()
		{
			$data = $this->personal->personalData();
			include 'view/personal/edit.html';
		}

		//  执行修改
		
		public function doEdit()
		{
			$data = $this->personal->doEdit();
			if(empty($data)){
				notice('编辑失败');
			}
			notice('编辑成功','index.php?c=personal&m=personalData');
		}

		// 加载修改密码 页面
		
		public function changePwd()
		{
			include 'view/personal/changePwd.html';

		}

		//   执行 修改密码
	   
		public function doChangePwd()
		{

			 $this->personal->doChangePwd();


		}

		//  加载未支付的支付订单

		public function goPay()
		{
			//   传入 代付款的订单号
			$orderNum = $_GET['orderNum'];
			$data = $this->personal->goPay($orderNum);
			if(empty($data)){
				$this->error();
			}
			include 'view/personal/payment.html';
		}

		// 加载成功支付后的
		public function doGoPay()
		{
			$orderNum = $_GET['orderNum'];
			$data = $this->personal->doGoPay($orderNum);
			if(empty($data)){
				$this->error();
			}
			include 'view/personal/successPay.html';
		}

		// 确认收货 
		public function confirm()
		{
			$orderNum = $_GET['orderNum'];


			$data = $this->personal->confirm($orderNum);

			if(empty($data)){
				notice('确认失败');
			}
			
			$bata = $this->personal->wait($orderNum);

			if(empty($bata)){
				notice('确认失败');
			}
			notice('确认成功,前往评价','index.php?c=personal&m=evaluate');
		}	

		 	//   用户取消   待支付 和 待发货
		 
			public function cancel()
			{
				$orderNum = $_GET['orderNum'];
				$data = $this->personal->cancel($orderNum);
				if(empty($data)){
					notice('取消失败');
				}
				notice('已成功取消');

			}

		//   加载订单详情
		
		public  function orderInfo()
		{
			$orderNum = $_GET['orderNum'];
			$data = $this->personal->orderInfo($orderNum);

			if(empty($data)){
				$this->noOrder();
			}
			include 'view/personal/orderInfo.html';
		}
		

		//  加载评价页面
		public function evaluate()
		{
			$data = $this->personal->evaluate();
			if(empty($data)){
				$this->noOrder();
			}

			include 'view/personal/evaluate.html';
		}

		 //  完成订单之后才可以评论
		//  订单编号 商品名  评价内容
		public function doEvaluate()
		{
			// var_dump($_POST);die;
			$data = $this->personal->doEvaluate();
			if(empty($data)){
				notice('评价失败','index.php?c=personal');
			}
			notice('感谢您对我们的支持');
		}


}