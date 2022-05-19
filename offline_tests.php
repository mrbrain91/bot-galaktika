<?php

include('settings.php');

include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {

  header("location: index.php");

}



$offline_subjects_all = get_offline_subjects_all($connect);

if (isset($_POST['textarea'])) {
  $setKey = $_POST['textarea'];
  updateKey($connect, $setKey);
}

$last_psw = last_psw($connect);


?>

<!doctype html>

<html lang="en">

 <?php include 'partSite/header.php'; ?>

 <body>

 <main>
    
  <?php include 'partSite/leftSite.php'; ?>
 
  <div class="container" style="overflow-x: auto; ">

    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 

      <span style="margin:auto 0px auto 188px; font-size: 24px;"> Offline test</span><br>

    </div>

      <!-- <label for="exampleFormControlTextarea1">O'rnatilgan parol:</label>
      <div style="background-color: #f7f7f7; border: 2px solid #cdcdcd; border-radius: 5px; width: 100%; height: 50px; padding: 12px 12px 13px 12px;">
        <span style="font-family: Verdana, Trebuchet MS, Geneva, sans-serif; font-size: 15px; ">
           <?php echo $last_psw; ?>
        </span>
      </div> -->

      <form enctype="plain/text" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id='orderform'>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">
              O'rnatilgan parol:  <strong><?php echo $last_psw; ?></strong><br>
              Parolni o'zgartirish: Maksimal belgilar soni:10ta
            </label>
            <textarea name="textarea" class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="10" style="width: 30%; height:50px; padding-top: 11px;"></textarea>
          </div>
          <input type="submit" class="btn btn-primary" name="setKey" value="O'zgartirish">
      </form>

      <div>

        <a href="https://galaxytest.xyz/add_offline_subjects.php">

          <button class="mt-2 btn btn-success">

            Testga fan qo'shish +

          </button>

        </a>
      
      </div>

    <!-- subjects list -->

    <div class="well mt-2" style="width:100%">

    <table class="table">

      <thead>

        <tr>

          <th style="width:5%">№</th>

          <th style="width:20%">Fan nomi</th>

          <th style="width:20%">Yuklangan fayl</th>

          <th style="width:20%">Kalitlar</th>

          <!-- <th style="width:17%;">o'zgartirish</th> -->

          <th style="width:18%;">o'chirish</th>
          
        </tr>

      </thead>

      <tbody>

        <?php  

        $n = 0;

        foreach ($offline_subjects_all as $sa): 

        $n++;

        ?>
       
        <tr>

          <td><?php echo $n;?></td>

          <td><?=$sa['offline_subject_name']?></td>

          <td><?=$sa['offline_filenames']?></td>

          <td><div  style="width:436px;"><?=$sa['offline_subject_key']?></div></td>

          <!-- <td><button class="btn btn-primary"> edit </button></td> --> 

          
          <td><a href="delete.php?iddd=<?=$sa['id']?>" onclick="return confirm('ROSTDAN OCHIRMOQCHIMISIZ?')" role="button"><button class="btn btn-danger"> o'chirish</button></a>
</button></td >

        </tr>

        <?php endforeach ?>

      </tbody>

    </table>

</div>

    <!-- end subjects -->
  
</div>
   
  </main>
 
      <script src="css/bootstrap.bundle.min.js"></script>

      <script src="css/sidebars.js"></script> 

      <script src="css/bootstrap.bundle.min.js"></script>
      
      <script src="css/sidebars.js"></script>

    <!-- Optional JavaScript -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </body>

</html>


<script type="text/javascript">

$('#orderform').submit(function() {
    if($('#exampleFormControlTextarea1').val() == ''){
        alert('Iltimos parolni kiriting!');
        return false;
    }
});


</script>

