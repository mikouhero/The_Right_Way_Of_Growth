<?php 
    class userController extends Controller{
    		private $user;

    		public function __construct()
    		{
          parent::__construct();
    			$this->user = new userModel;
    		}

    		// 加载用户列表

    		public function index()
    		{
          // 搜索条件

          if(empty($_GET['search'])  ){
              $where = '';
          }else{
              $where = 'tel like "%'.$_GET['search'].'%"';
          }


            // 加载page
            $page = new page;
            // 求总个数
            $count = $this->user->count($where);

            // 分页
            $limit = $page ->getLimit($count,AP);


    	     $data = $this->user->index($limit,$where);
    			include 'View/user/index.html';
    		}

    		// 加载新增用户页面
    		public  function add()
    		{
            // echo '222';die;
      			include 'View/user/add.html';
    		}  

    		// 执行新增操作
          
        public function doAdd()
        {

            $data = $this->user->doAdd();
            // var_dump($data);die;
                if($data){
                  notice('注册成功','index.php?c=user&m=index');
                }else{
                  notice('注册失败');
                }
        }

        // 执行删除操作
      
        public function doDel()
        {
          $id = $_GET['id'];
          $data =$this->user->doDel($id);
          // var_dump($data);die;
          
          if(empty($data)){

             $this->error();die;
          }

            notice('删除成功','index.php?c=user',1);

        }

        // 加载 编辑页面
      
        public function edit()
        {
            $id = $_GET['id'];
            $data = $this->user->find($id);
            if(empty($data)){
                 $this->error();die;
             }
            include 'View/user/edit.html';

        }

        // 执行 编辑
        public function doEdit()
        {
            $id = $_GET['id'];
            // var_dump($id);die;
            $data = $this->user->doEdit($id);
            
            notice('编辑成功','index.php?c=user');
        }
        //执行状态修改
        
        public function doStatus()
        {
          $id = $_GET['id'];
          $status = $_GET['status']==1? 2:1;
          // var_dump($id);
          // var_dump($status);die;
          $data = $this->user->doStatus($id,$status);
          // var_dump($data);die;
            // if(empty($data)){
            //      $this->error();die;
            //  }
          header('location:index.php?c=user');
        }

      // 加载用户详细信息
      
      public  function user_info()
      {
        $id = $_GET['id'];
        $data = $this->user->find($id);
        if(empty($data)){
                 $this->error();die;
             }
        include 'View/user/user_info.html';
      }

    }