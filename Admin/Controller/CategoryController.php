<?php 

	class CategoryController  extends Controller
	{
  		private $category;
  		public function __construct()
  		{
         parent::__construct();
  			$this->category = new categoryModel;
  		}

      // 加载分类主页
  		public function index()
  		{

          //   如果没有id  默认查询 1 级分类
          
          $pid = empty($_GET['id'])? 0:$_GET['id'];
      		$data = $this->category->index($pid);
      		include 'View/category/index.html';

  		}
      // 查询并排序分类
      
      public function getCate()
      {
        return $this->category->getCate();
      }


      // 添加分类
  		public function add()
  		{
          $pid = empty($_GET['id'])?0:$_GET['id'];
          $path = empty($_GET['path'])?'0,':$_GET['path'].$_GET['id'].',';
      		include 'View/category/add.html';
  			
  		}

  		public function doAdd()
  		{
  			  $data = $this->category->doAdd();
              // var_dump($data);die;
                  if($data){
                    notice('添加成功','index.php?c=category&m=index');
                  }else{
                    notice('添加失败');
                  }

  		}
		  
       // 加载 编辑页面
      
      public function edit()
      {
          $id = $_GET['id'];
          $data = $this->category->find($id);

          include 'View/category/edit.html';

      }

        // 执行 编辑
      public function doEdit()
      {
          $id = $_GET['id'];
          // var_dump($id);die;
          $data = $this->category->doEdit($id);
          if(empty($data)){
            notice('编辑失败');
          }
          notice('编辑成功','');
      }

      // 状态修改
		  public function doStatus()
      {
        $id = $_GET['id'];
        $display = $_GET['display']==1? 2:1;
        $data = $this->category->doStatus($id,$display);

        header('location:index.php?c=category');
      }

      // 删除分类 
      
        public function  doDel()
        {
          $id = $_GET['id'];
          $data = $this->category->doDel($id);
          header('location:index.php?c=category');
        }

        public function getId()
        {
          return $this->category->getId();
        }
   

	}

