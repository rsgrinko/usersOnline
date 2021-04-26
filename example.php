<?php
/*
    Пример подключения класса для сбора статистики
    Роман Сергеевич Гринько
    rsgrinko@gmail.com
    https://it-stories.ru
*/
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/custom/class/usersOnline.class.php';	
global $usersOnline;
$usersOnline = new usersOnline('localhost', 'db_login', 'db_pass', 'db_name', 600);
$usersOnline->usersOnlineHandler();