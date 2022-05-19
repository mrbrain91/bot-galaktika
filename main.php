<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}


if(isset($_POST['send'])){
  $text = $_POST['text'];
  $users_all = users_all($connect);

  foreach($users_all as $p){
    $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['chat_id']."&text=".$text."&parse_mode=HTML");
  }
}

?>


<!doctype html>
<html lang="en">

  <?php include 'partSite/header.php'; ?>

  <body>
  <main>
  <?php include 'partSite/leftSite.php'; ?>
  
  <div class="container">
    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="margin:auto 0px auto 388px; font-size: 25px;">Botni aktivlashtirish</span>
    </div>
  </div>   
  </main>
  </body>

  <?php include 'partSite/footer.php'; ?>

 
</html>