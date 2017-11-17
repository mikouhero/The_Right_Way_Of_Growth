<?php 
	
	class Page 
	{
		private $page;
		private  $maxPage;
		private $count;
		private $controller ;


		public function show($controller='user')
		{
			$this->controller = $controller;
			$link = '';
			for($i = 1;$i <= $this->maxPage;$i++){

				$link .= '<a href ="index.php?c='.$this->controller.'&page='.$i.'"> '.$i.' </a>';

			}
			$html = '共 '.$this->count.' 条数据 '.$this->page.'/'.$this->maxPage.' 页  ';
			$html .= '<a href ="index.php?c='.$this->controller.'&page='.($this->page-1).'"> 上一页 </a>';
			$html .= $link;
			$html .= '<a href ="index.php?c='.$this->controller.'&page='.($this->page+1).'"> 下一页 </a>';

			return $html;
		}
		// public function show()
		// {
		// 	$link = '';
		// 	for($i = 1;$i <= $this->maxPage;$i++){

		// 		$link .= '<a href ="index.php?c=user&page='.$i.'"> '.$i.' </a>';

		// 	}
		// 	$html = '共 '.$this->count.' 条数据 '.$this->page.'/'.$this->maxPage.' 页  ';
		// 	$html .= '<a href ="index.php?c=user&page='.($this->page-1).'"> 上一页 </a>';
		// 	$html .= $link;
		// 	$html .= '<a href ="index.php?c=user&page='.($this->page+1).'"> 下一页 </a>';

		// 	return $html;
		// }

		public function getLimit($count,$rows)
		{
			// 获取当前页码
			$this->page =  empty($_GET['page'])? 1:$_GET['page'] ;

			$this->count = $count;
			// 获取页码最大数
				$this->maxPage = ceil($this->count/$rows);

			// 限制页码范围
			$this->page = max(1,$this->page);

			$this->page = min($this->maxPage,$this->page);

			// 计算数据下标
			$key = ($this->page-1)*$rows;

			return ($key.','.$rows);	
		}
	}	