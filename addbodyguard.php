<?php
	require('tools.php');
	define('IMAGE_MAX_WIDTH', 1280);
	define('IMAGE_MAX_HEIGHT', 1280);
	sec_session_start();
	if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
	
	if (isset($_POST['name'], $_POST['birthday'], $_POST['contact'], $_POST['password'], $_POST['desc'], $_POST['height'], $_POST['weight'], $_POST['email'], $_POST['grade']) && is_numeric($_POST['grade'])) {
		$name = $mysqli->real_escape_string($_POST['name']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$birthday = $mysqli->real_escape_string($_POST['birthday']);
		$contact = $mysqli->real_escape_string($_POST['contact']);
		$password = md5($mysqli->real_escape_string($_POST['password']));
		$desc = $mysqli->real_escape_string($_POST['desc']);
		$height = $mysqli->real_escape_string($_POST['height']);
		$weight = $mysqli->real_escape_string($_POST['weight']);
		$grade = $mysqli->real_escape_string($_POST['grade']);
		if ($grade < 1 || $grade > 4) {
			header('Location: ./main.php?tab=2&error=3');
			return;
		}
		$sql = "INSERT INTO `accounts` (`name`, `email`, `password`, `phone_number`, `account_type`) VALUES (?, ?, ?, ?, 1)";
		if ($stmt = $mysqli->prepare($sql)) {
			$stmt->bind_param('ssss', $name, $email, $password, $contact);
			$stmt->execute();
			if ($stmt->affected_rows == 0) {
				header('Location: ./main.php?tab=2&error=5');
				return;
			}
			$accountId = mysqli_insert_id($mysqli);
			$success = isValidSingleImage("photo");
			if (empty($success)) {
				if (uploadBodyguardImage("photo", $accountId, $mysqli)) {
					$sql = "INSERT INTO `bodyguards` (`id`, `birthday`, `height`, `weight`, `experience`, `gradeId`) VALUES (?, ?, ?, ?, ?, ?)";
					if ($stmt = $mysqli->prepare($sql)) {
						$stmt->bind_param('iiiisi', $accountId, $birthday, $height, $weight, $desc, $grade);
						$stmt->execute();
						if ($stmt->affected_rows == 0) {
							header('Location: ./main.php?tab=2&error=4');
							return;
						} else {
							header('Location: ./main.php?tab=2&success=0');
							return;
						}
					} else {
						header('Location: ./main.php?tab=2&error=2');
						return;
					}
				} else {
					header('Location: ./main.php?tab=2&error=3');
					return;
				}
			} else {
				header('Location: ./main.php?tab=2&error=2');
				return;
			}
		} else {
			header('Location: ./main.php?tab=2&error=1');
			return;
		}
	}
	
	function uploadBodyguardImage($field, $merchantID, $mysqli) {
		$result = array();
		$folder = "images/bodyguard/$merchantID/";
		if (!is_dir($folder)) {
			mkdir($folder, 0775, true);
		}
		$file_name = $_FILES[$field]['name'];
		$file_size = $_FILES[$field]['size'];
		$file_tmp  = $_FILES[$field]['tmp_name'];
		$file_type = $_FILES[$field]['type'];	
		$fileName = time() . '_' . rand() . '.jpg';
		$imagePath = $folder . $fileName;
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($file_tmp);
		switch ($source_image_type) {
		case IMAGETYPE_GIF:
			$source_gd_image = imagecreatefromgif($file_tmp);
			break;
		case IMAGETYPE_JPEG:
			$source_gd_image = imagecreatefromjpeg($file_tmp);
			break;
		case IMAGETYPE_PNG:
			$source_gd_image = imagecreatefrompng($file_tmp);
			break;
		default:
			return false;
		}

		$source_aspect_ratio = $source_image_width / $source_image_height;
		$aspect_ratio = IMAGE_MAX_WIDTH / IMAGE_MAX_HEIGHT;
		if ($source_image_width <= IMAGE_MAX_WIDTH && $source_image_height <= IMAGE_MAX_HEIGHT) {
			$image_width = $source_image_width;
			$image_height = $source_image_height;
		} elseif ($aspect_ratio > $source_aspect_ratio) {
			$image_width = (int) (IMAGE_MAX_HEIGHT * $source_aspect_ratio);
			$image_height = IMAGE_MAX_HEIGHT;
		} else {
			$image_width = IMAGE_MAX_WIDTH;
			$image_height = (int) (IMAGE_MAX_WIDTH / $source_aspect_ratio);
		}
		$gd_image = imagecreatetruecolor($image_width, $image_height);
		imagecopyresampled($gd_image, $source_gd_image, 0, 0, 0, 0, $image_width, $image_height, $source_image_width, $source_image_height);
		$success = imagejpeg($gd_image, $imagePath, 80);
		$result[] = $success;
		$url = 'http://api.sdi.my/portal/' . $imagePath;
		if ($success) {
			$sql = "UPDATE `accounts` SET `display_picture` = ? WHERE `id` = ?";
			if ($stmt = $mysqli->prepare($sql)) {
				$stmt->bind_param('si', $url, $merchantID);
				$stmt->execute();
				if ($stmt->affected_rows == 0) {
					header('Location: ./main.php?tab=2&error=6');
					return false;
				}
			}
		} else {
			return false;
		}
		imagedestroy($source_gd_image);
		imagedestroy($gd_image);
		return true;
	}
?>