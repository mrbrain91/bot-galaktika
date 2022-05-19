<?php

include('settings.php');

include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {

  header("location: index.php");

}

$tests_all = tests_all($connect);

?>

<!doctype html>

<html lang="en">
  
  <?php include 'partSite/header.php'; ?>
  
  <body>

  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
 
  <div class="container"> 

    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 

      <span style="margin:auto 0px auto 88px; font-size: 20px;">Eslatma! Faqat bitta test qo'shish mumkin! Yangi test qo'shmoqchi bo'lsangiz eskisini o'chiring!</span><br>

    </div>

    <!-- tests list -->

    <div>

        <a href="add_test.php">

          <button class="mt-2 btn btn-success">

             Yangi test qo'shish +

          </button>

        </a>

    </div>

  <div class="well mt-2">

    <table class="table">

      <thead>

        <tr>

          <th>id</th>

          <th>Test nomi</th>

          <th>Test kuni</th>

          <th>Start time </th>

          <th>Stop time</th>

          <th>Ko'rish</th>

          <th>O'chirish</th>
          
        </tr>

      </thead>

      <tbody>

        <?php  foreach ($tests_all as $ta): ?>

         <tr>

          <td><?=$ta['id']?></td>

          <td><?=$ta['test_name']?></td>

          <td><?=$ta['test_date']?></td>

          <td><?=$ta['start_time']?></td>

          <td><?=$ta['over_time']?></td>
                  
          <td>

              <a href="subjects.php?id=<?=$ta['id']?>" role="button"><button class="btn btn-success">Testga kirish</button></a>

          </td>

          <td>

              <a href="delete.php?id=<?=$ta['id']?>" onclick="return confirm('TESTNI ROSTDAN OCHIRMOQCHIMISIZ?')" role="button"><button class="btn btn-danger">o'chirish</button></a>

          </td>
          
        </tr>

        <?php endforeach ?>

      </tbody>

    </table>

</div>

    <!-- end tests -->
  
</div>
    
</main>
 
</body>

  <?php include 'partSite/footer.php'; ?>

</html>