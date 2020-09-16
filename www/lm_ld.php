<?php
include 'conf.php';
$result = $connection->query('SELECT * FROM `PPZ` WHERE my_id = "'.$_REQUEST['my_id'].'";');
echo '<table class="ui table" style="margin: auto; border: 1px solid #A4A4A4; width: 80%;">
		<thead>
			<tr>
				<th style="width: 5%;">№</th>
				<th style="width: 25%; display: '.($_REQUEST['p'] == '2' || $_REQUEST['p'] == '5' || $_REQUEST['p'] == '6' || $_REQUEST['p'] == '7' || $_REQUEST['p'] == '8' || $_REQUEST['p'] == '9' ? '' : 'none').';">Інструмент</th>
				<th>Тема, зголошена проблема</th>
			</tr>
		</thead>
	<tbody>';
$i=1;
while ($row = mysqli_fetch_assoc($result)) {
	echo '<tr class="child" data-my_id="'.$row['my_id'].'">
			<td>'.$i++.'</td>
			<td style="display: '.($_REQUEST['p'] == '2' || $_REQUEST['p'] == '5' || $_REQUEST['p'] == '6' || $_REQUEST['p'] == '7' || $_REQUEST['p'] == '8' || $_REQUEST['p'] == '9' ? '' : 'none').';">'.$row['instrument'].'</td>
			<td>'.$row['tema'].'</td>						
		</tr>';
}
echo '</tbody></table>';
?>