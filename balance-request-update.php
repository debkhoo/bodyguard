<?php 
	require('tools.php');
	sec_session_start();
	if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
	
	if (isset($_POST['brid'], $_POST['reject'], $_POST['amount'])) {
		$uid = $_SESSION['user_id'];
		for ($i = 0; $i < count($_POST['brid']); $i++) {
			$id = $_POST['brid'][$i];
			if ($_POST['reject'][$i] == 0) {
				if (is_numeric($_POST['amount'][$i])) {
					$amount = $_POST['amount'][$i];
					$query = "SELECT `account_id` FROM `balance_requests` WHERE `id` = $id";
					if ($result = $mysqli->query($query)) {
						$info = $result->fetch_assoc();
						$accountId = $info['account_id'];
					} else {
						alertMessage("Unable to get account of user.");
						return;
					}
					$query = "UPDATE `balance_requests` SET `amount` = $amount, updatedBy = $uid, updated = now(), status = 1 WHERE `id` = $id";
					if (!$mysqli->query($query)) {
						alertMessage("There was a problem updating the amount.");
						return;
					} else {
						$query = "UPDATE `accounts` SET `balance` = `balance` + $amount WHERE `id` = $accountId";
						if (!$mysqli->query($query)) {
							alertMessage("Unable to increase the balance for the user!");
							return;
						}
					}
				} else {
					alertMessage("Please either reject the request or enter an amount.");
					return;
				}
			} else {
				$query = "UPDATE `balance_requests` SET updatedBy = $uid, updated = now(), status = 2 WHERE `id` = $id";
				if (!$mysqli->query($query)) {
					alertMessage("There was a problem updating the status of the request.");
					return;
				}
			}
			
		}
		redirectMessage("Successfully updated the request(s)!", 'home.php');
	} else {
		alertMessage("There are no registrations to approve!");
	} 
?>