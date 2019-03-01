<?php 

session_start();
header('content-type:text/html;charset=utf8');

//echo $_SESSION['userLogin'];
/*
	blogdb


	create database blogdb;


		1: b_article
				id
				title
				author
				content
				addtime

			create table b_article(
				id int primary key auto_increment not null,
				title varchar(200) not null,
				author varchar(100) not null,
				content text not null,
				addtime int
			);
		


		2: b_user
				id
				username
				password
				email
				regtime
			create table b_user(
				id int primary key auto_increment not null,
				username varchar(50) not null,
				password varchar(32) not null,
				email varchar(100) not null,
				regtime int
			);
		
		3: b_admin
				id
				username
				password
				regtime

			create table b_admin(
				id int primary key auto_increment not null,
				username varchar(50) not null,
				password varchar(32) not null,
				regtime int
			);

			admin123 8fbb1fb0b2d300aa9cde0bb919731052

			INSERT INTO b_admin( username,password,regtime ) VALUES ( 'admin123','8fbb1fb0b2d300aa9cde0bb919731052',1545357009 );

 */



// admin123
// md5('admin123'.'我是一个门槛，你不知道是啥，我也不知道是啥');


/*
	index.php文件就是我们mvc项目的唯一入口文件，
	我们所有的链接都要通过
	index.php?参数1=值1&参数2=值2

	我们的链接mvc链接
	controller ：c
	model 	   ：m
	view	   : v


	index.php?controller=控制器名&action=方法名[函数]
	index.php?c=控制器名&a=方法名[函数]


	adminController : 管理模块
	userController ：普通用户模块
	indexController : 没有权限  渲染首页、渲染列表、渲染内容



	现在就可以设计你的网址了、
		设计你的路由

	www.blog.com/
	
	indexController
		1  index.html
			url/index.php?c=index&a=index   访问index控制器的index方法
			url/index.php   默认就是访问index控制器的index方法

		2  list.html
		url/index.php?c=index&a=list   访问index控制器的list方法

		3  show.html
		url/index.php?c=index&a=show   访问index控制器的show方法


	adminController
		1 admincenter.html  管理员个人中心首页

			url/index.php?c=admin&a=index   访问admin控制器的index方法
			url/index.php?c=admin   默认就是访问admin控制器的index方法
		2 adminlogin.html
			url/index.php?c=admin&a=login   访问admin控制器的login方法
			url/index.php?c=admin&a=dologin   访问admin控制器的dologin方法 真正的去提交登录
	
	userController
		1 usercenter.html
			url/index.php?c=user&a=index   访问user控制器的index方法
			url/index.php?c=user  默认就是访问user控制器的index方法
		2 userlogin.html
			url/index.php?c=user&a=login   访问user控制器的login方法
			url/index.php?c=user&a=dologin   访问user控制器的dologin方法 真正的去提交登录
		3 userregister.html
			url/index.php?c=user&a=reg   访问user控制器的reg方法
			url/index.php?c=user&a=doreg   访问user控制器的doreg方法 真正的去提交注册
 */



define('ROOT', __DIR__);

$controller = empty($_GET['c']) ? 'index' : $_GET['c'];
$action = empty($_GET['a']) ? 'index' : $_GET['a'];

include ROOT.'/controller/'.$controller.'.controller.php';

$controllerName = $controller.'controller';

// 实例化控制器
// echo $controllerName;
$c = new $controllerName;
$c->$action();
// echo time();
 ?>

