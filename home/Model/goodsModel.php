<?php 
	
	class goodsModel
	{
		private $db;

		public function __construct()
		{
			$this->db = new DB('goods');
		}


	
		//   加载商品列表
		public function goodslist($id)
		{
			// 根据 分类的id  查询子分类的id  
				// select  id 
				// from  category 
				// where path like "%,1,%"
				// 分类表中的id  与goods 表中的id 相对应
			$cid = $this->db->table('category')->field('id')->where('path like "%,'.$id.',%"')->select();
			// 将cid  数组 变成 cid 字符串
			// var_Dump($cid);
			$cidlist = '';

			foreach($cid as $k=>$v){
				$cidlist .= $v['id'].',';
			}

			$cidlist .= $id;
			// var_dump($cidlist);die;
			// 多表联查
			// 
			// goods表中的id 与goodsimg中的gid 相对应
			$data = $this->db
					->table('goods g, goodsimg i')
				
					->field('g.`id` ,g.`name`, g.`price`,g.`desc`,i.`icon`   ')
					->where('cid in ('.$cidlist.') and g.id = i.gid and face = 1 and up = 1')
					->select();
			return $data ;
		}

		// 加载商品详情
	
		public  function datail($id)
		{
			//  商品 信息
			
			// select  name desc price sold stock 
			// from  goods
			// where id =$id;
			// 

			$goods = $this->db->field('`name`,`desc`,`price`,`sold`,`stock`,`id`')->table('goods')->where('id = '.$id)->find();
		


			// 加载商品图片
			
				// select  `icon`
				// from goodsimg
				// where gid = 1;
				// 
				$img = $this->db->field('`icon`')->table('goodsimg')->where('gid = '.$id)->order('face')->select();


				// var_dump($goods);
				// var_dump($img);

				$data[] = $goods;
				$data[] = $img;

				return  $data;
		}	


		//   根据商品的id  加载所需要的信息
		
		public function shopCar($id)
		{
			// select name price  icon stock 
			// from goods g ,goodsimg i;
			// where g.id = i.gid and g.id = $id and face = 1 and up= 1
			

			$goods = $this->db->field('`name`,`price`,`icon`,`stock`')
				->table('goods g, goodsimg i')
				->where('g.id = i.gid and face = 1 and up = 1 and g.id ='.$id)
				->find();

			$_SESSION['shop'][$id] = $goods;
			if( empty($_SESSION['shop'][$id]['count'])  ){
				$_SESSION['shop'][$id]['count'] = 1;
			}

			return $goods;
		}
		

	}