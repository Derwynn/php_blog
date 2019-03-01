<?php 


class ArticleModel{
	
	static function getDb(){
		include ROOT.'/lib/db.class.php';
		$db = new Db;
		return $db;
	}

	public function getSelect()
	{

		// 先连接数据库
		// 从真正的数据库拿到我们想要的数据
		$db = self::getDb();
		//select A.name,B.address from A  inner join B on A.id = B.A_id
		//"SELECT * FROM b_article AS a INNER JOIN b_user AS u ON a.author = b.id";

		 // title username content 文章id
		$sql = "SELECT title,username,content,a.id AS id FROM b_article AS a INNER JOIN b_user AS u ON a.author = u.id ORDER BY addtime DESC LIMIT 5";
		$result = $db->selectAll($sql);
		return $result;
	}

	public function getArticleOne( $id ){

		$db = self::getDb();

		$sql = "SELECT * FROM b_article WHERE id={$id}";
		return $db->selectOne($sql);

		// return  [
		// 	"title"=>'我是title',
		// 	"content"=>"我是内容",
		// 	"addtime"=>"2018-10-22"
		// ];
	}

	public function insertArticleOne( $post ){
		//echo '插入文章';
		//echo "<pre>";
		//var_dump( $post );
		$db = self::getDb();
		$author = $_SESSION['userLogin'];
		$arg = [
			"title"=>$post['title'],
			"author"=>$author,
			"content"=>$post['editorValue'],
			"addtime"=>time()
		];

		return $db->insertOne( 'b_article',$arg );
		exit;
	}

}


 ?>