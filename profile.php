<?php
    include ('header.php');

    $id = $_GET['id'];
    if (!is_numeric($id)) {
        redirectMessage("ID not numeric!","home.php");
        return;
    }

    $query = "SELECT * FROM `accounts` WHERE `accounts`.`id` = $id";
	if ($result = $mysqli->query($query)) {
		$info = $result->fetch_assoc();
	} else {
		redirectMessage("There was a problem fetching the details!", "home.php");
		return;
	}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $info['name']; ?></h3>
                        </div>
                        <div class="panel-body">
                                <div class="col-md-3 col-lg-3 col-sm-4 col-xs-5" align="center"> <img alt="display" src="<?php echo $info['display_picture']; ?>" class="img-circle" height="150" width="150"> </div>
                                <div class=" col-md-9 col-lg-9 ">
                                    <table class="table">
                                        <tbody>
                                            <tr>
											<td>Name</td>
											<td><?php echo $info['name']; ?></td>
                                            </tr>
                                            <tr>
											<td>Email</td>
											<td><?php echo $info['email']; ?></td>
                                            </tr>
                                            <tr>
											<td>Phone Number</td>
											<td><?php echo $info['phone_number']; ?></td>
                                            </tr>
                                            <tr>
											<td>Rating</td>
											<td><?php echo $info['rating']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">Reviews</h3>
                        </div>
                        <ul class="list-group">
                                    <?php
                                    $review = $mysqli->query( "SELECT `feedback` , `timestamp` FROM
                                    `bodyguard_rating` WHERE `bodyguard_id` = $id UNION SELECT `feedback` , `timestamp` FROM `user_rating` WHERE `user_id` = $id");
                                    $i = 0;
                                    
                                    while($row = $review->fetch_array()) {
                                        echo "<li class='list-group-item'>" .
                                        "<span class = 'badge'>" . $row['timestamp'] . "</span>" .
                                        "<i class = 'fa fa-fw fa-comment'></i> " . $row['feedback'] .
                                        "</li>";
                                        $i++;
                                    }
                                    if($i == 0){
                                        echo "<li class='list-group-item'> No Reviews </li>";
                                    }
                                    ?>
                        </ul>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
     <script src="js/bodyguard.js"></script>
<?php
    include('footer.php');
?>
