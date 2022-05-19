<?php

include('settings.php');
include('bot_lib.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}


$count = registredMemberCount($connect);


$users_all = users_all($connect);


?>





<!doctype html>
<html lang="en">
  <?php include 'partSite/header.php'; ?>

  <body>
      

     
  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
    
      
    
   <div class="container" style="overflow-x: auto;">

     <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="margin:auto 0px auto 88px; font-size: 20px;">Bot foydalanuvchilari soni: <strong><?php echo $count; ?></strong> ta</span><br>
      

      </div>
      
   <button class="btn"><i class="fa fa-download"></i><a href="https://galaxytest.xyz/export.php"> Yuklab olish</a></button>


    <!-- users list -->

    <?php
      
    $per_page_record = 10; //Number of entries to show in a page

    
    
    //Look for a GET variable page if not found default is 1.

    if(isset($_GET['page'])){
      
      $page = $_GET['page'];

    }

    else {
      
      $page = 1;

    }



    $start_from = ($page - 1) * $per_page_record;

    $query = "SELECT * FROM users ORDER by id DESC LIMIT  $start_from, $per_page_record";     

    $rs_result = mysqli_query ($connect, $query);   
    
    
    ?>


      <br>   
      <div>   
        <table class="table">   
          <thead>   
            <tr>   
              <th style="width:6%">Id</th>
              <th style="width:40%">Ismi familiyasi</th>
              <th style="width:40%">Telegram account</th>
              <th style="width:30%">Telefon raqami</th>
            </tr>   
          </thead>   
          <tbody>   
    <?php     

            $i = $count;
            while ($row = mysqli_fetch_array($rs_result)) {    
                  // Display each field of the records.    
            ?>     
            <tr>     
            <td><?php echo $row["id"]; ?></td>   
            <td><?php echo $row["userFullName"]; ?></td>   
            <td><?php echo $row["name"]; ?></td>   
            <td><?php echo $row["phone_number"]; ?></td>                                           
            </tr>     
            <?php     
                };    
            ?>     
          </tbody>   
        </table>   
  
     <div class="pagination">    
      <?php  
        $query = "SELECT COUNT(*) FROM users";     
        $rs_result = mysqli_query($connect, $query);     
        $row = mysqli_fetch_row($rs_result);     
        $total_records = $row[0];     
          
    echo "</br>";     
        // Number of pages required.   
        $total_pages = ceil($total_records / $per_page_record);     
        $pagLink = "";       
      
        if($page>=2){   
            echo "<a href='users.php?page=".($page-1)."'>  Prev </a>";   
        }       
                   
        for ($i=1; $i<=$total_pages; $i++) {   
          if ($i == $page) {   
              $pagLink .= "<a class = 'active' href='users.php?page="  
                                                .$i."'>".$i." </a>";   
          }               
          else  {   
              $pagLink .= "<a href='users.php?page=".$i."'>   
                                                ".$i." </a>";     
          }   
        };     
        echo $pagLink;   
  
        if($page<$total_pages){   
            echo "<a href='users.php?page=".($page+1)."'>  Next </a>";   
        }   
  
      ?>    
        



   <!-- end users list -->
  
    
</div>


    
  </main>

  </body>
  <?php include 'partSite/footer.php'; ?>

</html>


