<?php
	error_reporting(E_ALL & ~E_NOTICE);

	//コネクションの取得
	function get_db_connect(){
		if (!$link = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_NAME,DB_PORT)) {
			die('error: ' . mysqli_connect_error());
		}
		mysqli_set_charset($link, DB_CHARACTER_SET);//DB_CHARACTER_SET => const.php
		return $link;
	}

	//DBコネクションの切断
	function close_db_connect($link){
		mysqli_close($link);
	}

	//なぜ？$dataがmodelの$body_parts_dataに代入される？?????????????????????????????????????
	//クエリを実行して結果を配列で取得する
	function get_as_array($link,$sql){
		$data = array();
		if ($result = mysqli_query($link,$sql)) {
			if (mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}
			}
			mysqli_free_result($result);
		}
		return $data;
	}

	//menuの一覧を取得する
	function get_menu_table_list($link){
		$sql = 'SELECT menu_id, menu_name FROM menu_table';
		return get_as_array($link,$sql);
	}

	//workの一覧を取得する
	function list_work_table($link , $menu_id){
		$sql = 'SELECT work_id, work_name FROM work_table WHERE menu_id = ' . $menu_id;
		return get_as_array($link,$sql);
	}

	// レコード
	function record_insert($link,$menu_id,$work_id){//引数で渡す＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			date_default_timezone_set('Asia/Tokyo');
			$record_date = date('Y-m-d H:i:s');
			$user_id = 1;
			// $menu_id = $_GET['mid'];//引数に移行
			// $work_id = $_GET['wid'];//引数に移行
			$weight_num = htmlspecialchars($_POST['weight_num'], ENT_QUOTES, 'UTF-8');
			$reps_num = htmlspecialchars($_POST['reps_num'], ENT_QUOTES, 'UTF-8');
			$note_text = htmlspecialchars($_POST['note_text'], ENT_QUOTES, 'UTF-8');
			$query = 'INSERT INTO record_table (`user_id`,`menu_id`,`work_id`,`date`,`weight`,`reps`,`comment`) VALUES ("'.$user_id.'","'.$menu_id.'","'.$work_id.'","'.$record_date.'","'.$weight_num.'","'.$reps_num.'","'.$note_text.'")';
			// print $query;
			// die();
			mysqli_query($link, $query);
			// header('Location:schedule_menu.php#record');//リダイレクト getで自身を呼び出す
		}
	}

		// レコード
	function record_update($link, $menu_id, $work_id, $record_id ){//引数で渡す＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞＞
		if ($_SERVER['REQUEST_METHOD']==='POST') {
			// $menu_id = $_GET['mid'];//引数に移行
			// $work_id = $_GET['wid'];//引数に移行
			$weight_num = htmlspecialchars($_POST['weight_num'], ENT_QUOTES, 'UTF-8');
			$reps_num = htmlspecialchars($_POST['reps_num'], ENT_QUOTES, 'UTF-8');
			$note_text = htmlspecialchars($_POST['note_text'], ENT_QUOTES, 'UTF-8');
			// $record_id = $_GET['rid'];//引数に移行
			$query = 'UPDATE record_table SET weight = '.$weight_num.', reps  = '.$reps_num.', comment = "'.$note_text.'" WHERE record_id='.$record_id;

			// print $query;
			// die();
			mysqli_query($link, $query);
			header('Location:record.php?mid='.$menu_id.'&wid='.$work_id);//リダイレクト getで自身を呼び出す
			die();
		}
	}

	// 編集
	function get_record( $link, $record_id ){
		if ($link) {
			$date_Ymd = date('Y-m-d');//???????必要ない？？？？？？？
			$sql = 'SELECT record_id, `work_id`,`weight`,`reps`,`comment` FROM record_table '
				 . ' WHERE '
				 . ' record_id = '. $record_id .' '
				 . ' ORDER BY date asc; ';
			//print_r($sql);
			$work = get_as_array($link,$sql);
			return $work[0];//test？？？？？一行分だけなら、他に書き方があるのか？
		}
	}

	// 本日の結果取得
	function today_result( $link, $menu_id, $work_id ){
		if ($link) {
			$date_Ymd = date('Y-m-d');
			//print_r($date_Ymd); result=>2017-01-26
			$sql = 'SELECT record_id, `work_id`,`weight`,`reps`,`comment` FROM record_table '
				 . ' WHERE '
				 . ' date BETWEEN "' . $date_Ymd . ' 00:00:00" AND "' . $date_Ymd . ' 23:59:59" '
				 . ' AND user_id = 1 '
				 . ' AND menu_id = '. $menu_id .' '
				 . ' AND work_id = '. $work_id .' '
				 . ' ORDER BY date asc; ';
			//print_r($sql);
			return get_as_array($link,$sql);//test
		}//test下記を活かす場合は左記中括弧を削除する

		// 	$result= mysqli_query($link, $sql);
		// 	while ($row = mysqli_fetch_array($result)) {
		// 			$today_result_data[] = $row;
		// 	}
		// 	mysqli_free_result($result);
		// }
		// return $today_result_data;
	}

	// 直近の結果取得
	function latest_result_data( $link, $menu_id, $work_id ){
		$before_result_data = array();
		if ($link) {
			$date_Ymd = date('Y-m-d');
			$sql = 'SELECT `work_id`,`weight`,`reps`, DATE_FORMAT(`date`, "%Y-%m-%d") as date FROM record_table '
				 . ' where '
				 . ' date < "'.$date_Ymd.' 00:00:00" '
				 . ' AND user_id = 1 '
				 . ' AND menu_id = ' . $menu_id . ' '
				 . ' AND work_id = ' . $work_id . ' '
				 . 'ORDER BY date desc LIMIT 1 ;';
			// print_r($sql);
			$result = mysqli_query($link, $sql);
			$work = mysqli_fetch_array($result);
			if ($work != NULL) {
				$sql = 'SELECT `work_id`,`weight`,`reps`,`comment` FROM record_table WHERE date BETWEEN "' . $work['date'] . ' 00:00:00" AND "' . $work['date'] . ' 23:59:59" ORDER BY date asc;';

				$result = mysqli_query($link, $sql);
				// print_r($result);
				while ($row = mysqli_fetch_array($result)) {
					$before_result_data[] = $row;
				}
			}

			mysqli_free_result($result);
		}
		return $before_result_data;
	}









