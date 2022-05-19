<?php

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

