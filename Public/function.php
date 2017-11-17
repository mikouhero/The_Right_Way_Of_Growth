<?php 
	// 公共函数库
	
	/**
	 * [notice 提示并跳转]
	 * @param  string  $msg  [提示内容]
	 * @param  string  $url  [跳转到哪儿去]
	 * @param  int     $time [内容显示多久]
	 */
	function notice($msg, $url = '', $time = 1)
	{
		echo '<div class="back" style="width: 100%; height: 100%; position:fixed; top:0; left:0;background-color: rgba(0,0,0,0.8);"></div>';

		echo '<div class="info" style="width: 500px; height: 200px; position:fixed; top:28%; left:28%; background-color:#fff; text-align: center; line-height:200px;"> '.$msg.' </div>';
		
		// 如果$url为空, 默认跳转到上一级地址
		if( $url == ''){
			$url = $_SERVER['HTTP_REFERER'];
		}

		echo '<meta http-equiv="refresh" content="'.$time.'; url='.$url.'">';  die;
	}


	function imgUrl($fileName)
	{	
		$url ='../Uploads/';
		$url .=substr($fileName,0,4).'/';
		$url .=substr($fileName,4,2).'/';
		$url .=substr($fileName,6,2).'/';

		$url .= $fileName;
		return $url;

	}
