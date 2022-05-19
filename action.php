<?php
include('settings.php');
include('bot_lib.php');

if(isset($_POST['save_subject']) && isset($_GET['id'])){  
 
  $subject_name = $_POST['subject_name'];
  
  if (get_subject_for_add($connect, $subject_name) == FALSE) {
              
    if(strlen($_POST['subject_key']) == 105){
        
    $get_id = $_GET['id'];
        
    $key_post = $_POST['subject_key'];

    $subject_key = strtolower($key_post);

    $genRanStr = genRanStr();  

    $filenames = $genRanStr.'-'.basename($_FILES["subject_file"]["name"]);

    $target_dir = "uploads/";

    $target_file = $target_dir . $genRanStr.'-'.basename($_FILES["subject_file"]["name"]);

    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    //get function add_subject
    $add_subject = add_subject($connect, $get_id, $subject_name, $filenames, $subject_key);




    // Check file size


    // Allow certain file formats
    if($imageFileType != "pdf") {
      echo "Sorry, only pdf files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["subject_file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["subject_file"]["name"])). " has been uploaded.";
        redirect("subjects.php?id=$get_id");
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    }
   else{
    echo "<center><h2>Siz <b>".strlen($_POST['subject_key'])."</b> ta kalit kiritdingiz. Iltimos <b>105</b> ta javob kiriting! </h2></center>";

  }
}

  else{
    echo "<center><h2>Siz ushbu to'plamni kiritgansiz</h2></center>";

  }
    
}



/*Offline test qoshish*/




if(isset($_POST['offline_save_subject'])){ 
  
    $offline_subject_name = $_POST['offline_subject_name'];
  
    if(get_subject_for_add_off($connect, $offline_subject_name) == FALSE){
    
        
    if(strlen($_POST['offline_subject_key']) == 20){
        
    
    
    
    $offline_key_post = $_POST['offline_subject_key'];
    $offline_subject_key = strtolower($offline_key_post);
    $genRanStr = genRanStr(); 
    $offline_filenames = $genRanStr.'-'.basename($_FILES["offline_subject_file"]["name"]);
    $target_dir = "offline_uploads/";
    $target_file = $target_dir . $genRanStr.'-'. basename($_FILES["offline_subject_file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    //get function add_subject
    $add_offline_subject = offline_add_subject($connect, $offline_subject_name, $offline_filenames, $offline_subject_key);




    // Check file size


    // Allow certain file formats
    if($imageFileType != "pdf") {
      echo "Sorry, only pdf files are allowed.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["offline_subject_file"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["offline_subject_file"]["name"])). " has been uploaded.";
        redirect("offline_tests.php");
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
    }
   else{
  echo "<center><h2>Siz <b>".strlen($_POST['offline_subject_key'])."</b> ta kalit kiritdingiz. Iltimos <b>20</b> ta javob kiriting! </h2></center>";
}  

}

else{
  echo "<center><h2>Siz ushbu to'plamni kiritgansiz</h2></center>";

}


 
    
}






?>