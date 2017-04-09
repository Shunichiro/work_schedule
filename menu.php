<?php
	require_once './include/conf/const.php';
	require_once './include/model/model.php';
	require_once './include/model/login_function.php';//追加＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜
	require_once './login_session.php';//追加＜＜＜?????この書き方は有りか？使い回し＜＜＜＜＜＜＜＜
	// require_once './session_sample_home.php';//追加＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜

//追加＜＜＜＜＜？？？？？？＜＜＜＜下記セッションはrequire_once などで他ページ等で使いまわし出来ないのか？
	// // セッション開始
	// session_start();
	// // セッション変数からuser_id取得
	// if (isset($_SESSION['user_id']) === TRUE) {
	//    $user_id = $_SESSION['user_id'];
	// } else {
	//    // 非ログインの場合、ログインページへリダイレクト
	//    header('Location: http://shunichiro.jp/session_sample_top.php');//変更・・・・・・・・・・・・・・・・
	//    exit;
	// }
	// // データベース接続
	// $link = get_db_connect();
	// // user_idからユーザ名を取得するSQL
	// $sql = 'SELECT user_name FROM user_table WHERE user_id = ' . $user_id;
	// // SQL実行し登録データを配列で取得
	// $data = get_as_array($link, $sql);
	// // データベース切断
	// close_db_connect($link);
	// // ユーザ名を取得できたか確認
	// if (isset($data[0]['user_name'])) {
	//    $user_name = $data[0]['user_name'];
	// } else {
	//    // ユーザ名が取得できない場合、ログアウト処理へリダイレクト
	//    header('Location: http://shunichiro.jp/session_sample_logout.php');//変更・・・・・・・・・・・・・・・・
	// }


//追加＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜＜

// ????get_db_connect();とclose_db_connect($link);は何度も上下で使うのか？？？？？？？？？？？？？？？？？




	$body_parts_data = array();
	//？？？下記は、アクセスされているのか？アクセスキーなのか？
	$link = get_db_connect();//model.php＞＞＞データベースにアクセス
	// var_dump($link);//$linkの中身は何か？
	$body_parts_data = get_menu_table_list($link);//model.php
	close_db_connect($link);//model.php

	include_once './include/view/header.php';
	include_once './include/view/v_menu.php';

	//Noを消す。
	//ユーザーログイン。
	//項目をユーザーが編集、追加できるようにする。
