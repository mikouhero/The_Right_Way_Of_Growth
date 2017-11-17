<?php 
    class goodsController extends Controller{
      		private $goods;

      		public function __construct()
      		{
      			$this->goods = new goodsModel;
      		}


          //   加载商品分类列表页
      
          public function allGoods()
          {
            // 接收分类的id 
            $id = $_GET['id'];

            $data= $this->goods->goodslist($id);
            // var_dump($data);
           
            if(empty($data)){
              $this->error();die;
            }
            include 'View/goods/allGoods.html';

          }

          // 加载商品详情
          public function detail()
          {
            $id =$_GET['id'];
           
           $data = $this->goods->datail($id);
            
            //  404
            if(empty($data[0])){
              $this->error();die;
            }

           $goods = $data[0];
           $img = $data[1];
           // var_dump($img);die;
          include'View/goods/goodsDetails.html';
          }


          // 加载购物车界面  
          
          public function showCar()
          {
            
            include 'View/goods/shopping.html';
          }

         // 加入一个商品到  购物车  
        
         public function  shopCar()
         {
            $id = $_GET['id'];
            if(empty($id)){
              $this->error();die;
            }

           $goods =  $this->goods->shopCar($id);
            //  输入不存在的id  直接删除
           if(empty($goods)){
            unset($_SESSION['shop'][$id]);
           }
            // var_dump($_SESSION['shop'][$id]);
            $this->showCar();

         }

         // 删除购物车 
         
         public function doDelShop()
         {
            // 接收id   
            
            $id = $_GET['id'];

            //  删除session 中shop  下的键  id 
             unset($_SESSION['shop'][$id]);

           // 返回购物界面
            // var_dump($_SESSION['shop'][$id]);die;
           
           header('location:index.php?c=goods&m=showCar');die;
         }

         //  获取商品id 对应的数量
         
         public function getCount($id)
         {
            return $_SESSION['shop'][$id]['count'];

         }

          //  获取商品id 对应的库存
         
         public function getStock($id)
         {
            return $_SESSION['shop'][$id]['stock'];


         }

         // 购物车添加数量
          public function add()
          {
            $id = $_GET['id'];

            $count = $this->getCount($id);
            $stock = $this->getStock($id);

            if($count >= $stock){
              $_SESSION['shop'][$id]['count'] = $count;
            }else{
              $_SESSION['shop'][$id]['count']++;

            }

       

            // var_dump($_SESSION['shop'][$id]['count']);die;
            header('location:index.php?c=goods&m=showCar');die;
          }

         // 购物车减少数量
          
          public function sub()
          {
            $id = $_GET['id'];

            $count = $this->getCount($id);


            if($count <= 1){
              $_SESSION['shop'][$id]['count'] = 1;
            }else{
              $_SESSION['shop'][$id]['count']--;

            }
            header('location:index.php?c=goods&m=showCar');die;
          }
    }   	
