<?php
	require('tools.php');
    sec_session_start();
    if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
?>
<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SDI | Management Portal</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css">
</head>

<body>
<div id="main">
  <div class="container" style="padding-bottom:70px;">
    <?php include ('header.php'); ?>
    <div class="content" id="mainPage">
      <?php
            	$tab = 1;
                if (isset($_GET['tab'])) {
                	$tab = $_GET['tab'];
                    if ($tab != 0 && $tab != 1 && $tab !=2) {
                    	$tab = 1;
                    }
                }
            	if ($tab == 0) { 
                    echo '
                        <p class="heading">Statistics</p>
                        <img src="http://upload.wikimedia.org/wikipedia/commons/8/80/Comingsoon.png" style="margin-left:250px; margin-top:-100px;"></img>
                    ';
                } else if ($tab == 1) {
					echo '<p class="heading">Pending Requests</p><br />';
					$code = -2;
					if (isset($_GET['error'])) {
						$code = $_GET['error'];
						if ($code < 0 || $code > 4) {
							$code = -2;
						}
					} else if (isset($_GET['success'])) {
						$code = -1;
					}
					if ($code == -1) {
						echo '<p class="error">Successfully approved the request!</p>';
					} else if ($code > 0) {
						echo '<p class="error">Error approving the request! Error Code : ' . $code . '. Please contact our support team!</p>';
					}
					echo '
						<table class="bordered">
							<thead>
								<tr>
									<th>Account ID</th>        
									<th>Image</th>
									<th>Time</th>
									<th>Amount</th>
								</tr>
							</thead>';
							$result = mysqli_query($mysqli, "SELECT `id`, `account_id`, `image`, `timestamp` FROM `balance_requests` WHERE `status` = 0");
							while($row = mysqli_fetch_array($result)) {
								echo "<tr><td>" . $row['account_id'] . "</td><td><a href='" . $row['image'] . "' target='_blank'>View</a></td><td>" . $row['timestamp'] . "</td><td>" . "</tr>";
							}
					echo '</table>';
					
                } else {
	                $code = -2;
					if (isset($_GET['error'])) {
						$code = $_GET['error'];
					} else if (isset($_GET['success'])) {
						$code = -1;
					}
					if ($code == -1) {
						echo '<p class="error">Successfully added the bodyguard!</p>';
					} else if ($code > 0) {
						echo '<p class="error">Error approving the request! Error Code : ' . $code . '. Please contact our support team!</p>';
					}
                	echo '<form class="merchant_form" action="addbodyguard.php" method="post" name="merchant_form" enctype="multipart/form-data">
								<ul>
									<li>
										<label for="name">Name:</label>
										<input type="text" name="name" placeholder="John Doe" required />
									</li>
									<li>
										<label for="birthday">Birthday:</label>
										<input type="text" name="birthday" placeholder="1990-05-31" required />
									</li>
									<li>
										<label for="contact">Contact No:</label>
										<input type="text" name="contact" placeholder="0123456789" required />
									</li>
									<li>
										<label for="email">Email:</label>
										<input type="email" name="email" placeholder="email@example.com" required />
									</li>
									<li>
										<label for="password">Password:</label>
										<input type="text" name="password" placeholder="Password" required />
									</li>
									<li>
										<label for="desc">Short Description:</label>
										<textarea name="desc" cols="80" rows="6" required> </textarea>
										<span class="form_hint">Max of 300 characters.</span>
									</li>
									<li>
										<label for="height">Height(cm):</label>
										<input type="text" name="height" placeholder="180" required />
									</li>
									<li>
										<label for="weight">Weight(kg):</label>
										<input type="text" name="weight" placeholder="80" required />
									</li>
									<li>
										<label for="grade">Grade:</label>
										<select name="grade" required>
											<option value="1">Corporal</option>
											<option value="2">Grade 2</option>
											<option value="3">Grade 3</option>
											<option value="4">Grade 3</option>
										</select>
									</li>
									<li>
										<label for="photo">Bodyguard Photo:</label>
										<input type="file" name="photo" required />
									</li>
									<li>
										<button class="submit" type="submit">Submit</button>
									</li>
								</ul>
							</form>';
                }
            ?>
    </div>
  </div>
</div>
<?php include ('footer.php'); ?>
</body>
</html>
