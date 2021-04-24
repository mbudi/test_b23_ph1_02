<?php
	$servername = "localhost";
	$username	= "root";
	$password	= "";
	$database	= "db_dumb_library";
	$conn 		= mysql_connect($servername, $username, $password);
	mysql_select_db($database);

	if(isset($_POST['function']) && !empty($_POST['function'])) {
		switch($_POST['function']) {
			case 'writer_get' :
				writer_get();
				break;
			case 'writer_insert' :
				writer_insert($_POST['name']);
				break;
			case 'writer_update' :
				writer_update($_POST['id'], $_POST['name']);
				break;
			case 'writer_delete' :
				writer_delete($_POST['id']);
				break;
			case 'category_get' :
				category_get();
				break;
			case 'category_insert' :
				category_insert($_POST['name']);
				break;
			case 'category_update' :
				category_update($_POST['id'], $_POST['name']);
				break;
			case 'category_delete' :
				category_delete($_POST['id']);
				break;
			case 'book_get' :
				$id = null;
				if(isset($_POST['id']) && !empty($_POST['id'])) $id = $_POST['id'];
				book_get($id);
				break;
			case 'book_insert' :
				book_insert($_POST['name'], $_POST['category_id'], $_POST['writer_id'], $_POST['publication_year'], $_POST['img']);
				break;
			case 'book_update' :
				book_update($_POST['id'], $_POST['name'], $_POST['category_id'], $_POST['writer_id'], $_POST['publication_year'], $_POST['img']);
				break;
			case 'book_delete' :
				book_delete($_POST['id']);
				break;
	    }
	}

	function writer_get() {

	}

	function writer_insert() {
		
	}

	function writer_update() {
		
	}

	function writer_delete() {
		
	}

	function category_get() {

	}

	function category_insert() {
		
	}

	function category_update() {
		
	}

	function category_delete() {
		
	}

	function book_get($id = null) {
		$wh 	= "";
		if (!is_null($id)){
			$wh = "WHERE tb_book.id=".$id;
		}
		$sql	= "SELECT tb_book.id, tb_book.name AS name_book, tb_book.publication_year, tb_category.name AS name_category, tb_writer.name AS name_writer, tb_book.img FROM tb_book LEFT JOIN tb_category ON tb_book.category_id=tb_category.id LEFT JOIN tb_writer ON tb_book.writer_id=tb_writer.id".$wh;
		$query	= mysql_query($sql);
		while($r= mysql_fetch_object($query)) {
			$data[]	= array(
				'id'		=> $r->id,
				'name'		=> $r->name_book,
				'year'		=> $r->publication_year,
				'category'	=> $r->name_category,
				'writer'	=> $r->name_writer,
				'img'		=> base64_encode($r->img)
			);
		}
		mysql_close();
		echo json_encode($data);
	}

	function book_insert() {
		
	}

	function book_update() {
		
	}

	function book_delete() {
		
	}
?>
