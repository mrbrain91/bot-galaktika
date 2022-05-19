<?php




include('settings.php');

include('bot_func.php');

include('menu.php');

include('UpdMsg.php');




$last_psw = last_psw($connect);

$get_user = get_user($connect, $chat_id);


if (isset($get_user)) {
	$userFullName = $get_user['userFullName'];
	$old_id = $get_user['chat_id'];
}
else{
	$old_id = 1;
}

$user_check = get_check_user($connect, $chat_id); /*USERNI BAZADAN TESHIRISH*/

$last_command = get_last_command($connect, $chat_id); /*OXIRGI XARAKATNI OLISH*/

$chek_phone = get_check_phone($connect, $chat_id);

$vars = []; /*O'ZGARUVCHULARNI YIG'ISH*/


if ($chat_id != GROUP_CHAT_ID) { /* START GROUP CHAT IDni TEKSHIRISH */

	$user = bot("getChatMember", ['chat_id' => "@Galaktika_edu", 'user_id' => $user_id]); /*Kanaldan user malumotini olish*/

	$status = $user->result->status; /*Kanaldagi user statusini olish*/

	if ($status == "member" or $status == "creator" or $status == "administrator") { /*START USERNI KANALDAN TEKSHIRISH*/

		if (!isset($last_command['step'])) {

			$last_command['step'] = 'welcome';

		}

		if ($user_check == 'is_user' or $last_command['step'] == 'registr'){ /*START USERNI REGISTRATSIYADAN TEKSHIRISH*/

			if ($last_command['step'] == 'registr' && $chek_phone == false && !empty($text)) {

				
				$reply = " 🙅 Iltimos telefon raqamni ulashing";

				$reply_markup = json_encode([
					"keyboard"=>$sendContact,
					"resize_keyboard"=>true,
					'one_time_keyboard' => false
				]);
		
				bot("sendMessage", [
					'chat_id' => $chat_id, 
					'text' => $reply, 
					'reply_markup' => $reply_markup, 
					'parse_mode' => "HTML"
				]);

				$step = 'registr';

			}

			elseif ($chek_phone == false) { /*START USERNI TELEFONI KIRITILMAGANINI TEKSHIRISH*/

			add_user_phone_number($connect, $chat_id, $phone_number); /*USERGA TELEFON RAQAMINI QOSHISH*/

			$reply = "✅ <b>".$userFullName."</b> siz muvaffaqiyatli ro'yhatdan o'tdingiz!";

			$reply_markup = json_encode([
				"keyboard"=>$menu1,
				"resize_keyboard"=>true,
				'one_time_keyboard' => false
			]);
	
			bot("sendMessage", [
				'chat_id' => $chat_id, 
				'text' => $reply, 
				'reply_markup' => $reply_markup,
				'parse_mode' => "HTML"
			]);
			

			}/*END USERNI TELEFONI KIRITILMAGANINI TEKSHIRISH*/	

			elseif ($text == '/start' or $text == 'Davom etish' or $text == "❌ Bekor qilish") {

				if (isset($last_command['vars'])) {
					$vars = unserialize($last_command['vars']);
				}

				

				$reply = "Kerakli menuni tanlang ".hex2bin('F09F94BD')."";

				$reply_markup = json_encode([
					"keyboard"=>$menu1,
					"resize_keyboard"=>true,
					'one_time_keyboard' => false
				]);
		
				bot("sendMessage", [
					'chat_id' => $chat_id, 
					'text' => $reply, 
					'reply_markup' => $reply_markup
				]);

				$step="home";	

			}

			/*TEXTLAR ORQALI TEKSHIRISH BOSHLANISHI*/

			elseif ($text == "⚡️ ONLAYN TEST ⚡️") {

				$reply = "Testni tanlang ".hex2bin('F09F94BD')."";

				$reply_markup = json_encode([
					"keyboard"=>$menu_test,
					"resize_keyboard"=>true,
					'one_time_keyboard' => false
				]);
		
				bot("sendMessage", [
					'chat_id' => $chat_id, 
					'text' => $reply, 
					'reply_markup' => $reply_markup, 
				]);
				
				$step="choose_test";

			}elseif ($text == "🔰 GALAKTIKA MAXSUS 🔰") {

							$reply = "maxsus kodni kiriting";

							bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply,]);			

							$step="enter_special_code";



			}elseif ($text == "📋 Qo'llanma") {

				bot("sendMessage", ['chat_id' => $chat_id, 'text' => "https://telegra.ph/Botdan-foydalanish-boyicha-qollanma-11-25" ]);

			}elseif ($text == "☎️ Biz bilan aloqa") {
							
				$reply = "📞<b> Telefon raqam:</b> +998977449170\n👤<b> Bot-admin:</b> @Islombekyuldashev\n📍 <b>Manzil:</b> Toshkent sh., Istiqbol 15\n🔗 <b>Web-sayt: </b>galaktikaedu.uz";	

				$file = 'https://galaxytest.xyz/contact_photo/galaxy_c.jpg';
				
				bot("sendPhoto", ['chat_id' => $chat_id, 'photo' => $file, 'caption' => $reply, 'parse_mode' => "HTML" ]);
				


			}elseif ($text == "🌏 Tilni o'zgartirish") {

				bot("sendMessage", ['chat_id' => $chat_id, 'text' => "Hozirda faqat O'zbek 🇺🇿 tili mavjud! 😊", 'parse_mode' => "HTML" ]);


			}elseif ($text == "⚙️ Ism familiyani o'zgartirish") {

							$new_userFullName = $get_user['userFullName'];

							$reply = "<b>".$new_userFullName."</b>\nIsm va familiyangizni yuboring\n(Masalan: Aliev Vali)";

							$reply_markup = json_encode(["keyboard"=>$menu_set, "resize_keyboard"=>true, 'one_time_keyboard' => true ]);
		
							bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

							$step = 'enter_name';

			}elseif ($last_command['step'] == 'enter_name') {

							$update_name = $text;

							if (get_update_userFullName($connect, $chat_id, $update_name)) {

								$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
						
								bot("sendMessage", ['chat_id' => $chat_id, 'text' => "✅ Ism familiyangiz muvaffaqiyatli o'zgardi!", 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

							 };

							 $step = 'updated_name';

			}elseif ($text == $last_psw) {
																		
							$offline_subjects = offline_subjects_all($connect);

							$reply = "Fanlardan birini tanlang";

							$reply_markup = json_encode(["keyboard"=>$offline_subjects, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
					
							bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

							$step="offline_subjects";
							
							
			}elseif ($last_command['step'] == "offline_subjects") {

								$offline_subject_name = $text;
																					
								$offline_subject = get_offline_subject($connect, $offline_subject_name);
								    
								if (isset($offline_subject)) {
								    
								    $current_time = strtotime(date('H:i:s'));

								    $time = date('H:i:s');
								    
                                    $endTime = date("H:i:s", strtotime('+30 minutes', $current_time));

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Kuting fayl yuborilmoqda....']);

									
									$reply = "<b>Fan nomi:</b> ".$offline_subject_name."\n<b>Savol soni:</b> 20 ta\n<b>Boshlanish vaqti:</b> ".$time."\n<b>Tugash vaqti </b>".$endTime."";
									
									$file = sprintf('https://galaxytest.xyz/offline_uploads/%s', $offline_subject['offline_filenames']);

									$reply_markup = json_encode(["remove_keyboard" => true]);
							
									bot("sendDocument", ['chat_id' => $chat_id, 'document' => $file, 'caption' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

									$vars = ['id'=> $offline_subject['id'], 'offline_subject_name' => $offline_subject['offline_subject_name'], 'offline_filenames' => $offline_subject['offline_filenames'], 'offline_subject_key' => $offline_subject['offline_subject_key'], 'current_time' => $current_time];

									$reply = "".hex2bin('F09F9491')." Test kalitlarini kiriting\na b c d.. yoki 1a 2b 3c 4d..ko'rinishida yuboring!";

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply]);

									$step="offline_result";

								}

								else{

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Iltimos test blokdan birini tanlang!']);

									exit();

								}
			
			}elseif ($last_command['step'] == "offline_result") {

								$last_vars = unserialize($last_command['vars']);
							
								$string = preg_replace('/\s+/', '', strtolower($text));

								$answer = preg_replace('/[^a-z]/i', '', $string);

								if (strlen($answer) == 20) {

									$last_vars = unserialize($last_command['vars']);
									
									$is_correct = false;

									$correct = 0;

									$wrong = 0;
								
									$index = 1;

									$answer_keys = $last_vars['offline_subject_key'];

									$list="";

									for ($i=0; $i < 20; $i++) {

										if(isset($answer[$i], $answer_keys[$i])) {

											if($answer_keys[$i] == $answer[$i]) {

												$list.=$index.") ".$answer_keys[$i].' '."✅" .' '.$answer[$i]."\n";

												$correct++;

												$is_correct = true;

											} else {

												$list.=$index.") ".$answer_keys[$i].' '."❌" .' '.$answer[$i]."\n";

												$wrong++;

												$is_correct = false;

											}
										} else {

											$list.=$index.") ".$answer_keys[$i].' '."❌" .' '.$answer[$i]."\n";
												
											$wrong++;

											$is_correct = false;

										}

										if($index%5 == 0) {

											$list.= "";

										}

										$index++;

									}


								$user_id = $chat_id;

								$UserName = $userFullName;

						        $offline_subject_id = $last_vars['id'];

								$offline_subject_name = $last_vars['offline_subject_name'];
								  				
								bot("sendMessage", ['chat_id' => $chat_id, 'text' => $list ]);

								$reply = sprintf("👤 Sizning natijangiz:\n\n✅ - <b>%s</b> tasi to'g'ri\n❌ - <b>%s</b> tasi noto'g'ri ", $correct, $wrong);

								$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
							
								bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);
								    
								$step = 'over_offline_test';
								
								} /*END IF COUNT STR*/
								else{


									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Siz '.strlen($answer).'ta javob kiritdingiz.  Iltimos 20 ta javob kiriting!', 'parse_mode' => "HTML" ]);
									
									$vars = unserialize($last_command['vars']);

									$step = "offline_result";

								}
				
			} 
						
		    /*ONLAYN TEST KNOPKASINI BOSGANDAN KEYINGI ALGORITMLAR*/

			elseif ($last_command['step'] == "choose_test" && $text == 'TEST-105') {
								
								$get_test_start = strtotime(get_test_start($connect, $text));

								$get_test_over = strtotime(get_test_over($connect, $text));

								$get_test_date = strtotime(get_test_date($connect, $text));

								$current_date = strtotime(date('Y-m-d'));

								$current_time = strtotime(date('H:i:s'));	
																
								if ( $current_date == $get_test_date && $current_time >= $get_test_start && $get_test_over >= $current_time) {
								
								$user_id =  $chat_id;

								$is_test_id = get_result_test_id($connect, $user_id);

									if ($is_test_id == 'isset_test') {

										$userFullName = $get_user['userFullName'];

										$reply = "<b>".$userFullName."</b>\nSiz bugungi testni ishladingiz\nKeyingi teslarimizni kuzatib boring!.";

										$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
								
										bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

									}elseif ($is_test_id == 'not_test') {

										$test_id = get_test_id($connect, $text);

										$subjects = get_subjects($connect, $test_id);


										$reply = "Fanlar to'plamini tanlang";

										$reply_markup = json_encode(["keyboard"=>$subjects, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
								
										bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);

										$vars = ['test_id' => $test_id];

										$step="subjects";

									}
		
								}

								else{

									$reply = "🤷 Hozirgi vaqtda test boshlanmadi. ";

									$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
							
									bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);
								
								}	
							
			}elseif ($last_command['step'] == "subjects") {
				
								$subject_name = $text;

								$last_vars = unserialize($last_command['vars']);

								$subject = get_subject($connect, $last_vars['test_id'], $subject_name);

								$test_id = $last_vars['test_id'];

								if (isset($subject)) {

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Kuting fayl yuborilmoqda....']);


									$reply_markup = json_encode(["remove_keyboard" => true]);

									$reply = sprintf("Jami:105 ta savol.\n %s+Majburiy blok \n\n".hex2bin('F09F9491')." Test kalitlarini quyidagicha yuboring\na b c d.. yoki 1a 2b 3c 4d..", $subject_name);

									$file = sprintf('https://galaxytest.xyz/uploads/%s', $subject['filenames']);

									bot("sendDocument", ['chat_id' => $chat_id, 'document' => $file, 'reply_markup' => $reply_markup,'caption' => $reply, 'parse_mode' => "HTML" ]);

									$vars = $subject;

									$get_test_over = strtotime(get_test_over_by_id($connect, $test_id));

									$current_time = strtotime(date('H:i:s'));	

									if ($get_test_over >= $current_time) {
	

										$step="result";

	
									}
	
									else{

										$reply = "❌ ⌛️ Afsuski test vaqti tugadi!";

										$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
								
										bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

									}




									
								}

								else{

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Iltimos test blokdan birini tanlang!']);

									exit();

								}
									
			}elseif ($last_command['step'] == "result") {

								$last_vars = unserialize($last_command['vars']);

								$test_id = $last_vars['test_id'];
									
								$get_test_over = strtotime(get_test_over_by_id($connect, $test_id));

								$current_time = strtotime(date('H:i:s'));	
									
								if ($get_test_over >= $current_time) {

								$string = preg_replace('/\s+/', '', strtolower($text));

								$answer = preg_replace('/[^a-z]/i', '', $string);
								

								if (strlen($answer) ==105) {

									$last_vars = unserialize($last_command['vars']);
									
									$is_correct = false;

									$correct = 0;

									$wrong = 0;

									$total = 0;

									$index = 1;
									
									$answer_keys = $last_vars['subject_key'];

									$list="";

									for ($i=0; $i < 105; $i++) {

										if(isset($answer[$i], $answer_keys[$i])) {

											if($answer_keys[$i] == $answer[$i]) {

												$list.=$index.") ".$answer_keys[$i].' '."✅" .' '.$answer[$i]. " __*__";

												$correct++;

												$is_correct = true;

											} else {

												$list.=$index.") ".$answer_keys[$i].' '."❌" .' '.$answer[$i]. " __*__";
												
												$wrong++;

												$is_correct = false;

											}

										} else {

											$list.=$index.") ".$answer_keys[$i].' '."❌" .' '.$answer[$i]. " __*__";
												
											$wrong++;

											$is_correct = false;

										}

										if($index%5 == 0) {

											$list.= "__t__";

										}

										if($is_correct && $i < 60) {

											$total += 3.1;

										} 
										
										elseif($is_correct && $i > 59) {

											$total += 2.1;

										}

										$index++;
									}

									$user_id = $chat_id;

									$username = $userFullName;

									$test_id = $last_vars['test_id'];

									$score =  $total;

									add_test_result($connect, $user_id, $username, $test_id, $score, $list);

									$reply = sprintf("👤 Sizning natijangiz:\n\n✅ - <b>%s</b> tasi to'g'ri\n❌ - <b>%s</b> tasi noto'g'ri\n👉 Jami balingiz - <b>%s</b> ball\nℹ️ Batafsil javoblaringiz test\ntugaganidan keyin yuboriladi", $correct, $wrong, $total);

									$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
								
									bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

									$step = "over_test";

									
								
								} /*END IF COUNT STR*/
								else{

									bot("sendMessage", ['chat_id' => $chat_id, 'text' => 'Siz '.strlen($answer).'ta javob kiritdingiz.  Iltimos 105 ta javob kiriting!', 'parse_mode' => "HTML" ]);
									
									$vars = unserialize($last_command['vars']);

									$step = "result";

								}

								

							}

							else {

									$reply = "❌ ⌛️ Afsuski test vaqti tugadi!";

									$reply_markup = json_encode(["keyboard"=>$menu1, "resize_keyboard"=>true, 'one_time_keyboard' => false ]);
							
									bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML" ]);

									$vars = unserialize($last_command['vars']);

								}

			} 
			/*ONLAYN TEST KNOPKASINI BOSGANDAN KEYINGI ALGORITMLAR TUGASHI*/	

		}/*END AGAR USER REGISTRATSIYADAN O'TGAAN BOLSA*/

		elseif ($user_check == 'not_user'){ /*START AGAR USER REGISTRATSIYADAN O'TMAGAN BOLSA*/

			if ($text == '/start' or $text == 'Davom etish') {
				


				$reply = "".hex2bin('31E283A3')." Familiya va ismingizni yuboring!\n ".hex2bin('E29C8F')." Masalan (Aliev Vali)";

				$reply_markup = json_encode(["remove_keyboard" => true]);

	
				bot("sendMessage", [
					'chat_id' => $chat_id, 
					'text' => $reply, 
					'reply_markup' => $reply_markup,
					'parse_mode' => "HTML"
				]);

				$step = 'start';

			}

			elseif ($last_command['step'] == 'start'){

				

				$userFullName = $text;

				if (is_string($text) && strlen($text)>3) {

					add_user_full_name($connect, $username, $chat_id, $name, $old_id, $userFullName);

					$reply = " ".hex2bin('E2988E')." Telefon raqamingizni ulashing";

					$reply_markup = json_encode([
						"keyboard"=>$sendContact,
						"resize_keyboard"=>true,
						'one_time_keyboard' => false
					]);
			
					bot("sendMessage", [
						'chat_id' => $chat_id, 
						'text' => $reply, 
						'reply_markup' => $reply_markup, 
						'parse_mode' => "HTML"
					]);

					$step = 'registr';

				}

				else {

					$reply = '!Faqat familiya va ismingizni kiriting';

					$reply_markup = json_encode(["remove_keyboard" => true]);

					bot("sendMessage", [
						'chat_id' => $chat_id, 
						'text' => $reply, 
						'reply_markup' => $reply_markup,
						'parse_mode' => "HTML"
					]);

					$step = 'start';

				}

			}

		}/*END AGAR USER REGISTRATSIYADAN O'TMAGAN BOLSA*/

	}/*END USERNI KANALNI TEKSHiRISH*/

	else{ /*START AGAR USER KANALGA ULANMAGAN BULSA*/

		$reply = " Botdan foydalanish uchun\n<b>KANALGA</b> obuna bo'ling!";

		$reply_markup = json_encode(["keyboard"=>$menu, "resize_keyboard"=>true, 'one_time_keyboard' => true]);

		bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup, 'parse_mode' => "HTML"]);


		$reply = "---------------------------------------";
		
		$inline_keyboard = json_encode(array("inline_keyboard" => array(array(array('text'=> 'Kanalga ulanish', 'url'=>'https://t.me/Galaktika_edu')))));

		bot("sendMessage", ['chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $inline_keyboard, 'parse_mode' => "HTML"]);

		$step = 'welcome';

	} /*END AGAR USER KANALGA ULANMAGAN BULSA*/

}	/*END GROUP CHAT IDni TEKSHIRISH*/	

if (isset($step)) {
	textlog($connect, $chat_id, $text, $step, $vars);
}








