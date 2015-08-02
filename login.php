<?php 
	require('tools.php');
	sec_session_start();
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
		$user = $mysqli->real_escape_string($_POST['username']);
		$pass = $mysqli->real_escape_string($_POST['password']);
		if (login($user, $pass, $mysqli)) {
			header('Location: home.php') ;
		} else {
			header('Location: ./index.php?error=1') ;
		}
	}
	
	function login($email, $password, $mysqli) {
		if ($stmt = $mysqli->prepare("SELECT `id`, `username`, `password` FROM `web_user` WHERE `username` = ? LIMIT 1")) { 
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($uid, $username, $db_password);
			$stmt->fetch();
			$password = hash('md5', $password);
			if($stmt->num_rows == 1) {
				if($db_password == $password) {
				   $ip_address = $_SERVER['REMOTE_ADDR']; 
				   $user_browser = $_SERVER['HTTP_USER_AGENT']; 
				   $_SESSION['user_id'] = $uid; 
				   $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
				   $_SESSION['username'] = $username;
				   $_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser);
				   return true;
				}
			}
		}
		return false;
   }
?>