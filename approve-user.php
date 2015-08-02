<?php 
	require('tools.php');
	sec_session_start();
	if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
	
	if (isset($_POST['ids'], $_POST['approved'])) {
		for ($i = 0; $i < count($_POST['ids']); $i++) {
			if ($_POST['approved'][$i] == 1) {
				$id = $_POST['ids'][$i];
				$query = "UPDATE `accounts` SET `approved` = 1 WHERE `id` = $id";
				if (!$mysqli->query($query)) {
					alertMessage("There was a problem approving the account $id");
					return;
				}
			}
			
		}
		redirectMessage("Successfully approved the accounts!", 'home.php');
	} else {
		alertMessage("There are no registrations to approve!");
	} 
?>