<?php

include('settings.php');
include('bot_lib.php');

// get GET id
  if(isset($_GET['id'])){  
  $get_id = $_GET['id'];  
}


?>


<!doctype html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">


    <title>offlin test qoshish</title>
  </head>
  <body>
      
     

  <main>
    
  <?php include 'partSite/leftSite.php'; ?>

        <div class="container">
        <div style="width: 100%; height: 9%; background-color: #Eaf7f2;"> 
          <span style="margin:auto 0px auto 188px; font-size: 24px;"> Offline testga fan qo'shish</span><br>
        </div>



        <div>
                <a href="offline_tests.php">
                  <button class="mt-2 btn btn-primary">
                      Orqaga qaytish
                  </button>
                </a>
      
        </div>
      
    
       <div class="card mt-5 ml-5 mr-5 mb-5">
                
            <div class="card-body">
                        
                <form action="action.php" method="POST" enctype="multipart/form-data">
<!--Select option-->
                    <div class="form-group mb-3">
                        <label>Fanni tanlang:</label>
                        <select name="offline_subject_name" class="form-control" id="exampleFormControlSelect1">
                          <option disabled>Tanlang:</option>
                          <option value='matematika'>1. Matematika</option>
                          <option value='ona tili'>2. Ona tili</option>
                          <option value="kimyo">3. Kimyo</option>
                          <option value="fizika">4. Fizika</option>
                          <option value="biologiya">5. Biologiya</option>
                          <option value="tarix">6. Tarix</option>
                          <option value="ingliz tili">7. Ingliz tili</option>
                        </select>
                    </div>
<!--upload file-->
                    <div class="form-group mb-3">
                    <label>PDF faylni yuklang:</label>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="offline_subject_file">
                    <label class="custom-file-label" for="customFile">Tanlang:</label>
                    </div>  
                    </div>
<!-- ulpoad key -->
                    <div class="form-group mb-3">
                    <label>Kalitlarni kiriting:</label>
                    <input type="text" class="form-control" placeholder="abcdef..." name="offline_subject_key">
                    </div>

                    
                    <div class="form-group mb-3">
                        <button type="submit" name="offline_save_subject" class="btn btn-primary">Save offline subject</button>
                    </div>
                </form>

            </div>
        </div>
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
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>
</html>