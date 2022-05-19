<?php

include('settings.php');

include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {

  header("location: index.php");

}
		$tests_all = tests_all($connect);

		$result_all = get_result_all_by($connect);
		
		$myfile = fopen("result.txt", "w") or die("Unable to open file!");

		$n = 0;	

    foreach ($result_all as $i => $k) {

      $n++;

	    $txt =  $n.') '.$k['username'].' ---- '.$k['score']."\n";

	    fwrite($myfile, $txt); 
      
	    }

	    fclose($myfile);

?>



<!doctype html>

<html lang="en">
  
  <?php include 'partSite/header.php'; ?>
  
  <body>

  <main>
    
  <?php include 'partSite/leftSite.php'; ?>

  <div class="container">

      <div style="width: 100%; height: 9%; background-color: #Eaf7f2;">

      <span style="margin:auto 0px auto 88px; font-size: 20px;">Test natijalari!</span><br>

    	</div>

    <div class="well mt-2">

    <table class="table">

      <thead>

        <tr>

          <th>Test nomi</th>

          <th>Test sanasi</th>

          <th>Tugash vaqti</th>

          <th>Natijanlarni yuklash</th>

          <th>Natijalarni yuborish</th>
     
        </tr>

      </thead>

      <tbody>

        <?php  foreach ($tests_all as $ta): ?>

         <tr>

          <td><?=$ta['test_name']?></td>

          <td><?=$ta['test_date']?></td>

          <td><?=$ta['over_time']?></td>
                  	
          <td>

              <a href="https://galaxytest.xyz/result.txt" download role="button"><button class="btn btn-success">Yuklash</button></a>

          </td>

          <td>

          <?php 

          if (isset($_GET['send'])) {

          $result_all =  get_result_all($connect);

            foreach($result_all as $p){
                      
              $answer = str_replace("__*__", "\n", $p['answer']);
                  
              $answer = str_replace("__t__", "", $answer);

              $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['user_id']."&text=". urlencode(mb_substr($answer, 0, 3500)) ."&parse_mode=HTML");
            }

  		    	redirect('result_test.php');
          		
          }
     


          ?>			


           <a href="result_test.php?send=ok" onclick="return confirm('Foydalanuvchilarga batafsil test javoblarini yubormoqchimisiz?')" role="button"><button class="btn btn-primary">Yuborish</button></a>
          </td>


        </tr>

        <?php endforeach ?>

      </tbody>

    </table>

</div>

</div>  	
  </main>
   
  </body>

  <?php include 'partSite/footer.php'; ?>

</html>