<?php

/********************************************************
*  Function library

********************************************************/



/*
 Function for add users to database
*/

function redirect($address){
	header("location: $address");
}
//bot

function last_psw($connect){
	$query = "SELECT special_key FROM admin_user WHERE id = 1";
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$last_psw = mysqli_fetch_assoc($result);
	$last_psw = $last_psw['special_key'];
	return $last_psw;
}


function add_user_full_name($connect, $username, $chat_id, $name, $old_id, $userFullName){
	$username = trim($username);
	$chat_id = trim($chat_id);
	$name = trim($name);
	$userFullName = trim($userFullName);


	if($chat_id == $old_id)
		return false;
	$t = "INSERT INTO users (username, chat_id, name, userFullName) VALUES ('%s', '%s', '%s', '%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $username),
						 mysqli_real_escape_string($connect, $chat_id),
						 mysqli_real_escape_string($connect, $name),
						 mysqli_real_escape_string($connect, $userFullName));
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}




//bot
function add_user_phone_number($connect, $chat_id, $phone_number){
	$sql = "UPDATE users SET phone_number = '$phone_number' WHERE chat_id='$chat_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


//bot
function get_update_userFullName($connect, $chat_id, $update_name){
	$sql = "UPDATE users SET userFullName = '$update_name' WHERE chat_id='$chat_id'";
	$result = mysqli_query($connect, $sql);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


/*
Function INSERT result
*/

//bot
function add_test_result($connect, $user_id, $username, $test_id, $score, $list){

    $user_id = trim($user_id);
    $username = trim($username);
    $test_id = trim($test_id);
    $score = trim($score);
    $answers = trim($list);
    
    
    
    $t = "INSERT INTO result (user_id, username, test_id, score, answer) VALUES ('%s', '%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $user_id),
						mysqli_real_escape_string($connect, $username),
						mysqli_real_escape_string($connect, $test_id),
						mysqli_real_escape_string($connect, $score),
						mysqli_real_escape_string($connect, $answers));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}




/*
Function INSERT SUBJECT
*/
function add_subject($connect, $get_id, $subject_name, $filenames, $subject_key){
    $test_id = trim($get_id);
    $subject_name = trim($subject_name);
    $filenames = trim($filenames);
    $subject_key = trim($subject_key);
    
    
    
    $t = "INSERT INTO subjects (test_id, subject_name, filenames, subject_key ) VALUES ('%s', '%s', '%s', '%s')";

    $query = sprintf($t, mysqli_real_escape_string($connect, $test_id),
						mysqli_real_escape_string($connect, $subject_name),
						mysqli_real_escape_string($connect, $filenames),
						mysqli_real_escape_string($connect, $subject_key));
    $result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	return true;
}


/*
 Function for get users from database
*/

// bot
function get_user($connect, $chat_id){
	$query = sprintf("SELECT * FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$get_user = mysqli_fetch_assoc($result);
	return $get_user;

}

/*
 Function for add text entered by user
*/
//bot
function textlog($connect, $chat_id, $text, $step, $vars = []) {
	$vars = serialize($vars);
	if($chat_id == '') return false;
	$t = "INSERT INTO textlog (chat_id, msg, step, vars) VALUES ('%s', '%s', '%s', '%s')";
	$query = sprintf($t, mysqli_real_escape_string($connect, $chat_id),
							mysqli_real_escape_string($connect, $text), 
							mysqli_real_escape_string($connect, $step), 
							mysqli_real_escape_string($connect, $vars));
	$result = mysqli_query($connect, $query);

	if(!$result)
		die(mysqli_error($connect));
	return true;				
}


//bot
function get_check_user($connect, $chat_id){
	$query = sprintf("SELECT phone_number FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(mysqli_num_rows($result)>=1  && !empty($row['phone_number'])){
		return 'is_user';
   }else{
  		 return 'not_user';
    }
}

//bot
function get_check_phone($connect, $chat_id){
	$query = sprintf("SELECT phone_number FROM users WHERE chat_id=%d", (int)$chat_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(empty($row['phone_number'])){
		return false;
   }else{
  		 return true;
    }
}





/**************/

//bot
function get_offline_subject($connect, $offline_subject_name){
	$query = sprintf("SELECT * FROM offline_subjects WHERE offline_subject_name='%s' limit 1", $offline_subject_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$get_offline_subject = mysqli_fetch_assoc($result);
	return $get_offline_subject;
}



//bot
function tests_all($connect){
	$query = "SELECT * FROM test";
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$n = mysqli_num_rows($result);
	$tests_all = array();
	for ($i = 0; $i <$n; $i++){
		$row = mysqli_fetch_assoc($result);
		$tests_all[] = $row;
	}
	return $tests_all;
}


//bot
function get_last_command($connect, $chat_id){
	$query = sprintf("SELECT * FROM textlog WHERE chat_id=%d order by id desc limit 1", (int)$chat_id);
	$result = mysqli_query($connect, $query);
	if(!$result)
		die(mysqli_error($connect));
	$last_data = mysqli_fetch_assoc($result);
	return $last_data;
}

//bot
function get_test_id($connect, $test_name){
	$query = sprintf("SELECT id FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['id'];
}

//bot
function get_test_date($connect, $test_name){
	$query = sprintf("SELECT test_date FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['test_date'];
}

//bot
function get_test_start($connect, $test_name){
	$query = sprintf("SELECT start_time FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['start_time'];
}




//bot
function get_test_over($connect, $test_name){
	$query = sprintf("SELECT over_time FROM test WHERE test_name='%s'limit 1", $test_name);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['over_time'];
}

//bot
function get_test_over_by_id($connect, $test_id){
	$query = sprintf("SELECT over_time FROM test WHERE id='%s'limit 1", $test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$test_data = mysqli_fetch_assoc($result);
	return $test_data['over_time'];
}

//bot
function get_subjects($connect, $test_id){
	$subjects = [];
	$query = sprintf("SELECT id, subject_name FROM subjects WHERE test_id=%d", (int)$test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	while($row = mysqli_fetch_assoc($result)) {
		$subjects[] = [$row['subject_name']];
	}
	return $subjects;
}

//bot
function offline_subjects_all($connect){
	$offline_subjects = [];
	$query = sprintf("SELECT id, offline_subject_name FROM offline_subjects");
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	while($row = mysqli_fetch_assoc($result)) {
		$offline_subjects[] = [$row['offline_subject_name']];
	}
	return $offline_subjects;
}

//bot
function get_subject($connect, $test_id, $subject_name){
	$query = sprintf("SELECT * FROM subjects WHERE subject_name='%s' and test_id=%d limit 1", $subject_name, $test_id);
	$result = mysqli_query($connect, $query);
	if(!$result) return false;
	$subject = mysqli_fetch_assoc($result);
	return $subject;
}



//bot
function get_result_test_id($connect, $user_id){
	$query = sprintf("SELECT * FROM result WHERE user_id=%d", (int)$user_id);
	$result = mysqli_query($connect, $query);

	$row = mysqli_fetch_assoc($result);


	if(mysqli_num_rows($result)>=1  && !empty($row['test_id'])){
		return 'isset_test';
   }else{
  		 return 'not_test';
    }
}



?>