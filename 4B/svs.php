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
    			$id = null;
    			if(isset($_POST['id']) && !empty($_POST['id'])) $id = $_POST['id'];
    			writer_get($id);
    			break;
    		case 'writer_insert' :
    			$table	= "tb_writer";
    			$col	= "name";
    			$dt 	= "'".$_POST['name']."'";
    			insert($table, $col, $dt);
    			break;
    		case 'writer_update' :
    			$table	= "tb_writer";
    			$dt 	= "name='".$_POST['name']."'";
    			$wh 	= "id='".$_POST['id']."'";
    			update($table, $dt, $wh);
    			break;
    		case 'writer_delete' :
				$table	= "tb_writer";
    			$wh 	= "id='".$_POST['id']."'";
    			delete($table, $wh);
    			break;
    		case 'category_get' :
    			$id = null;
    			if(isset($_POST['id']) && !empty($_POST['id'])) $id = $_POST['id'];
    			category_get($id);
    			break;
    		case 'category_insert' :
    			$table	= "tb_category";
    			$col	= "name";
    			$dt 	= "'".$_POST['name']."'";
    			insert($table, $col, $dt);
    			break;
    		case 'category_update' :
    			$table	= "tb_category";
    			$dt 	= "name='".$_POST['name']."'";
    			$wh 	= "id='".$_POST['id']."'";
    			update($table, $dt, $wh);
    			break;
    		case 'category_delete' :
    			$table	= "tb_category";
    			$wh 	= "id='".$_POST['id']."'";
    			delete($table, $wh);
    			break;
    		case 'book_get' :
    			$id = null;
    			if(isset($_POST['id']) && !empty($_POST['id'])) $id = $_POST['id'];
    			book_get($id);
    			break;
    		case 'book_insert' :
    			$table	= "tb_book";
    			$col	= "name, category_id, writer_id, publication_year, img";
    			$dt 	= "'".$_POST['name']."', '".$_POST['category_id']."', '".$_POST['writer_id']."', '".$_POST['publication_year']."', '".$_POST['img']."'";
    			insert($table, $col, $dt);
    			break;
    		case 'book_update' :
    			$table	= "tb_book";
    			if(isset($_POST['name']) && !empty($_POST['name'])) {
    				$dt = "name='".$_POST['name']."'";
    			}
    			if(isset($_POST['category_id']) && !empty($_POST['category_id'])) {
    				$dt = "category_id='".$_POST['category_id']."'";
    			}
    			if(isset($_POST['writer_id']) && !empty($_POST['writer_id'])) {
    				$dt = "writer_id='".$_POST['writer_id']."'";
    			}
    			if(isset($_POST['publication_year']) && !empty($_POST['publication_year'])) {
    				$dt = "publication_year='".$_POST['publication_year']."'";
    			}
    			if(isset($_POST['img']) && !empty($_POST['img'])) {
    				$dt = "img='".$_POST['img']."'";
    			}
    			$wh 	= "id='".$_POST['id']."'";
    			update($table, $dt, $wh);
    			break;
    		case 'book_delete' :
    			$table	= "tb_book";
    			$wh 	= "id='".$_POST['id']."'";
    			delete($table, $wh);
    			break;
        }
    }

	function writer_get($id = null) {
		$wh 	= "";
		if (!is_null($id)){
			$wh = "WHERE id=".$id;
		}
		$sql	= "SELECT * FROM tb_writer".$wh;
		$query	= mysql_query($sql);
		while($r= mysql_fetch_assoc($query)) {
			$data[] = $r;
		}
		mysql_close();
		echo json_encode($data);
	}

	function category_get($id = null) {
		$wh 	= "";
		if (!is_null($id)){
			$wh = "WHERE id=".$id;
		}
		$sql	= "SELECT * FROM tb_category".$wh;
		$query	= mysql_query($sql);
		while($r= mysql_fetch_assoc($query)) {
			$data[] = $r;
		}
		mysql_close();
		echo json_encode($data);
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

	function insert($table, $col, $dt) {
		$sql	= "INSERT INTO ".$table." (".$col.") VALUES (".$dt.")";
		mysql_query($sql);
		mysql_close();
		echo json_encode(true);
	}

	function update($table, $dt, $wh) {
		$sql	= "UPDATE ".$table." SET ".$dt." WHERE ".$wh;
		mysql_query($sql);
		mysql_close();
		echo json_encode(true);
	}

	function delete($table, $wh) {
		$sql	= "DELETE FROM ".$table." WHERE ".$wh;
		mysql_query($sql);
		mysql_close();
		echo json_encode(true);
	}
?>
