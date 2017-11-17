<?php 
	
	class evaluateModel
	{
		private $db;
		public function __construct()
		{
			$this->db =  new DB('`evaluate`');

		}

		public function count($where='')
		{
			$data = $this->db->field('count(id)
		 as sum')->where($where)->select();
			// 返回个数
		 return $data[0]['sum'];

		}

		public function index($limit,$where = '')
		{
			// 查询所有订单信息  order 表
			$data['single'] = $this->db->where($where)->limit($limit)->order('id desc')->select();
			$data['all'] = $this->db->select();

			//   无任何订单时  不可合并  页面跳转失败
			if(empty($data['all'])){
				notice('无评论','index.php?c=order');
			}

			//  无查询相关订单时 
			if(empty($data['single'])){
				notice('无相关评论','','1');
			}
			$data = $data['single'];
			return $data ;
		}

		public function evaluate_info($id)
		{
			// 订单详情
			 //   订单号	order orderNum
			 //   收件人    order receiver
			 //   地址     order  adress 
			 //   电话    order  phone
			 //   
			  //    点单时间 order time
			  //    单价 	ordergoods price
			  //    数量   ordergoods count 
			  //    总价	order amount
			  //    商品图片  goodsimg icon
			  //     商品名  goods name
		   
			// $order = $this->db->where('id = '.$id)->find();
		   
		 //   $info = $this->db
		 //   			->table('`order` o,ordergoods og,goods g,goodsimg gi')
		 //   			->field(' og.price,og.count ,o.amount ,g.name, gi.icon')
		 //   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and o.id ='.$id)
		 //   			->select();
		 //   			// var_dump($order);
		 //   			// echo $this->db->sql;
		 //   			// var_dump($info);
		 //   		$data['order'] =$order;
		 //   		$data['info'] = $info;

		 //   		return $data;




		   		// $data= $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi ,evaluate ev ,user u')
		   		// 	->field(' o.orderNum ,g.id,g.name, gi.icon,ev.gid,ev.state,ev.info,u.nickname')
		   		// 	->order('time desc')
		   		// 	->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and o.status=3 and  ev.gid=og.gid and ev.gid=gi.gid and ev.odNum=o.orderNum and u.id = uid and ev.id ='.$id)
		   		// 	->select();
		   		// 	
		   		
		   		$data= $this->db->table('`order` o,ordergoods og,goods g,goodsimg gi ,evaluate ev ')
		   			->field(' ev.id ,o.orderNum ,o.uid,g.name, gi.icon,ev.gid,ev.state,ev.info')
		   			->order('time desc')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and isPay=1 and o.status=3 and  ev.gid=og.gid and ev.gid=gi.gid and ev.odNum=o.orderNum and ev.id ='.$id)
		   			->select();

		   			return $data;

		}



	}