<?php

include('settings.php');

include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {

  header("location: index.php");

}



if(isset($_POST['save'])){

  $text_cron_message = $_POST['textarea'];  


  clear_column_issett($connect);

  update_cron_message($connect, $text_cron_message);

}

$last_msg = select_cron_mess($connect);

$count_send_msg = count_send_msg($connect);

$count_user = registredMemberCount($connect);





?>


<!doctype html>
<html lang="en">
  <?php include 'partSite/header.php'; ?>
  

  <body>
      
   

  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
    
    
        <div class="container"> 

      <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="margin:auto 0px auto 88px; font-size: 20px;">Bot foydalanuvchilariga xabar yuborish</span><br>
      

      </div>
      <label for="exampleFormControlTextarea1">Oxirgi yuborilgan xabar: <?php 


      if ($count_send_msg == $count_user) {
        echo 'Barcha foydalanuvchilarga yuborildi';
      }else{
         echo $count_send_msg .'/'. $count_user;
      }
      
      
      
      
      ?></label>
        <div style="background-color: #f7f7f7; border: 2px solid #cdcdcd; border-radius: 5px; width: 100%; height: 50px; padding: 12px 12px 13px 12px;">
        
        <span style="font-family: Verdana, Trebuchet MS, Geneva, sans-serif; font-size: 15px; ">
              <?php echo $last_msg; ?>
          </span>
      </div> 
        
          <form enctype="plain/text" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="orderform">
            <div class="form-group" style='margin-top:30px;'>
              <label for="exampleFormControlTextarea1">Yangi xabarni kiriting: maksimal belgilar soni: 100ta</label>
              <textarea name="textarea" class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="100" style="height:50px; padding-top: 11px;"></textarea>
              <div id="count">
                <span id="current_count">0</span>
                <span id="maximum_count">/ 100</span>
              </div>
            </div>
            <input type="submit" class="btn btn-primary" name="save" value="save">
          </form>


      </div>
     


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>

<script type="text/javascript">

$('#orderform').submit(function() {
    if($('#exampleFormControlTextarea1').val() == ''){
        alert('Iltimos xabar kiriting!');
        return false;
    }
});



$('textarea').keyup(function() {    
    var characterCount = $(this).val().length,
        current_count = $('#current_count'),
        maximum_count = $('#maximum_count'),
        count = $('#count');    
        current_count.text(characterCount);        
});
</script>