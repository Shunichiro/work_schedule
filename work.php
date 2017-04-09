<?php
	require_once './include/conf/const.php';
	require_once './include/model/model.php';
	require_once './login_session.php';//追加＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜
	$menu_id = $_GET['mid'];
	// echo $menu_id;
	$work_data = array();

	$link = get_db_connect();
	$work_data = list_work_table($link , $menu_id);
	close_db_connect($link);

	include_once './include/view/header.php';
	include_once './include/view/v_work.php';

	//そーたブルにする。
	//前回行ったリストを分類できるようにする。
	//項目をユーザーが編集、追加できるようにする。