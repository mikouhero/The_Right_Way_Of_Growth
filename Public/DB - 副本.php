<?php 
	
	// 所有的数据库操作, 都在DB类中
	class DB
	{
		private $pdo;
		private $table;
		private $where;
		private $order;
		private $group;
		private $having;
		private $field = '*';

		public function __construct($table)
		{
			$this->pdo = new PDO(DSN, USER, PWD);
			$this->table = $table;
		}

		// 查询所有
		public function select()
		{
			$sql = 'select '.$this->field.' from '.$this->table.$this->where.$this->group.$this->having.$this->order;

			$data = $this->pdo->query($sql);

			// 如果查询失败, 则直接返回false
			if(empty($data)){
				return false;
			}

			$data = $data->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		// 单条查询
		public function find()
		{
			$sql = 'select '.$this->field.' from '.$this->table.$this->where;

			// query() 返回PDOStatement对象
			$data = $this->pdo->query($sql);

			// 如果查询失败, 则直接返回false
			if(empty($data)){
				return false;
			}

			$data = $data->fetch(PDO::FETCH_ASSOC);

			return $data;
		}

		// 增
		public function insert($arr = array())
		{
			// 如果没有$arr, 自动去post去拿
			if(empty($arr)){
				$arr = $_POST;
			}
			
			$field = '';
			$value = '';
			foreach ($arr as $k => $v) {
				$field .= '`'.$k.'`,';
				$value .= '"'.$v.'",';
			}

			$field = rtrim($field, ',');
			$value = rtrim($value, ',');

			$sql = 'insert into  '.$this->table.'('.$field.') values('.$value.') ';

			// var_dump($sql);die;
			$data = $this->pdo->exec($sql);
			// var_dump($data);die;
			if(!empty($data)){
				$data = $this->pdo->lastInsertID();
			}
			return $data;
		}


		// 改
		public function update($arr = array())
		{
			if(empty($arr)){
				$arr = $_POST;
			}

			$field = '';
			foreach ($_POST as $k => $v) {
				$field .= '`'.$k.'`="'.$v.'",';
			}
			$field = rtrim($field, ',');
			$sql = 'update '.$this->table.' set '.$field.$this->where;
			
			$data = $this->pdo->exec($sql);
			return $data;
		}

		// 删
		public function delete()
		{
			$sql = 'delete from '.$this->table.$this->where;

			// var_dump($sql);die;
			$data = $this->pdo->exec($sql);
			// var_dump($data);die;
			return $data;
			
		}


		// where
		public function where($condition = '')
		{
			$this->where = '';
			if(!empty($condition)){
				$this->where = ' where '.$condition;
			}
			return $this;
		}

		// group
		public function group($condition = '')
		{
			$this->group = '';
			if(!empty($condition)){
				$this->group = ' group by '.$condition;
			}
			return $this;
		}

		// having
		public function having($condition = '')
		{
			$this->having = '';
			if(!empty($condition)){
				$this->having = ' having '.$condition;
			}
			return $this;
		}

		// order
		public function order($condition = '')
		{
			$this->order = '';
			if(!empty($condition)){
				$this->order = ' order by '.$condition;
			}
			return $this;
		}

		// field
		public function field($condition = '')
		{
			
			if(empty($condition)){
				$this->field = '*';	
			}else{
				$this->field = $condition;
			}

			return $this;
		}

	}

