<?php 

// 模型不关心具体的业务调用 ，它只关心数据
class UserModel{
	
	static function getDb(){
		include ROOT.'/lib/db.class.php';
		$db = new Db;
		return $db;
	}


	public function insertOne( $post )
	{
		//var_dump( $post );
		$db = self::getDb();
		/*
			id
			username
			password
			email
			regtime
		 */
		
		$username = $post['username'];
		$password = md5($post['password1'].'我是一个门槛，你不知道是啥，我也不知道是啥');
		$email = $post['email'];
		$t = time();


		/*
			0：注册成功
			1：有注册的用户了
			2：注册失败
		 */

		//var_dump(  );
		if( !empty($db->selectOne("SELECT * FROM b_user WHERE username='$username'")) )
		{
			return '1';
			exit;
		};
		


		$arg = [
			'username'=>$username,
			'password'=>$password,
			'email'=>$email,
			'regtime'=>$t
		];

		//return $db->insertOne( 'b_user',$arg );
		if( $db->insertOne( 'b_user',$arg ) ){
			return '0';
			exit;
		}else{
			return '2';
			exit;
		}

	}


	public function selectOne( $post ){
		
		$db = self::getDb();
		
		$username = $post['username'];
		$password = md5($post['password'].'我是一个门槛，你不知道是啥，我也不知道是啥');
		// var_dump($db->selectOne("SELECT * FROM b_user WHERE username='$username'"));

		//echo "SELECT * FROM b_user WHERE username='$username'";
		//exit;
		$result = $db->selectOne("SELECT * FROM b_user WHERE username='$username'");
		//exit;
		//var_dump( empty( $reslut ) );
		//exit;
		//
		// [
		// 	"flag":'1',//返回的状态
		// 	"result":$result
		// ]
		/*
			0 ：登录成功
			1 ：用户名不存在
			2 ：密码错误
		 */

		if( empty( $result ) ){
			return [
					"flag"=>'1'//返回的状态
				];
			exit;
		}

		if( $password == $result['password'] ){
			return [
					"flag"=>'0',//返回的状态
					"result"=>$result
				];
			exit;
		}else{
			return [
					"flag"=>'2'//返回的状态
				];
			exit;
		}
		
	}


	public function selectUser(){

		$db = self::getDb();
		$id = $_SESSION['userLogin'];
		$result = $db->selectOne("SELECT * FROM b_user WHERE id={$id}");

		return $result;
	}
}

 ?>