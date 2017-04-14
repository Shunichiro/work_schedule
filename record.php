<!-- test2 -->

<?php
	require_once './include/conf/const.php';
	require_once './include/model/model.php';
	require_once './login_session.php';//追加＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜

	$menu_id = $_GET['mid'];//？？？ここにはhtmlspecialchars()が必要ないのか？
	$work_id = $_GET['wid'];
	$record_id = $_GET['rid'];

	$weight_num = htmlspecialchars($_POST['weight_num'], ENT_QUOTES, 'UTF-8');
	$reps_num = htmlspecialchars($_POST['reps_num'], ENT_QUOTES, 'UTF-8');
	$note_text = htmlspecialchars($_POST['note_text'], ENT_QUOTES, 'UTF-8');
	//上記とmodel.phpの


	$record_array = array();
	$sortable_num ='';
	$today_result_data = array();
	// print $today_result_data;
	$before_result_data = array();

	$link = get_db_connect();
	if($record_id ==''){
		record_insert($link,$menu_id,$work_id);//
	}else{
		record_update($link, $menu_id, $work_id, $record_id );
	}
	//if
	$temporary = get_record($link, $record_id);
	$weight_num = $temporary['weight'];
	$reps_num = $temporary['reps'];
	$note_text = $temporary['comment'];

	$today_result_data = today_result( $link, $menu_id, $work_id );
	$before_result_data = latest_result_data( $link, $menu_id, $work_id );
	//print_r($today_result_data);
	close_db_connect($link);


	include_once './include/view/header.php';
	include_once './include/view/v_record.php';

	//前回結果の取得sqlを再考する。