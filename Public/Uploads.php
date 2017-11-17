<?php 
	
	class Uploads
	{
		public function is_up()
		{
			
				$key = key($_FILES);
				$error = $_FILES[$key]['error'];
				if($error == 4){
					// 代表上传文件
					return true;

				}
					// 代表上传了文件
					
					return false;
			
		}

		public function singleUp($save='../Uploads/',$allowType = array('image'))
		{

			// 判断错误 
			
			$key = key($_FILES);
			if(empty($key)){
				return '文件过大';
			}

			// 错误号
			$errorCode = $_FILES[$key]['error'];

				if($errorCode > 0){
					switch($errorCode)
					{
						case '1':return '文件过大';
						case '2':return '文件过大';
						case '3':return '网络错误';
						case '4':return '请选择文件';

						case '6':return '请联系管理员';
						case '7':return '请联系管理员';
					}
				}
			// 判断 post 协议上传
			
				$tmp = $_FILES[$key]['tmp_name'];
				if(!is_uploaded_file($tmp)){
					return '非法上传';
				}

			// 判断文件类型
					// 获取文件类型
				
				$type = $_FILES[$key]['type'];
				$fileType = strtok($type,'/');

			//判断文件是否在allowType内
					
				if(!in_array($fileType,$allowType)){
					return '格式错误';
				}

			// 设计新名字
				// 获去文件的后缀名
				
				$name = $_FILES[$key]['name'];
				$suffix = strrchr($name,'.');
				// 设计

				$fileName = date('Ymd').uniqid().$suffix;

			// 设置存储目录
				$filePath = $save.date('/Y/m/d/');

				// 判断目录是否存在
				
				if(!file_exists($filePath)){
					mkdir($filePath,0777,true);
				}

			// 移动文件
			
				if(move_uploaded_file($tmp,$filePath.$fileName)){
					$arr[] = $fileName;
					return $arr;
				}
				return '上传失败';				

		}

	}