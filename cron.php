<?php 
    
include('settings.php');

include('bot_lib.php');


$users_all_for_res = users_all_for_res($connect); //get user without isset yes

if($users_all_for_res != 0){


  $current_date_cron = strtotime(date('Y-m-d'));

  $get_test_date_cron = strtotime(get_test_date_cron($connect));

  $current_time_cron = strtotime(date('H:i:s'));	
    
  $get_test_over_cron = strtotime(get_test_over_for_cron($connect));   

  if ($current_date_cron == $get_test_date_cron && $current_time_cron >= $get_test_over_cron) {

    
    //record result result.txt  
    
    $result_all = get_result_all_by($connect);

    $myfile = fopen("../var/www/www-root/data/www/galaxytest.xyz/score/result.txt", "w") or die("Unable to open file!");
   
    $n = 0;	
    foreach ($result_all as $i => $k) {
      $n++;
      $txt =  $n.') '.$k['username'].' ---- '.$k['score']."\n";
      fwrite($myfile, $txt); 
      }
      fclose($myfile);   

    //create new archive file  

    $genRanStr = genRanStr();  
      
    $zip = new ZipArchive;
    if ($zip->open('../var/www/www-root/data/www/galaxytest.xyz/score/'.$genRanStr.'.zip', ZipArchive::CREATE) === TRUE)
    {
        $zip->addFile('../var/www/www-root/data/www/galaxytest.xyz/score/result.txt', 'result.txt');
     
        $zip->close();
    }
    
    //send zip file ti admin

    $doc = 'https://galaxytest.xyz/score/'.$genRanStr.'.zip'; 

    $caption =  date('Y-m-d').' sanadagi natijalar';

    bot("sendDocument", ['chat_id' => '164867398', 'document' => $doc, 'caption' => $caption]);

    //send result to users

      foreach($users_all_for_res as $p){

        $id = $p['id'];

        $update_mailed_res = update_mailed_res($connect, $id);
              
        $answer = str_replace("__*__", "\n", $p['answer']);
            
        $answer = str_replace("__t__", "", $answer);
      
        $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['user_id']."&text=". urlencode(mb_substr($answer, 0, 3500)) ."&parse_mode=HTML");
    }

  }
}
// end


// sending message to users

$get_last_id = get_last_id($connect);

$start_mes_idd =  select_cron_mess_idd($connect); // cron messagedagi idd olayapti

if($start_mes_idd == 0){
  
  $update_msg_last_id = update_msg_last_id($connect, $get_last_id);
 
}

$mes = select_cron_mess($connect); // bu yerda message olinayapti

$second_mes_idd =  select_cron_mess_idd($connect); // cron messagedagi xabarni olayapti

$users_all_for_mail = users_all_for_mail($connect); 
  
foreach($users_all_for_mail as $p){

  if($p['id'] > $second_mes_idd) break;

  $id = $p['id'];

  $update_mailed = update_mailed($connect, $id);

  $url = file_get_contents("https://api.telegram.org/bot".$api."/sendMessage?chat_id=".$p['chat_id']."&text=".$mes."&parse_mode=HTML");

}
//  end
?>

