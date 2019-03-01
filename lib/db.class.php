<?php 


//封装一个数据库类


class Db{

	protected $hostname;//主机名
	protected $username;//用户名
	protected $password;//密码
	protected $dbname;//数据库名
	protected $port;//端口号

	protected $link;//数据库连接成功的对象

	function __construct( ){
		//echo "<pre>";
		//var_dump( $config );
		$config = include ROOT.'/lib/config.php';

		//var_dump( $config );
		$this->hostname = $config['hostname'];
		$this->username = $config['username'];
		$this->password = $config['password'];
		$this->dbname = $config['dbname'];
		$this->port = $config['port'];
		$this->__connect();

		//构造函数中，只涉及一些初始化操作
	}

	// 行业上的规范函数名前加下划线，代表只在函数内部或类内部自身使用
	protected function __connect(){//类中的每一个功能模块都单独设计
		$this->link = @mysqli_connect( $this->hostname,$this->username,$this->password,$this->dbname,$this->port );
		if( !$this->link ){
			die('数据库连接失败');
		};
	}

	static function getString( $value ){
		
		return '\''.$value.'\'';
	}

	public function selectAll( $sql ){
		
		//$sql = "SELECT * FROM {$tablename} WHERE {$where}";
		$results = mysqli_query( $this->link,$sql );

		return mysqli_fetch_all( $results,MYSQLI_ASSOC );
	}

	public function selectOne($sql){
	
		//$sql = "SELECT * FROM {$tablename} WHERE {$where}";
		$results = mysqli_query( $this->link,$sql );

		return mysqli_fetch_assoc( $results );
	}

	public function deleteOne($tablename,$where){
		$sql = "DELETE FROM {$tablename} WHERE {$where}";
		return mysqli_query( $this->link,$sql );
	}


	public function updateOne($tablename,$arg,$where){

		$v = [];
		foreach ($arg as $k => $value) {
            //将数组中的元素转换成SQL语句中修改语句中的格式
            $v[] = $k.' = '.self::getString($value);
        };
        $str = implode(',', $v);// 例：name='admin',age=18
        //UPDATE score SET name='admin',age=18 WHERE uid=1;

       

		$sql = "UPDATE {$tablename} SET {$str} WHERE {$where}";
		return mysqli_query($this->link,$sql);
		
	}

	/*
		function : inserOne 
		说明：往对应表当中插入一条数据
		@$tablename: 表名
		@$arg:对应表里要插入的键值对数据
	 */
	public function insertOne( $tablename,$arg ){

		$keys = [];
		$values = [];
		foreach ($arg as $key => $value) {
			$keys[] = $key;
			$values[] = self::getString($value);
		};

		$k = implode(',',$keys);//name,age,sex
		$v = implode(',',$values);//admin,18,\'男\'

		$sql = "INSERT INTO {$tablename} ( {$k} ) VALUES ( $v )";
		
		return mysqli_query( $this->link,$sql );
	}


	function __destruct()
	{
		@mysqli_close( $this->link );
		//echo '123';
	}

};





