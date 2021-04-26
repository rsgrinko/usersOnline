<?php
	/*
		Класс для работы с посетителями онлайн
		Роман Сергеевич Гринько
		rsgrinko@gmail.com
		https://it-stories.ru
	*/
class usersOnline {
	public $onlinetime = 0;
	private $mysqli = '';
	
	public function __construct($server, $login, $pass, $database, $onlinetime = 600){
		$this->onlinetime = $onlinetime;
		
		$db = mysqli_connect($server, $login, $pass);
		if (mysqli_connect_errno()) {
			    die('Connect failed: '.mysqli_connect_error());
		}
		
		if(!mysqli_select_db($db, $database)) {
				die('Error selected DB');
		}
		$this->mysqli = $db;
	}
	
	public function usersOnlineHandler(){
		$ltime = time()-$this->onlinetime;
		
		$query = 'SELECT * FROM rg_users_online WHERE last_active < '.$ltime;
		$res = mysqli_query($this->mysqli, $query);
		while($result = mysqli_fetch_assoc($res)){
			mysqli_query($this->mysqli, 'DELETE FROM rg_users_online WHERE ssid = "'.$result['ssid'].'"');
		}
		
		unset($query);
		unset($res);
		unset($result);
		
		$query = 'SELECT * FROM rg_users_online WHERE ssid = "'.session_id().'"';
		$res = mysqli_query($this->mysqli, $query);
		if($res->num_rows==0) {
			mysqli_query($this->mysqli, 'INSERT INTO rg_users_online(ssid, useragent, page, last_active) VALUES ("'.session_id().'", "'.$_SERVER['HTTP_USER_AGENT'].'", "'.$_SERVER['REQUEST_URI'].'", "'.time().'")');
		} else {
			$result = mysqli_fetch_assoc($res);
			mysqli_query($this->mysqli, 'UPDATE rg_users_online SET last_active = "'.time().'", page = "'.$_SERVER['REQUEST_URI'].'" WHERE ssid = "'.$result['ssid'].'"');
		}	
	}
	
	public function countOnline(){
		$query = 'SELECT * FROM rg_users_online';
		$res = mysqli_query($this->mysqli, $query);
		return $res->num_rows;
	}
}
?>