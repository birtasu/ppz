<?php
include 'conf.php';
include 'config.php';
include 'menu.php';

if (isset($_COOKIE['id'])) 
{    
    $userdata = mysqli_fetch_assoc($connection->query("SELECT a.* FROM `PPZ_users` a WHERE a.users_id = '".intval($_COOKIE['id'])."' LIMIT 1"));
    $g = explode(' ', $userdata['users_login']);
     if(($userdata['users_id'] !== $_COOKIE['id'])) 
        {
            setcookie('id', '', time() - 60*24*30*12, '/');
            setcookie('errors', '1', time() + 60*24*30*12, '/');
            echo "<script>window.location.href='index.php';</script>";
            exit;
        }
}else{
  //setcookie('errors', '2', time() + 60*24*30*12, '/');
  //echo "<script>window.location.href='index.php';</script>"; exit();
}

if (isset($_GET['exit']))
{
     setcookie('id', '', time() - 30);
     echo "<script>window.location.href='index.php';</script>"; exit();
}
?>
<!DOCTYPE HTML PUBLIC>
<html>
 <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Протокол передачі зміни</title>	
 </head>
 <style>
     body {
         background: url(styles/bg.jpg) repeat!important;
     }
 .rrr{
	 display: none;
	 width: 250px;
 }
 .ui.selection.dropdown{
	 min-width: 300px;
 }
[hidden] { display: none; }
 </style>
 <body>	
	<script type="text/javascript">
		var d = document;
		var last_id = 1;
		function add_value_f() {
			last_id = last_id + 1;			
			$('#v_table tbody tr:last').after('<tr><td>'+last_id+'</td><td class="rrr"><select class="ui dropdown" name="instrument_'+last_id+'" id="instrument_'+last_id+'"><option></option><option value="Шуруповерт Bosch<?php echo ($userdata['pidviddil'] == '8' ? ' та Metabo' : ''); ?>">Шуруповерт Bosch<?php echo ($userdata['pidviddil'] == '8' ? ' та Metabo' : ''); ?></option><option value="Мобільний телефон">Мобільний телефон</option><?php echo ($userdata['pidviddil'] != '8' ? '<option value="Паяльник">Паяльник</option>' : ''); ?><option value="Фотоапарат">Фотоапарат</option><option value="Печатка">Печатка</option></select></td><td><input type="text" name="tema_'+last_id+'" id="tema_'+last_id+'" autocomplete="off"></td></tr>'); 	
			if($('#pidviddil').val() == '2'){
				$('.rrr').show();			
			}else if($('#pidviddil').val() == '5' || $('#pidviddil').val() == '6' || $('#pidviddil').val() == '7' || $('#pidviddil').val() == '8' || $('#pidviddil').val() == '9'){
				$('.rrr').show();
			}else{
				$('.rrr').hide();		
			}
			$('.ui.dropdown')
			  .dropdown()
			;
		}
	
	</script>	
	
	
<div style="width: 100%; position: relative; top: 7%;">
<div style="width: 100%; text-align: center; font-size: 25px; font-weight: bold; padding: 25 0;">Заповнення протоколу передачі зміни</div>
<div style="background: rgba(0, 0, 0, 0.2); width: 80%; margin: auto; padding: 20 20;">
<form class="ui form" method="POST" id="formx" name="myForm" action="javascript:void(null);">		
<div class="ui form" style="margin: auto; width: 100%;">
<div class="three fields">
<div class="field">
<select class="ui dropdown" name="pidviddil" id="pidviddil" style="width: 350px;">
  <option value="">Оберіть підвідділ:</option>
  <option value="1" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '1' ? 'selected' : 'disabled') : ''); ?>>Нарізання проводів</option>
  <option value="3" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '3' ? 'selected' : 'disabled') : ''); ?>>Напівфабрикати</option>
  <option value="4" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '4' ? 'selected' : 'disabled') : ''); ?>>Монтаж кабельних мереж</option>
  <option value="2" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '2' ? 'selected' : 'disabled') : ''); ?>>Стендовe проектування TER</option>
  <option value="5" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '5' ? 'selected' : 'disabled') : ''); ?>>Стендовe проектування CHO</option>
  <option value="8" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '8' ? 'selected' : 'disabled') : ''); ?>>Стендовe проектування CHE</option>
  <option value="7" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '7' ? 'selected' : 'disabled') : ''); ?>>Тестувальні системи TER</option>
  <option value="6" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '6' ? 'selected' : 'disabled') : ''); ?>>Тестувальні системи CHO</option>  
  <option value="9" <?php echo($userdata['pidviddil'] > '0' ? ($userdata['pidviddil'] == '9' ? 'selected' : 'disabled') : ''); ?>>Тестувальні системи CHE</option>
