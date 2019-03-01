<?php 

//普通用户的登录状态使用 userLogin就存储 用户的id

class UserController{

	static function isUserLogin(){
		if( empty( $_SESSION['userLogin'] ) ){
			echo '<script> window.location.href = " ./index.php?c=user&a=login "; </script>';
		};
	}

	public function index(){
		//echo '首页';

		// if( empty( $_SESSION['userLogin'] ) ){
		// 	echo '<script> window.location.href = " ./index.php?c=user&a=login "; </script>';
		// };
		self::isUserLogin();

		include ROOT.'/model/user.model.php';
		$userM = new UserModel;

		$result = $userM->selectUser();

		//var_dump( $result );
		//exit;

		$username = $result['username'];
		include ROOT.'/view/usercenter.html';
	}

	public function login(){
		//echo '列表';
		include ROOT.'/view/userloginandreg.html';
		echo "<script>cambiar_login();</script>";
	}

	public function dologin(){
		//echo '内容';
		if( empty($_POST['username']) ){
			echo '用户名不能为空';
			exit;
		};
		if( empty($_POST['password']) ){
			echo '密码不能为空';
			exit;
		};

		/*
			0 ：登录成功
			1 ：用户名不存在
			2 ：密码错误
		 */
		include ROOT.'/model/user.model.php';
		$userM = new UserModel;

		$result = $userM->selectOne( $_POST );
		//echo '<pre>';
		//var_dump( $result['result']['id'] );
		//exit;
		//echo '普通用户post提交过来的登录';
		if( $result['flag'] == '0' ){
			echo '登录成功';
			$_SESSION['userLogin'] = $result['result']['id'];

			echo '<script> window.location.href = " ./index.php?c=user&a=index "; </script>';

			exit;
		}elseif( $result['flag'] == '1' ){
			echo '用户名不存在';
			exit;
		}elseif( $result['flag'] == '2' ){
			echo '密码错误';
			exit;
		}
	}

	public function reg(){
		//echo '列表';
		include ROOT.'/view/userloginandreg.html';
		echo "<script>cambiar_sign_up();</script>";
	}

	public function doreg(){
		//echo '内容';
		//var_dump( $_POST );


		if( empty($_POST['username']) ){
			echo '用户名不能为空';
			exit;
		};
		if( empty($_POST['password1']) ){
			echo '密码不能为空';
			exit;
		};

		// $username = $_POST['username'];
		// $email = $_POST['email'];
		// $password1 = $_POST['password1'];
		// $password2 = $_POST['password2'];

		include ROOT.'/model/user.model.php';
		$userM = new UserModel;

		//var_dump($userM->insertOne($_POST) );
		$result = $userM->insertOne($_POST);
		if( $result == '0' ){
			echo '注册成功';
			exit;
		}elseif( $result == '1' ){
			echo '用户已存在';
			exit;
		}elseif( $result == '2' ){
			echo '注册失败';
			exit;
		}
		/*
			1 连接数据库

			2 写sql语句

			3 执行sql语句

			4 获取sql语句被执行以后的状态

			5 关闭数据库
		 */

		//echo '普通用户post提交过来的注册';
	}

	public function publish(){

		// if( empty( $_SESSION['userLogin'] ) ){
		// 	echo '<script> window.location.href = " ./index.php?c=user&a=login "; </script>';
		// };
		self::isUserLogin();
		include ROOT.'/view/userpublish.html';
	}

	public function dopublish(  ){
		include ROOT.'/model/article.model.php';
		$articleM = new ArticleModel;

		$result = $articleM->insertArticleOne( $_POST );

		//var_dump( $result );
		if( $result ){
			echo '发表成功';
			exit;
		}else{
			echo '发表失败';
			exit;
		};
	}
}


 ?>