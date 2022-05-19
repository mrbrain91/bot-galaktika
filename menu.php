<?php

$tests_all = tests_all($connect);

$menu1 = [["⚡️ ONLAYN TEST ⚡️"],["🔰 GALAKTIKA MAXSUS 🔰"],["📋 Qo'llanma", "🌏 Tilni o'zgartirish"], ["⚙️ Ism familiyani o'zgartirish", "☎️ Biz bilan aloqa"]];
$menu2 = [["button 3","button 4"]];
$menu = [["Davom etish"]];
$menu3 = [["Davom ettirish"]];

$menu_set = [["❌ Bekor qilish"]];




$menu_test = [];
foreach ($tests_all as $ta):     
   $menu_test[] = [$ta['test_name']];
endforeach;


$sendContact = array(array(array('text'=>"Telefon raqamini ulashish", 'request_contact'=>true)));

?>