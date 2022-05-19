<?php  

include('settings.php');

if (!isset($_SESSION['usersname'])) {
  header("location: index.php");
}
  
$sql = "SELECT `userFullName`,`phone_number` FROM `users`";  
$setRec = mysqli_query($connect, $sql);  
$columnHeader = '';  
$columnHeader = "Ism familiyasi" . "\t" . "phone_number" . "\t";  
$setData = '';  
  while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  

header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo ucwords($columnHeader) . "\n" . $setData . "\n";  
 ?> 