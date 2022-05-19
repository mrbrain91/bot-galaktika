<?php

include('settings.php');
include('bot_lib.php');

                    

// get GET id
if(isset($_GET['id'])){  
  $get_id = $_GET['id'];  
}



//get function get_users

$subjects_all = subjects_all($connect,$get_id);
// print_r($subjects_all);
// exit();

?>


<!doctype html>
<html lang="en">
 <?php include 'partSite/header.php'; ?>


  <body>
      
     

  <main>
    
  <?php include 'partSite/leftSite.php'; ?>
 
    
    

    <div class="container" style="overflow-x: auto; ">

    

    
    <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
      <span style="margin:auto 0px auto 188px; font-size: 24px;"> Test to'plamlari bo'limi</span><br>
      <!-- <span style="margin:auto 0px auto 388px; color: red;"><?php  $text; ?></span> -->

    </div>


    <!-- tests list -->



            <div>
                <a href="tests.php">
                  <button class="mt-2 btn btn-primary">
                      < Orqaga qaytish
                  </button>
                </a>
      
            </div>

            <div>
                <a href="https://galaxytest.xyz/add_subjects.php?id=<?php echo $get_id;?>">
                  <button class="mt-2 btn btn-success">
                       Testga to'plam qo'shish +
                  </button>
                </a>
      
            </div>

    <!-- subjects list -->

    <div class="well mt-2" style="width:100%">
    <table class="table">
      <thead>
        <tr>
          <th style="width:5%">№</th>
          <th style="width:20%">To'plam nomi</th>
          <th style="width:20%">To'plam fayli</th>
          <th style="width:40%">To'plam kaliti</th>
          <th style="padding-left: 80px; width:15%;">O'chirish</th>
        </tr>
      </thead>
      <tbody>
        <?php  
        $n = 0;
        foreach ($subjects_all as $sa): 
        $n++;
        ?>

               

              



         <tr>
          <td><?php echo $n;?></td>
          <td><?=$sa['subject_name']?></td>
          <td><?=$sa['filenames']?></td>
          <td><div  style="width:436px;"><?=$sa['subject_key']?></div></td>
          <td style="
          padding-top: 24px;
          padding-left: auto;
          padding-left: 80px;
          ">
            
              <a href="delete.php?idd=<?php echo $get_id?>&&ids=<?=$sa['id']?>" onclick="return confirm('ROSTDAN OCHIRMOQCHIMISIZ?')" role="button"><button class="btn btn-danger"> o'chirish</button></a>
           
          </td >
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