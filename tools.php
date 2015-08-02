<?php
	include('config.php');
	
	function sec_session_start() {
        $session_name = 's_sid';
        $secure = false;
        $httponly = true; 
        ini_set('session.use_only_cookies', 1); 
        $cookieParams = session_get_cookie_params(); 
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name);
        session_start();
        session_regenerate_id(true); 
	}
	
	function getPageName() {
		return strstr(basename($_SERVER['PHP_SELF'], '.php'), "-", true );
	}
	
	function alertMessage($message) {
		echo "<script type='text/javascript'>alert('$message');history.back();</script>";
	}
	
	function redirectMessage($message, $redirect) {
		echo "<script type='text/javascript'>alert('$message');window.location.href='$redirect';</script>";
	}
	
	function login_check($mysqli) {
		if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
			$user_id = $mysqli->real_escape_string($_SESSION['user_id']);
			$login_string = $_SESSION['login_string'];
			$username = $mysqli->real_escape_string($_SESSION['username']);
			$ip_address = $_SERVER['REMOTE_ADDR']; 
			$user_browser = $_SERVER['HTTP_USER_AGENT'];
			if ($stmt = $mysqli->prepare("SELECT `password` FROM `web_user` WHERE `id` = ? LIMIT 1")) { 
				$stmt->bind_param('i', $user_id);
				$stmt->execute();
				$stmt->store_result();
				if($stmt->num_rows == 1) {
					$stmt->bind_result($password);
					$stmt->fetch();
					$login_check = hash('sha512', $password.$ip_address.$user_browser);
					if($login_check == $login_string) {
						return true;
					}
				}
			}
		}
		return false;
	}
	
	function isValidSingleImage($field) {
		$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "GIF", "PNG");
		$errors = array();
		$file_name = $_FILES[$field]['name'];
		$file_size = $_FILES[$field]['size'];
		$file_tmp  = $_FILES[$field]['tmp_name'];
		$file_type = $_FILES[$field]['type'];	
		$temp = explode(".", $file_name);
		$extension = end($temp);
		if ((($file_type == "image/gif")
			|| ($file_type == "image/jpeg")
			|| ($file_type == "image/jpg")
			|| ($file_type == "image/pjpeg")
			|| ($file_type == "image/x-png")
			|| ($file_type == "image/png"))
			&& in_array($extension, $allowedExts)) {
		} else {
			$errors[] = "Unsupported file extension $extension. Supported formats : .gif/.jpg/.png";
		}
		return $errors;
	}
	
	function isValidImage($field) {
		$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG", "GIF", "PNG");
		$errors = array();
		foreach($_FILES[$field]['tmp_name'] as $key => $tmp_name ) {
			$file_name = $_FILES[$field]['name'][$key];
			$file_size = $_FILES[$field]['size'][$key];
			$file_tmp  = $_FILES[$field]['tmp_name'][$key];
			$file_type = $_FILES[$field]['type'][$key];	
			$temp = explode(".", $file_name);
			$extension = end($temp);
			if ((($file_type == "image/gif")
				|| ($file_type == "image/jpeg")
				|| ($file_type == "image/jpg")
				|| ($file_type == "image/pjpeg")
				|| ($file_type == "image/x-png")
				|| ($file_type == "image/png"))
				&& in_array($extension, $allowedExts)) {
			} else {
				$errors[] = "Unsupported file extension $extension. Supported formats : .gif/.jpg/.png";
			}
		}
		return $errors;
	}

	function updateRequest($mysqli, $requestId, $amount, $approve) {
		$status = ($approve ? 1 : 2);
		$query = "UPDATE `balance_requests` SET `";
	}
		
?>