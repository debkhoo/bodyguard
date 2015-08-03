<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Bookings
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                  <div class="col-lg-12">
                        <div class="table-responsive">
                            
                            <form role="form">
                            <table class="table table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        
                                        <th>Account Name</th>
                                        <th>Contact Number</th>
                                        <th>Number Requested</th>
                                        <th>Time</th>
                                        <th>Duration</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $result = $mysqli->query("SELECT *, `bookings`.`id` AS `booking_id` FROM `bookings` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `status` = 0");
                                        while($row = $result->fetch_array()) {
                                            $date = date("M j, Y, g:i a", $row['time_slot']/1000);
								            echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['phone_number'] . "</td>
                                            <td>" . $row['num_requested'] . "</td>
                                            <td>" . $date . "</td>
                                            <td>" . $row['duration'] . "</td>
                                            <td><a href='booking-details.php?id=" . $row['booking_id'] ."' target='_blank' class='fa fa-fw fa-wrench'></a></td>
                                            </tr>";
										}

									?>
                                </tbody>
                            </table>
						</form>
                    </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include('footer.php');
?>