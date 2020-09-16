<?php

date_default_timezone_set('Europe/Kiev');

include 'conf.php';  


if (isset($_COOKIE['id'])) 
{    
    $userdata = mysqli_fetch_assoc($connection->query("SELECT a.* FROM `PPZ_users` a WHERE a.users_id = '".intval($_COOKIE['id'])."' LIMIT 1"));
    $g = explode(' ', $userdata['users_login']);
    
     if(($userdata['users_id'] !== $_COOKIE['id'])) 
    { 

        setcookie('id', '', time() - 60*24*30*12, '/'); 
        setcookie('errors', '1', time() + 60*24*30*12, '/');
    header('Location: index.php'); exit();
    } 
} 
else 
{ 
  setcookie('errors', '2', time() + 60*24*30*12, '/');
  header('Location: index.php'); exit();
}

if (isset($_GET['exit']))
{
     setcookie('id', '', time() - 30); 
        header("Location: index.php"); exit();}
?>
<?php include("config.php") ?>
<?php include("menu.php"); ?>
<!DOCTYPE HTML PUBLIC>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Протокол передачі зміни</title>	
 </head>
 <body>
 <style>
body {
	background: url(styles/background.jpg) repeat!important;
}
</style>
<table class="ui orange table" style="position: relative; top: 10%; width: 70%; margin: auto; z-index: 1;">
  <thead>
    <tr>
	<th>Табельний</th>
	<th>Користувач</th>
    <th>Підвідділ</th>
	<th></th>
	<th></th>
  </tr></thead><tbody>
<?php 
$result = $connection->query("select a.* from PPZ_users a ORDER by a.pidviddil, a.users_id DESC");
while ($row = mysqli_fetch_assoc($result)) {
$empl = explode(' ', $row['Employee']);
$pdv = ($row['pidviddil'] == '1' ? 'Нарізання проводів' : ($row['pidviddil'] == '2' ? 'Стендове проектування TER' : ($row['pidviddil'] == '3' ? 'Напівфабрикати' : ($row['pidviddil'] == '1' ? 'Контаж кабельних мереж' : ($row['pidviddil'] == '5' ? 'Стендове проектування CHO' : ($row['pidviddil'] == '6' ? 'Тестувальні системи CHO' : ($row['pidviddil'] == '7' ? 'Тестувальні системи TER' : ($row['pidviddil'] == '8' ? 'Стендове проектування CHE' : ($row['pidviddil'] == '9' ? 'Тестувальні системи CHE' : 'Не вказано')))))))));
	print ("<tr style='display: ".($row['users_login'] == '924' ? 'none' : '')."; background: ".($row['pidviddil'] == '2' ? 'rgba(120, 159, 44, 0.2)' : ($row['pidviddil'] == '5' ? 'rgba(120, 75, 157, 0.2)' : ($row['pidviddil'] == '6' ? 'rgba(235, 155, 54, 0.2)' : ($row['pidviddil'] == '7' ? 'rgba(40, 160, 255, 0.2)' : ($row['pidviddil'] == '8' ? 'rgba(247, 0, 195, 0.2)' : ($row['pidviddil'] == '9' ? 'rgba(212, 44, 44, 0.4)' : '')))))).";'>
				<td>".$row['users_login']."</td>
				<td>".$empl[0]." ".$empl[1]."</td>
				<td>".$pdv."</td>
				<td>".($row['admin'] == '1' ? 'Адміністратор' : '')."</td>
				<td><i class='remove user icon del_user' data-del_user='".$row['users_login']."' title='Видалити працівника ".$empl[0]." ".$empl[1]."' style='cursor: pointer; display: ".($row['pidviddil'] == $userdata['pidviddil'] && $userdata['admin'] == '1' && $row['users_login'] != $userdata['users_login'] || $userdata['admin'] == '1' && $userdata['pidviddil'] == '0' && $row['users_login'] != $userdata['users_login'] ? '' : 'none').";'></i></td>
			</tr>");							
}
?>     
  </tbody>
  <tfoot><tr style="display: <?php echo($userdata['admin'] == '1' ? '' : 'none'); ?>;"><td colspan="4" style="text-align: center;"><i class="plus square outline icon green add_user big" data-user="<?php echo $userdata['pidviddil']; ?>" style="cursor: pointer;"></i></td></tr></tfoot>
</table><br>
<script>
$('.remove.user.icon.del_user').on('click', function(){
	var a = confirm("Дійсно бажаєте видалити працівника з бази?");
	if(a == true){
		$.ajax({
			type: "POST",
			url: "pr.php",
			data: ({
				del_user: $(this).data('del_user')
			}),		
			success: function(response){
				location.reload();
			}
		});
	}		
});
$('.plus.square.outline.icon.green.add_user.big').on('click', function(){
	var a = prompt("Введіть табельний нового працівника:");
	if(a.length > '0' && a > '0'){	
		$.ajax({
			type: "POST",
			url: "pr.php",
			data: ({
				add_user: a, pidviddil: $(this).data('user')
			}),		
			success: function(response){
				alert("Працівника додано, і встановлено пароль такий як табельний номер!");
				location.reload();
			}
		});	
	
	}else{
		alert("Працівника не додано, поле було пустим");
	}
});
</script>
 </body>
</html>