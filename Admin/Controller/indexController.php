<?php 
	class indexController extends Controller
	{
		public function __construct()
		{	parent::__construct();
			$this->index = new indexModel;
		}

		public function index()
		{
			// echo '11';die;
			// 
			// 由于控制器要送到admit中央控制器 即admit目录下的index.php
			// 所以当前目录即为  project\Admit
			include 'View/index/index.html';
		}

		public function top()
		{
			include 'View/index/top.html';
		}
		public function botton()
		{
			include 'View/index/bottom.html';
		}
		public function left()
		{
			include 'View/index/left.html';
		}
		public function main()
		{
			include 'View/index/main.html';
		}
		public function swich()
		{
			include 'View/index/swich.html';
		}
	}