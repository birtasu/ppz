<?php
$connection = new mysqli ("db","root","test");
$connection->select_db ("Preproduction");
$connection->query('set character_set_client="utf8"');
$connection->query('set character_set_results="utf8"');
if (isset ($_POST['my_id']))   {$my_id = $_POST['my_id']; if ($my_id =='') {unset($my_id);}}
if (isset ($_POST['tab_2']))   {$tab_2 = $_POST['tab_2']; if ($tab_2 =='') {unset($tab_2);}}
if (isset ($_POST['p']))   {$p = $_POST['p']; if ($p =='') {unset($p);}}
if (isset ($_POST['user_id']))   {$user_id = $_POST['user_id']; if ($user_id =='') {unset($user_id);}}
if (isset ($_POST['new_pass']))   {$new_pass = $_POST['new_pass']; if ($new_pass =='') {unset($new_pass);}}
if (isset ($_POST['del']))   {$del = $_POST['del']; if ($del =='') {unset($del);}}
if (isset ($_POST['del_user']))   {$del_user = $_POST['del_user']; if ($del_user =='') {unset($del_user);}}
if (isset ($_POST['add_user']))   {$add_user = $_POST['add_user']; if ($add_user =='') {unset($add_user);}}
if (isset ($_POST['pidviddil']))   {$pidviddil = $_POST['pidviddil']; if ($pidviddil =='') {unset($pidviddil);}}
?>
<?php
if($my_id > '0'){
$result = $connection->query("UPDATE `Preproduction`.`PPZ` SET `tab_2`=$tab_2 WHERE `my_id`=$my_id");

if ($result == 'true') {echo "<script type='text/javascript'>
setTimeout(function(){location.replace('bd.php?p=$p');}, 2);
	</script>";}
else {echo "<p class='eee'>Дані не внесено!</p>";}
}
if($user_id > '0'){
$result = $connection->query("UPDATE `Preproduction`.`PPZ_users` SET `users_password`=$new_pass WHERE users_login=$user_id");
}
if($del > '0'){
$result = $connection->query("DELETE FROM `Preproduction`.`PPZ` WHERE `my_id` = '$del'");
}
if($del_user > '0'){
$result = $connection->query("DELETE FROM `Preproduction`.`PPZ_users` WHERE `users_login` = '$del_user'");
}
if($add_user > '0'){
$result = $connection->query("INSERT INTO `Preproduction`.`PPZ_users` (`users_login`, `users_password`, `pidviddil`) VALUES ('$add_user', '$add_user', '$pidviddil')");
}

?>