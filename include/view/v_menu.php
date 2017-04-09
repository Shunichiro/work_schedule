<!-- </head> --><!-- ログインテストの為設置 -->
<body>
	<div data-role="page" id="menu">
		<div data-role="header" data-position="fixed">
			<h1>menu</h1>
		</div>
		<div data-role="content">
			<ul data-role="listview">
				<?php
					foreach ($body_parts_data as $key => $value) {//$body_parts_data => menu.php
						//var_dump($value);//
						//print_r($value);
						print '<li><a href="./work.php?mid='.$value['menu_id'].'"  data-transition="slide">';
						print $value['menu_id'];
						print '. ';
						print $value['menu_name'];
						print '</a></li>';
					}
				?>
			</ul>
		</div>
		<div data-role="footer" data-position="fixed">
			<h3>2016</h3>
		</div>
	</div>
</body>
</html>