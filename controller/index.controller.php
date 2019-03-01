<?php 


class IndexController{
	
	public function index(){
		//echo '首页';
		//
		include ROOT.'/model/article.model.php';
		$am = new ArticleModel;

		$result = $am->getSelect();
		//var_dump($result);
		//echo $result[0]['username'];
		//exit;

		include ROOT.'/view/index.html';
	}

	public function l(){
		//echo '列表';
		include ROOT.'/view/list.html';
	}

	public function show(){
		//echo '内容';

		include ROOT.'/model/article.model.php';
		$am = new ArticleModel;

		//var_dump( $_GET['id'] );
		//exit;
		$result = $am->getArticleOne( $_GET['id'] );

		include ROOT.'/view/show.html';
	}

}


 ?>