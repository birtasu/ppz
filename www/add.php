<?php
$connection = new mysqli ("db","root","test");
$connection->select_db ("Preproduction");
$connection->query('set character_set_client="utf8"');
$connection->query('set character_set_results="utf8"');


for($i = 1; $i <= 50; $i++) {

if (
				!empty($_REQUEST['tema_'.$i])
								
			) {
				$my_id = date ('dmyHis');				
				$tema=$_REQUEST['tema_'.$i];
				$pidviddil = $_REQUEST['pidviddil'];
				$zmina = $_REQUEST['zmina'];
				$date = $_REQUEST['date'];
				$tab = $_REQUEST['tab']; 
				$instrument = $_REQUEST['instrument_'.$i];
				$result = $connection->query ("INSERT INTO PPZ (my_id, tema, pidviddil, zmina, date, tab, instrument) VALUES ('$my_id', '$tema', '$pidviddil', '$zmina', '$date', '$tab', '$instrument')");
				
				
			}

}
if ($result == 'true') {$list = array('status'=>'OK');}else{$list = array('status'=>'nOK');}

echo json_encode($list);

?>