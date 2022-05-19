<?php

include('settings.php');

include('bot_lib.php');

$num_rows = get_tests($connect);

if ($num_rows != 0) {

  redirect('tests.php');

}

if(isset($_POST['save_test'])){

  $test_name = $_POST['test_name'];

  $test_date = date('Y-m-d', strtotime($_POST['test_date']));

  $test_start_time = $_POST['test_start_time'];

  $test_over_time = $_POST['test_over_time'];
    
  if (add_test($connect, $test_name, $test_date, $test_start_time, $test_over_time)) {
    
    redirect("tests.php");

  }

}

?>

<!doctype html>

<html lang="en">

  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="css/sidebars.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">

    <title>Galaktika bot</title>

  </head>

  <body>
           
  <main>
    <?php include 'partSite/leftSite.php'; ?>
    
      <div class="container">

        <div>

          <a href="tests.php">

            <button class="mt-2 btn btn-primary">

              < Orqaga qaytish

            </button>

          </a>
      
        </div>
          
       <div class="card mt-5 ml-5 mr-5 mb-5">

                <div class="card-header">

                    <h4>Test sanasi va vaqtini belgilang:</h4>

                </div>

            <div class="card-body">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?> " enctype="multipart/form-data" method="POST">

                <div class="form-group mb-3"> 

                        <label>Test turi:</label>

                        <select name="test_name" class="form-control">

                          <!-- <option disabled>Tanlang:</option> -->

                          <option value='TEST-105'>TEST-105</option>

                        </select>

                     </div>
                     
                    <div class="form-group mb-3">

                        <label for="">Test sanasi</label>

                        <input type="date" name="test_date" class="form-control" />

                    </div>

                    <div class="form-group mb-3">

                        <label for="">Test boshlanishi soati</label>

                        <input value="10:00:59" type="time" name="test_start_time" class="form-control" />

                    </div>

                    <div class="form-group mb-3">

                        <label for="">Test tugashi soati</label>

                        <input value="10:00:59" type="time"  name="test_over_time" class="form-control" />

                    </div>

                    <div class="form-group mb-3">

                        <button type="submit" name="save_test" class="btn btn-primary">Save Test</button>

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
  
</html>