<?php 


class AdminController{
		
	public function index(){
		//echo '首页';
		include ROOT.'/view/admincenter.html';

	}

	public function login(){
		//echo '列表';
		include ROOT.'/view/adminlogin.html';
		echo "<script>cambiar_login();</script>";
	}

	public function dologin(){
		//echo '内容';
		echo '管理员post提交过来的';
	}
}


 ?>