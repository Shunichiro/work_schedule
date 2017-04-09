
<body>
	<div data-role="page" id="work">
		<div data-role="header" data-position="fixed">
			<a href="./menu.php" data-transition="slide" data-direction="reverse" data-icon="back">戻る</a>
			<a href="./session_sample_logout.php" id="logout" data-ajax="false" data-icon="bars">logout</a>
			<h1>work</h1>
		</div>
		<div data-role="content">
			<ul data-role="listview">
				<?php
					foreach($work_data as $key => $value) {
						print '<li><a href="./record.php?mid='.$menu_id.'&wid='. $value['work_id'].'" data-transition="slide">';
						print $value['work_id'];
						print '. ';
						print $value['work_name'];
						print '</a></li>';
					}
				?>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed">
			<h3>2016</h3>
		</div>
	</div>
<!-- 	<script>
		$('#logout').click(function(){
			location.href = './session_sample_logout.php';
		});
	</script> -->
</body>
</html>