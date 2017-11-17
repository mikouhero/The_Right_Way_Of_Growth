<?php 


	class indexModel{

		private $db;

		public function __construct()
		{
			$this->db = new DB('category');
		}

		public  function index()
		{
			//   热销手机
			$data['phone'] = $this->db
								->table('goods g, goodsimg i,category c')
							
								->field('g.`id` ,g.`name`, g.`price`,g.`desc`,i.`icon`   ')
								->where(' c.id =g.cid  and g.id = i.gid and face = 1 and up = 1 and hot=1 and path like "%,1,%"')
								->order('id asc')
								->select();
			// 10件随便的 
				$data['all'] =  $this->db
									->table('goods g, goodsimg i,category c')
								
									->field('g.`id` ,g.`name`, g.`price`,g.`desc`,i.`icon`   ')
									->where(' c.id =g.cid  and g.id = i.gid and face = 1 and up = 1 and hot=1 ')
									->order('id desc')
									->select();
				return $data;

		}
		public  function getCate()
		{
			$data =$this->db->table('category')->order ('id desc')->field('id,name')->where('pid = 0 and display =1')->select();
			return $data;
		}
	}