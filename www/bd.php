<?php
header('Content-type: text/html; charset=UTF-8');
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
	<title>Протокол передачі зміни BD</title>	
 </head>
 <body>
 <style>
body {
	background: url(styles/bg.jpg) repeat!important;
}
 .col {
	 border: 1px solid #000;
 }
 .col:hover {
	 cursor: pointer;	
	 transition: 0.5s;
	 background: rgba(0, 0, 0, 0.2);
 }
 .parent {
	 cursor: pointer;	 
 }

.ui.table tr.active, .ui.selectable.table tr.active:hover {
	 background: rgba(119, 202, 25, 0.2)!important;
 }
 </style>
<?php
if (!empty($_GET['p'])){
?>
<div style="width: 100%; position: relative; top: 5%;">
<div style="width: 100%; text-align: center; font-size: 25px; font-weight: bold; padding: 25 0;">Протокол передачі зміни</div> 		
<div style="width: 100%; text-align: center; font-size: 15px; font-weight: bold;">
<?php echo($_GET['p'] == 1 ? 'Нарізання проводів' : ($_GET['p'] == 2 ? 'Стендове проектування TER' : ($_GET['p'] == 5 ? 'Стендове проектування CHO' : ($_GET['p'] == 3 ? 'Напівфабрикати' : ($_GET['p'] == 4 ? 'Монтаж кабельних мереж' : ($_GET['p'] == 6 ? 'Тестувальні системи CHO' : ($_GET['p'] == 7 ? 'Тестувальні системи TER' : ($_GET['p'] == 8 ? 'Стендове проектування CHE' : ($_GET['p'] == 9 ? 'Тестувальні системи CHE' : ''))))))))); ?></div>
		<div class="ui segment" style="top: 20px; width: 70%; margin: auto;">
			<table id="table" class="ui selectable small compact table">
				<thead>
					<tr>
						<th style="display: none;">Id</th>
						<th>Дата</th>
						<th>Зміна</th>
						<th>Передав</th>
						<th>Прийняв</th>
						<th></th>						
					</tr>
				</thead>
				<tbody>
					<?php

						$result = $connection->query("select * from `Preproduction`.`PPZ` WHERE pidviddil = '".$_GET['p']."' ORDER BY `id` DESC");
						while ($row = mysqli_fetch_assoc($result)) {							
							print ("<tr data-my_id='".$row['my_id']."' data-p='".$_GET['p']."'>
										<td style='display: none;' class='parent'>".$row['id']."</td>
										<td class='parent'>".date("d.m.Y", strtotime($row['date']))."</td>
										<td class='parent'>".$row['zmina']."</td>
										<td class='parent'>".$row['tab']."</td>
										<td ".($row['tab_2'] > '0' ? 'class="parent"' : '').">".($row['tab_2'] < '0' ? '<button data-my_id="'.$row['my_id'].'" data-p="'.$_GET['p'].'" data-tab_2="'.$userdata['users_login'].'" class="ui black basic button confirm" style="color: #000; padding: 5 10;">Прийняти</button>' : $row['tab_2'])."</td>
										<td><i class='remove red icon' style='float: right; cursor: pointer; display: ".($row['tab'] == $userdata['users_login'] ? '' : 'none').";' data-del='".$row['my_id']."'></i></td>
									</tr>");							
						}
					?>
				</tbody>
			</table>
		</div>
</div>
<script>
$(document).ready(function() {
	$('#example').DataTable();
	$('body').on('click', '.parent', function(){
	
		parent = $(this).closest('tr');		
		if (parent.hasClass('active')) {						
			parent.removeClass('active');						
			parent.next().remove();						
		} else {
			$.ajax({
				url: './lm_ld.php',
				data: {
					my_id: parent.data('my_id'),
					p: parent.data('p')
				}
			}).done(function(response) {							
				$('<tr class="details"><td colspan="4">' + response + '</td></tr>').insertAfter(parent);							
				parent.addClass('active');
			});
		}
	});
});
</script>	
<script>
$('#table').DataTable({
"order": [[ 0, "desc" ]],
"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]]
});
$('.ui.black.basic.button.confirm').on('click', function(){
	$.ajax({
	type: "POST",
	url: "pr.php",
	data: ({my_id: $(this).data('my_id'), tab_2: $(this).data('tab_2'), p: $(this).data('p')})
	});
	location.reload();
});
</script>

<?php
}else{
?>

<div class="ui three column very relaxed grid" style="width: 80%; margin: auto; text-align: center; position: relative; top: 200px;">  
  
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=2'">
    <p><h2>Стендове проектування TER</h2></p>    
  </div>  
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=5'">
    <p><h2>Стендове проектування CHO</h2></p>    
  </div>
   <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=8'">
    <p><h2>Стендове проектування CHE</h2></p>    
  </div>
  
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=4'">
    <p><h2>Монтаж кабельних мереж</h2></p>    
  </div>
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=1'">
    <p><h2>Нарізання проводів</h2></p>    
  </div>
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=3'">
    <p><h2>Напівфабрикати</h2></p>    
  </div>
  
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=7'">
    <p><h2>Тестувальні системи TER</h2></p>    
  </div>
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=6'">
    <p><h2>Тестувальні системи CHO</h2></p>    
  </div>
  <div class="column col" style="padding: 40px;" onclick="return location.href = '?p=9'">
    <p><h2>Тестувальні системи CHE</h2></p>    
  </div>
</div>

<?php 
}
?>
<script>
$('.remove.red.icon').on('click', function(){
	var a = confirm('Ви дійсно бажаєте видалити цей запис?');
	if(a == true){
		$.ajax({
		type: "POST",
		url: "pr.php",
		data: ({del: $(this).data('del')})
		});
		location.reload();		
	}
});
</script>
 </body>
</html>