<?php 


include('settings.php');
include('bot_lib.php');


if(isset($_GET['id'])){  // delete test with subjects and results
  
  $test_id = $_GET['id'];  
  delete_test($connect,$test_id); 
  mysqli_query($connect,'TRUNCATE TABLE result');
  mysqli_query($connect,'TRUNCATE TABLE subjects');

  $files = glob('uploads/*'); // get all file names
  foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
    }
  }
	redirect('tests.php');
}


if(isset($_GET['idd']) && isset($_GET['ids'])){ // delete select subject with files

  $test_idd =  $_GET['idd']; 
  $subject_id = $_GET['ids'];
  $filename = select_subject($connect, $subject_id);
  delete_subject($connect,$subject_id);
  unlink("uploads/".$filename."");
  redirect('subjects.php?id='.$_GET['idd'].'');
     
}




if(isset($_GET['iddd'])){ // delete select offline_subject with files

  $offline_subject_id = $_GET['iddd'];

  $offline_filename = select_offline_subject($connect, $offline_subject_id); //select filename

  unlink("offline_uploads/".$offline_filename.""); //delete offline_subject_file
  
  delete_offline_subject($connect,$offline_subject_id); //delete offline subject

 

  redirect('offline_tests.php');
     
}











 ?>