<?php 
	
	class orderModel
	{
		private $db;
		public function __construct()
		{
			$this->db =  new DB('`order`');

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
				notice('无订单','index.php?c=goods');
			}

			//  无查询相关订单时 
			if(empty($data['single'])){
				notice('无相关订单','','1');
			}
			$data = $data['single'];
			return $data ;
		}

		public function order_info($id)
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
		   
			$order = $this->db->where('id = '.$id)->find();
		   
		   $info = $this->db
		   			->table('`order` o,ordergoods og,goods g,goodsimg gi')
		   			->field(' og.price,og.count ,o.amount ,g.name, gi.icon')
		   			->where('o.id =oid and g.id =og.gid and g.id=gi.gid and face = 1  and o.id ='.$id)
		   			->select();
		   			// var_dump($order);
		   			// echo $this->db->sql;
		   			// var_dump($info);
		   		$data['order'] =$order;
		   		$data['info'] = $info;

		   		return $data;
		}

		public function doStatus($id,$status)
		{
			//   发货信息  order
			$arr['status'] = $status;
			$data = $this->db->where(' id = '.$id)->update($arr);

		}

		public function cancel($id,$cancel)
		{
			$arr['cancel'] = $cancel;
			$data = $this->db->table('`order`')->where('id ='.$id)->update($arr);
			return $data;
		}

	



	}