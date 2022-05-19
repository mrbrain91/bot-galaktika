<?php

$api = '5018273453:AAEg9PYMMiSaH3nYRSwOVNKpXs6YJM4dVdU';

define('API_KEY', $api);


//libsiz botni yozish funktsiyasi

function bot($method, $data = []){

	$url = "https://api.telegram.org/bot".API_KEY."/".$method;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

	$res = curl_exec($ch);

	if (curl_error($ch)) {

		var_dump(curl_error($ch));

	}

	else {

		return json_decode($res);

	}

}


$update = json_decode(file_get_contents('php://input'));



if (isset($update->message)) {
	$message = $update->message;
}

if (isset($message->text)) {
	$text = $message->text;
}
else{
	$text = '';
}

if (isset($message->chat->id)) {
	$chat_id = $message->chat->id;
}


if (isset($message->from->first_name)) {
	$first_name = $message->from->first_name;
}

if (isset($message->from->username)) {
	$name = $message->from->username;
}else{
	$name = '-';
}

if (isset($message->from->last_name)) {
	$last_name = $message->from->last_name;
	$username = $first_name . ' ' . $last_name;
}else{
	$username = $first_name;
}

if (isset($message->from->id)) {
	$user_id = $message->from->id;
}

if (isset($message->contact->phone_number)) {
	$phone_number = $message->contact->phone_number;
}else{
	$phone_number = NULL;
}

if (isset($update->callback_query)) {

	$data = $update->callback_query->data;

    $message_id = $update->callback_query->message->message_id;

    $chat_id_in = $update->callback_query->message->chat->id;
}



            switch($text) {
                case '/start':  
                $inline_button1 = array("text"=>"🇺🇿 O'zbek","callback_data"=>'uz');
                $inline_button2 = array("text"=>"🇷🇺 Русский","callback_data"=>'ru');
                $inline_keyboard = [[$inline_button1,$inline_button2]];
                $keyboard=array("inline_keyboard"=>$inline_keyboard);
                $replyMarkup = json_encode($keyboard); 

                bot("sendMessage", ['chat_id' => $chat_id, 'text' => "O'zingizga qulay tilni tanlang!\n--------------------------------------------\nВыберите удобный Вам язык!.", 'reply_markup' => $replyMarkup]);
                break;
            }
            switch($data){
                case 'ru':
					$inline_button1 = array("text"=>"🔰 О нас","callback_data"=>'onas');
					$inline_button2 = array("text"=>"☎️ Контакт","callback_data"=>'kontakt');
					$inline_keyboard = [[$inline_button1,$inline_button2]];
					$keyboard=array("inline_keyboard"=>$inline_keyboard);
					$replyMarkup = json_encode($keyboard); 
					bot("sendMessage", ['chat_id' => $chat_id, 'text' => "Добро пожаловать", 'reply_markup' => $replyMarkup]);
                break;
				case 'onas':
					bot("sendMessage", ['chat_id' => $chat_id_in, 'text' => "Мы ООО бест"]);
					break;
				case 'kontakt':
					bot("sendMessage", ['chat_id' => $chat_id_in, 'text' => "+998979051071"]);
					break;
                case 'uz':
                bot("sendMessage", ['chat_id' => $chat_id_in, 'text' => "Siz O'zbek tilini tanladingiz"]);
                break;
            }

?>