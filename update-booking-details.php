<?php 
	require('tools.php');
	sec_session_start();
	if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
	
	if (isset($_POST['status'], $_POST['bookingId'])) {
		$status = $_POST['status'];
		$id = $_POST['bookingId'];
		if (!is_numeric($id)) {
			alertMessage("There was a problem fetching the booking id! $id");
			return;
		}
		$query = "SELECT * FROM `bookings` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `bookings`.`id` = $id";
		if ($result = $mysqli->query($query)) {
			$info = $result->fetch_assoc();
		} else {
			alertMessage("There was a problem fetching the booking id!");
			return;
		}
		if (!is_numeric($status) || $status < 0 || $status > 3) {
			alertMessage("Error with status");
			return;
		} else if ($status == 1 && !isset($_POST['bodyguards'])) {
			alertMessage("Please select the bodyguards!");
			return;
		} else if ($status == 1 && !isset($_POST['leader'])) {
			alertMessage("Please select the leader!");
			return;
		}
		if ($status == 1) {
			$leader = intval($_POST['leader']);
			$query = "UPDATE `bookings` SET `leader` = $leader WHERE `id` = $id";
			if (!$mysqli->query($query)) {
				alertMessage("Error updating leader : $query");
				return;
			}
			for ($i = 0; $i < count($_POST['bodyguards']); $i++) {
				$bgid = intval($_POST['bodyguards'][$i]);
				$query = "UPDATE `booking_bodyguard` SET `status` = 1 WHERE `booking_id` = $id  AND `bodyguard_id` = $bgid";
				if (!$mysqli->query($query)) {
					alertMessage("Error updating bodyguards");
					return;
				}
			}
			$notbg = "";
			for ($i = 0; $i < count($_POST['bodyguards']); $i++) {
				$bgid = intval($_POST['bodyguards'][$i]);
				if ($i > 0) {
					$notbg .= " AND ";
				}
				$notbg .= "`bodyguard_id` != $bgid ";
			} 
			$query = "UPDATE `booking_bodyguard` SET `status` = 2 WHERE " . $notbg;
			if (!$mysqli->query($query)) {
				alertMessage("Error updating status");
				return;
			}
		}
		$query = "UPDATE `bookings` SET `status` = $status WHERE `id` = $id";
		if (!$mysqli->query($query)) {
			alertMessage("Error updating booking request!");
			return;
		}
		redirectMessage("Successfully updated the request(s)!", 'bookings.php');
	} else {
		alertMessage("There is no booking to update!");
	} 
?>