</select>
</div>
<div class="field">
<select class="ui dropdown" name="zmina" id="zmina">
  <option value="">Оберіть зміну:</option>
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
</select>
</div>
<div class="field">
<input type="date" name="date" id="date" value="<?php echo date('Y-m-d'); ?>" required>  
</div>
	
</div> 
</div>

<input type="hidden" name="tab" id="tab" value="<?php echo $userdata['users_login']; ?>"> 

<table class="ui table" style="width: 100%; margin: auto; text-align: center;" id="v_table">
  <thead>
  <tr>
	<th>№</th>
	<th class="rrr" style="display: none;">Інструмент</th> 
    <th>Тема, зголошена проблема</th>	
  </tr></thead>
  <tbody>
    <tr>
      <td>1</td>
	  <td class="rrr">
		<select class="ui dropdown" name="instrument_1" id="instrument_1">
			<option></option>
			<option value="Шуруповерт Bosch<?php echo ($userdata['pidviddil'] == '8' ? ' та Metabo' : ''); ?>">Шуруповерт Bosch<?php echo ($userdata['pidviddil'] == '8' ? ' та Metabo' : ''); ?></option>
			<option value="Мобільний телефон">Мобільний телефон</option>
			<?php echo ($userdata['pidviddil'] != '8' ? '<option value="Паяльник">Паяльник</option>' : ''); ?>
			<option value="Фотоапарат">Фотоапарат</option>
			<option value="Печатка">Печатка</option>
		</select>
	  </td>	  
      <td><div class="field"><div class="ui input" style="width: 100%;"><input type="text" name="tema_1" id="tema_1" autocomplete="off"></div></div></td>	 
    </tr>    
  </tbody>
  <tfoot>
	<tr><td id="add_rows" colspan="2"><button class="ui green button" onclick="add_value_f()">+</button></td></tr>
  </tfoot>
</table>

<center><br /><button class="ui primary submit button" id="button" name="button" onclick="call()">Відправити</button>
</form>
</div>
</div>
<div class="ui red message hidden" style="text-align: center;">Протокол не збережено, перевірте всі поля</div>
<div class="ui green message hidden" style="text-align: center;">Протокол збережено</div>
	<script>
function call() {
	$('.ui.form')
		.form({
			fields: {
			pidviddil: 'empty',
			zmina: 'empty',
			date: 'empty'
			}
		})
	;
	if($('#formx').form('is valid')){
		var msg = $('#formx').serialize();
		$.ajax({
		type: "POST",
		url: "add.php",
		data: msg,
		dataType: "json",
		success: function(response){
		if (response.status == 'nOK'){
			setTimeout(function(){$("div.ui.red.message").transition('fly down').removeClass("hidden");}, 10);
			setTimeout(function(){$("div.ui.red.message").transition('fly down').addClass("hidden");}, 3000);
			}
		if (response.status == 'OK'){
			setTimeout(function(){$("div.ui.green.message").transition('fly down').removeClass("hidden");}, 10);
			setTimeout(function(){$("div.ui.green.message").transition('fly down').addClass("hidden");}, 3000);
			setTimeout(function(){location.reload();}, 3500);
			}
		},
		error:  function(xhr, str){
		alert('Виникла помилка: ' + xhr.responseCode);
		}
		});

	};
};		
	</script>
	<script>
	$('.ui.dropdown')
	  .dropdown()
	;
	$('#pidviddil').on('change', function(){
		if($('#pidviddil').val() == '2' || $('#pidviddil').val() == '5' || $('#pidviddil').val() == '8'){
			$('.rrr').show();
			$('#add_rows').attr('colspan', 3);				
		}else if($('#pidviddil').val() == '6' || $('#pidviddil').val() == '7' || $('#pidviddil').val() == '9'){
			$('.rrr').show();
			$('#add_rows').attr('colspan', 3);
		}else{
			$('.rrr').hide();
			$('.rrr select').val('');
			$('#add_rows').attr('colspan', 2);
		}
	});
	
	window.onload = function() {
		if($('#pidviddil').val() == '2' || $('#pidviddil').val() == '5' || $('#pidviddil').val() == '8'){
				$('.rrr').show();
				$('#add_rows').attr('colspan', 3);				
			}else if($('#pidviddil').val() == '6' || $('#pidviddil').val() == '7' || $('#pidviddil').val() == '9'){
				$('.rrr').show();
				$('#add_rows').attr('colspan', 3);
			}else{
				$('.rrr').hide();
				$('.rrr select').val('');
				$('#add_rows').attr('colspan', 2);
			}
	};
	</script>	
 </body>
</html>