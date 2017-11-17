<?php
	class evaluateController extends controller
	{	
		private $evaluate;
		public function __construct()
		{
			parent::__construct();
			$this->evaluate = new evaluateModel;
		}

		

		// 加载全部评论表
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
            $count = $this->evaluate->count($where);

            // 分页
            $limit = $page ->getLimit($count,AP);

			$data = $this->evaluate->index($limit,$where);

			include 'view/evaluate/index.html';
		}

		// 加载评论详情
		
		public function evaluate_info()
		{
			$id = $_GET['id'];

			$data = $this->evaluate->evaluate_info($id);

			include 'view/evaluate/evaluate_info.html';

		}


	
	}