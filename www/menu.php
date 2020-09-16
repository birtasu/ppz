<div style="width: 100%; position: fixed; top: 0.1%; right: 1%; z-index: 2;">
<div class="ui segment" style="background: rgba(0, 0, 0, 0.2); padding: 10px 0px; top: 10px; width: 700px; text-align: center; float: right;">	
	<button class="ui green button" style="color: rgba(255, 255, 255, 0.8); padding: 6px 13px; width: 140px;" onclick="location.href = 'blank.php'">Внесення даних</button>
	<button class="ui blue button" style="color: rgba(255, 255, 255, 0.8); padding: 6px 13px; width: 140px;" onclick="location.href = 'bd.php<?php echo($userdata['pidviddil'] > '0' ? '?p='.$userdata['pidviddil'] : ''); ?>'">База протоколів</button>
	<button class="ui orange button" style="color: rgba(255, 255, 255, 0.8); padding: 6px 13px; width: 150px;" onclick="location.href = 'users.php'">База працівників</button>
	<button class="ui purple button change_pass" style="color: rgba(255, 255, 255, 0.8); padding: 6px 13px; width: 130px;">Зміна паролю</button>	
	<button class="ui red button" style="color: rgba(255, 255, 255, 0.8); padding: 6px 13px; width: 100px;" onclick="location.href = '?exit'">Вихід</button><br>
	<div style="width: 100%; background: rgba(0, 0, 0, 0.3); position: absolute; color: #fff; bottom: 7%;"><div style="float: right; position: relative; right: 2%;">Ви залоговані як: <?php echo $g[0].' '.$g[1]; ?></div></div><br>
</div>
</div>
<script>
$('.change_pass').on('click', function(){
		var a = prompt('Введіть новий пароль');
		if(a.length > '0'){
			$.ajax({
			type: "POST",
			url: "pr.php",
			data: ({user_id: '<?php echo $userdata['users_login']; ?>', new_pass: a})
			});
			alert('Пароль змінено');
		}else{
			alert('Поле не може бути пустим');
		}
});
</script>