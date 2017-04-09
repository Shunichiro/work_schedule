<!-- </head> --><!-- ログインテストの為設置 -->
<body>
	<div data-role="page" id="record">
		<div data-role="header" data-position="fixed">
			<a href="./work.php?mid=<?php print $menu_id; ?>" data-transition="slide" data-direction="reverse" data-icon="back">戻る</a>
			<h1>record</h1>
		</div>
		<form method="post" data-ajax="false" action="">
			<div data-role="content">
				<fieldset class="ui-grid-a">
					<div class="ui-block-a weight">
						weight<br>
						<input type="number" name="weight_num" value=<?php print $weight_num; ?>>
					</div>
					<div class="weight_kg">kg</div>
					<div class="ui-block-b reps">
						reps<br>
						<input type="number" name="reps_num" value=<?php print $reps_num; ?>>
					</div>
				</fieldset>
			</div>
			<div data-role="content" class="note_css">
				<div>
					note<input type="text" name="note_text" value=<?php print $note_text; ?>>
				</div>
			<div>
		</form>

		<div>
			<input type="submit" name="record_result" class="record_marjin" value="Record">
		</div>

		<!-- 今回、前回、結果の表示 -->
		<div data-role="content">
			<fieldset class="ui-grid-a">
				<div class="ui-block-a" style="background-color: silver; font-size: 10px;">
					<h4>今回結果</h4>
					<table>
						<?php
							$count = 0;
							// $today_result_data;
							// print_r($today_result_data);
							foreach($today_result_data as $key => $value) {
								// print_r($today_result_data);
								$count++;
								print '<tr>';
								print '<td>' . 'Set '. $count . "," . '</td>';
								print '<td>' . $value['weight'] . 'kg' . '</td>';
								print '<td>' . $value['reps'] . 'reps' . '</td>';
								print '<td>' .'<a href="record.php?mid='.$menu_id.'&wid='.$work_id.'&rid='.$value['record_id'].'">編集</a>'.  '</td>';
								print '</tr>';
							}
						?>
					</table>
				</div>

				<div class="ui-block-b" id="before_result" style="background-color: gray; font-size: 10px;">
					<h4>前回結果</h4>
					<table>
						<?php
							$count = 0;
							foreach($before_result_data as $key => $value) {
								$count++;
								print '<tr>';
								print '<td>' . 'Set ' . $count . "," . '</td>';
								print '<td>' . $value['weight'] . 'kg' . '</td>';
								print '<td>' . $value['reps'] . 'reps' . '</td>';
								print '</tr>';
							}
						?>
					</table>
				</div>
			</fieldset>
		</div>
	</div>

	<div data-role="footer" data-position="fixed">
			<h3>2016</h3>
	</div>
</body>
</html>

