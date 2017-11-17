<?php 
	
	class categoryModel
	{
		private $db;

		public function __construct()
		{
			$this->db = new DB('category');
		}

		// 加载所有分类主页 
		public function index($pid=0)
		{
	
			$data = $this->db->order('id desc')->where('pid = '.$pid )->select();
			return $data;

		}

		public function getCate()
		{
			// select  concat(path,id,',') as px,name,id
			// from category
			// order by px;
			
			return $this->db->order('px')->field('concat(path,id,",") as px ,name, id')->select();
		}
		// 添加分类
		public function doAdd()
		{
				// 执行insert  返回新增的ID
				$data = $this->db->insert();

				return $data;
		}

		// 查询单条数据
		public function find($id)
		{
			$data= $this->db->where('id = '.$id)->find();
			// var_dump($data);

			return $data;
		}

		// 执行编辑
		public function doEdit($id)
		{			

				// var_dump($_POST);die;
				// 执行update 
				$data = $this->db->where('id = '.$id)->update();
				// echo $this->db->sql;die;
					// var_dump($data);die;
				return $data;

		}

		// 状态修改
		public function doStatus($id,$display)
		{
			$arr['display'] = $display;
			
			$data = $this->db->where(' id = '.$id)->update($arr);

		}

		//  执行 删除分类
		
		public function  doDel($id)
		{
			// 先根据id  查询是否有子分类
			
			$data =$this->db->where('pid = '.$id)->find();
			if(!$data){
				$data = $this->db->where('id = '.$id)->delete();
			}else{
				notice('请先删除子类');
			}

		}

		public function getId()
		{
			return $this->db->field('id,name')->select();
		}

		

	
	}