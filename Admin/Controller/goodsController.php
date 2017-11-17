<?php 
    class goodsController extends Controller{
    		private $goods;

    		public function __construct()
    		{
          parent::__construct();
    			$this->goods = new goodsModel;
    		}

    		// 加载商品列表

    		public function index()
    		{
          // 搜索条件
          if(empty($_GET['search'])  ){
              $where = '';
          }else{
              $where = '`name` like "%'.$_GET['search'].'%"';   //  写死了
          }


            // 加载page
            $page = new page;
            // 求总个数
            $count = $this->goods->count($where);

            // 分页
            $limit = $page ->getLimit($count,AP);


    	     $data = $this->goods->index($limit,$where);

           // var_dump($data);die;
    			include 'View/goods/index.html';
    		}

    		// 加载新增商品页面
    		public  function add()
    		{

            // select concat(path,id,',') as px ,name,id
            // from  category
            // order by px

            $category = new categoryController;

            $data = $category->getCate();

            foreach ($data as $k=>$v){
              // 统计num 个逗号
              $num = substr_count($v['px'],',')-2;

              // 重复num 个空格
               $nbsp = str_repeat('&nbsp;',$num*7);
              // 将空格塞到data里
              $data[$k]['nbsp'] = $nbsp;
            }

      			include 'View/goods/add.html';
    		}  

    		// 执行新增操作
          
        public function doAdd()
        {

            $data = $this->goods->doAdd();
               if(empty($data) ){
                  notice('添加图片失败');
               }
               notice('添加成功','index.php?c=goods');
        }

        // 执行删除操作
      
        public function doDel()
        {
          $id = $_GET['id'];
          $data =$this->goods->doDel($id);
          // var_dump($data);die;
          
          if(empty($data)){
                 $this->error();die;
           }

          notice('删除成功','index.php?c=goods',1);

        }

        // 加载 编辑页面
      
        public function edit()
        {
            $id = $_GET['id'];
            $data = $this->goods->find($id);

            if(empty($data)){
                 $this->error();die;
             }

            include 'View/goods/edit.html';

        }

        // 执行 编辑
        public function doEdit()
        {
            $id = $_GET['id'];
            // var_dump($id);die;
            $data = $this->goods->doEdit($id);
            if(empty($data)){
              notice('编辑失败');
            }
            notice('编辑成功','index.php?c=goods');
        }
        //执行 上下架 修改
        
        public function doUp()
        {
          $id = $_GET['id'];
          $up = $_GET['up']==1? 2:1;
          
          $data = $this->goods->doUp($id,$up);
         

          header('location:index.php?c=goods');
        }

          //执行 热销滞销 修改
        
        public function doHot()
        {
          $id = $_GET['id'];
          $hot = $_GET['hot']==1? 2:1;
          $data = $this->goods->doHot($id,$hot);

          header('location:index.php?c=goods');
        }

      // 加载商品详细信息
      
      public  function goods_info()
      {
       
        $id = $_GET['id'];

        $data = $this->goods->find($id);

         if(empty($data)){
                 $this->error();die;
          }
        

        include 'View/goods/goods_info.html';
      }

      // 添加图片页面
      public  function addImg()
      {
        $id = $_GET['id'];
          $data = $this->goods->find($id);

         if(empty($data)){
                 $this->error();die;
            }
        include 'View/goods/addImg.html';
      }

      //  执行添加
      public  function  doAddImg()
      {
        $id = $_GET['id'];
        $data = $this->goods->doAddImg($id);

        if(empty($data) ){
             notice('添加图片失败');
          }
         notice('添加成功','','1');
      }

      //  编辑图片页面
      
      public function editImg()
      {
        $id = $_GET['id'];
          $data = $this->goods->editImg($id);
         if(empty($data)){
                 $this->error();die;
            }
        include 'view/goods/editImg.html';
      }

      //  执行图片编辑   
      
      public function doEditImg()
      {
        $imgInfo = $_GET; 
        $data = $this->goods->doEditImg($imgInfo);
        if(empty($data)){
          notice('设置失败','','1');
        }
          notice('设置成功','','1');

      }
      //  删除图片  
      public function delImg()
      {
        $id = $_GET['id'];
        $data = $this->goods->delImg($id);
        if(empty($data)){
            notice('删除失败','','1');
        }
        notice('删除成功','','1');
      }

    }