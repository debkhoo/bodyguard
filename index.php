<?php
	require('tools.php');
    sec_session_start();
    if (login_check($mysqli)) {
    	header('Location: main.php');
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>SDI | Management Portal</title>
		<link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Raleway:100" rel="stylesheet" type="text/css">
	</head>

<body>
<div id="main">
  <?php include ('header.php'); ?>
  <div class="container">
    <div class="content">
      <p class="heading">Login</p>
      <?php
        if(isset($_GET['error'])) {
        	echo '<br /><p class="error">Error Logging In!</p>';
        }
	  ?>
      <div id="login_container" style="margin-top:30px;">
        <form id="login" action="login.php" method="post" accept-charset="UTF-8">
          <input type="text" name="username" class="placeholder" placeholder="Username" />
          <input type="password" name="password" class="placeholder" placeholder="Password" />
          <input type="submit" value="Log In" />
        </form>
      </div>
    </div>
  </div>
</div>
<?php include ('footer.php'); ?>
</body>
</html>
