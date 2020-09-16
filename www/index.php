<?php
   $_POST['login'] = ltrim($_POST['login'],'0');


  if (isset($_COOKIE['errors'])){
      $errors = $_COOKIE['errors'];
      setcookie('errors', '', time() - 60*24*30*12, '/');
  }


  include 'conf.php';

  if(isset($_POST['submit']))
  {


    $data = mysqli_fetch_assoc($connection->query("SELECT users_id, users_password FROM `PPZ_users` WHERE `users_login`='".$connection->real_escape_string($_POST['login'])."' LIMIT 1"));

    if($data['users_password'] === ($_POST['password']))
    {
        setcookie("id", $data['users_id'], time()+60*60*24*30);
      	echo "<script>window.location.href='blank.php';</script>";
		exit;
    }
    else
    {
      print("<table id='tab1'>");
      print "<tr><th>Ви ввели неправельний табельний або пароль</th></tr><br>";
      print("</table>");
    }
  }
?>
<style>
    body {
        background: url(styles/bg.jpg) repeat!important;
    }
    .inp {
        width: 220px;
        font-size: 17px;
        padding: 6px 0 4px 10px;
        border: 1.5px solid #cecece;
        background: #F6F6f6;
        border-radius: 5px;
        outline:none;
    }
    .inp:focus {
        border: 1.7px solid #9F9E9E;
    }
    .mail:hover {
        color: #000;
    }
    .index {
        position: relative;
        width: 355px;
        height: 250px;
        margin: 0 auto;
        top: 200px;
        padding: 0px 30px;
        text-align: center;
        border: 1px solid #000;
    }
    #tab1 {
        margin: auto;
        position: relative;
        top: 200px;
    }
</style>
        <div class="index">
            <form method="POST">
              <table cellpadding="10" style="text-align: center;">
                  <tr><td><b>Введіть табельний і пароль, та нажміть на "Увійти"</b></td></tr>
                  <tr><td><input type="text" class="inp" name="login" placeholder="Табельний:" style="height: 25px; width: 90%;" autocomplete="off"></td></tr>
                  <tr><td><input type="password" class="inp" name="password" placeholder="Пароль:" style="height:25px; width: 90%;"></td></tr>
                  <tr><td><input name="submit"  class="btn" type="submit" value="Увійти" style="height:35px; width: 90%;"></td></tr>
              </table>
            </form><br /><br />
         </div>