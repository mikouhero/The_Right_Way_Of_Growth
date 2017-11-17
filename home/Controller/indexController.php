<?php 
	class indexController  extends controller
	{
		public function __construct(){
			
			$this->index = new indexModel;
		}

		public function index()
		{
		
			$data = $this->index->index();

			include 'View/index/index.html';
		}

	}