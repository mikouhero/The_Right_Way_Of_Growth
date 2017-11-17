<?php 
	
	class goodsModel
	{
		private $db;

		public function __construct()
		{
			$this->db = new DB('goods');
		}

		// 加载所有商品 
		public function index($limit,$where = '')
		{
	
			// 多表联查
			// goods的 id 与goodsimg gid相等
			$data = $this->db
			->field('g.`id`, g.`name`, g.`price`, g.`stock`, g.`up`, g.`hot`, g.`desc`, i.`icon`')
			->order('id desc')
			->table('goods g, goodsimg i')
			->limit($limit)
			->where(' g.id=i.gid and i.face=1 ')
			->select();

			//   查询时
			if(!empty($where)){
				$data = $this->db
			->field('g.`id`, g.`name`, g.`price`, g.`stock`, g.`up`, g.`hot`, g.`desc`, i.`icon`')
			->order('id desc')
			->table('goods g, goodsimg i')
			->limit($limit)
			->where(' g.id=i.gid and i.face=1 and '.$where)
			->select();

			}

			if(empty($data)){
				notice('无相关商品');
			}
			return $data;
		}

		// 新增商品
		public function doAdd()
		{

				// 1.  上传封面
				$up = new Uploads;
				$file = $up->singleUp();
				if(is_string($file)){
					notice($file);
				}
				
				// 2  完善数据  
			
				//  添加时间
					$_POST['addtime'] = time();
				// 默认更新时间
					$_POST['uptime'] = time();
						
					if($_POST['price']<0){
						notice('单价不能为负数');
					}
				// 执行insert  返回新增的ID  添加goods 表
				$data = $this->db->insert();
						
				// 如果成功添加了商品 再添加goodsing表
				
				if(empty($data)){
					notice('添加商品失败');
				}
				$arr['gid'] = $data;
				$arr['icon'] = $file[0];
				$arr['face'] =1;

				$data = $this->db->table('goodsimg')->insert($arr);
				// 返回结果
				return $data;
		}

		// 执行删除
		public  function doDel($id)
		{
			$data = $this->db->where('id ='.$id)->delete();
			// var_dump($data);die;
			return $data;
		}

		// 
		public function find($id)
		{
			$data= $this->db->where('id = '.$id)->find();

			// var_dump($data);

			$data = $this->db
			->field('g.`*`, i.`icon`')
			->table('goods g,goodsimg i')
			->limit($limit)
			->where('g.id=i.gid and i.face=1 and g.id='.$id)
			->select();
			$data =  $data[0];
			

			$cid = ($data['cid']);
         //   获取cid 对应的中文分类名
         

          $category = new categoryController;
          // 获取分类中的 id 与分类名
          $data1 = $category->getId();
          //  遍历数组
           foreach ($data1 as $k=>$v){
                $id = $v['id'];
                $name = $v['name'];
                $arr[$id] =$name;
            }
            //  判断cid  是否存在
            if(array_key_exists($cid, $arr) ){
                 // 
                  $data['cid'] =  $arr[$cid];
              }

			return $data;
		}

		// 执行编辑
		public function doEdit($id)
		{			
			
			// 1. 封面
					
			// 	$up = new Uploads;
			// 	$isUp = $up->is_up();

			// // 编辑状态:  如果上传了文件, 则调用singleUp
			// // 			  如果没有上传, 则直接跳过
			// 	if(!$isUp){
			// 		$file = $up->singleUp();

			// 		if( is_string($file)){
			// 			notice($file);
			// 		}

			// 		$_POST['icon'] = $file[0];
				// }

			// 更新时间
				$_POST['uptime'] = time();
				// var_dump($_POST);

			// 执行update 
				$data = $this->db->where('id = '.$id)->update();
					// echo $this->db->sql;die;
				
			// 如果成功编辑了商品 再添加goodsing表
				
				if(empty($data)){
					notice('添加商品失败');
				}

				$arr['gid'] = $id;
				$arr['icon'] = $file[0];

				$data = $this->db->table('goodsimg')->insert($arr);
			
			
				return $data;
		}

		// 执行上架 修改 
		public function doUp($id,$up)
		{
			$arr['up'] = $up;
			$data = $this->db->where(' id = '.$id)->update($arr);
		}

			// 执行热销修改 
		public function doHot($id,$hot)
		{
			$arr['hot'] = $hot;
			$data = $this->db->where(' id = '.$id)->update($arr);
		}

		public function count($where='')
		{
			$data = $this->db->field('count(id)
		 as sum')->where($where)->select();
			// 返回个数
		 return $data[0]['sum'];
		}

		// 执行增加图片
		 public  function  doAddImg($id)
	      {
	      		$up = new Uploads;
				$file = $up->singleUp();
				if(is_string($file)){
					notice($file);
				}

				// 更新时间
				$_POST['uptime'] = time();

				// 执行update 
				$data = $this->db->where('id = '.$id)->update();
				// echo $this->db->sql;die;
				// var_dump($data);die;
				if(empty($data)){
					notice('添加图片失败');
				}

				$arr['gid'] = $id;
				$arr['icon'] = $file[0];
				$arr['face'] =2;
				// var_dump($arr);die;
				$data = $this->db->table('goodsimg')->insert($arr);
		
				return $data;

	      }

	     //  图片数据
	     
	     public function editImg($id)
	     {

	     	$data= $this->db->where('id = '.$id)->find();

			// var_dump($data);

			$data = $this->db
			->field('g.`name`, i.`*`')
			->table('goods g,goodsimg i')
			->limit($limit)
			->where('g.id=i.gid  and g.id='.$id)
			->order('face asc')
			->select();

	     	return $data;
	     }

     	 public function doEditImg($imgInfo)
     	 {
     	 	// var_dump($imgInfo);

     	 	//  在goodsimg表中 通过gid将对应商品的 所有face变为2 
     	 	$gid = $_GET['gid'];
     	 	$arr['face'] = 2;
     	 	$dataall = $this->db->table('goodsimg')->where('gid = '.$gid)->update($arr);

     	 	//  id   face = 1
     		
     		$id = $_GET['id'];
     	   $brr['face'] = 1;
     	   $data = $this->db->table('`goodsimg`')->where('id = '.$id)->update($brr);
     	
     	   return $data ;

     	 }

     	 public  function delImg($id)
     	 {
     	 	$data = $this->db->table('goodsimg')->where('id = '.$id)->delete();
     	 	
     	 	return $data;
     	 }
			
		
	}