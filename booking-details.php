<?php
    include ('header.php');
	
	$bookingId = $_GET['id'];
	if (!is_numeric($bookingId)) {
		redirectMessage("Booking ID not numeric!", "bookings.php");
		return;
	}
	$query = "SELECT * FROM `bookings` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `bookings`.`id` = $bookingId";
	if ($result = $mysqli->query($query)) {
		$info = $result->fetch_assoc();
	} else {
		redirectMessage("There was a problem fetching the booking details!", "bookings.php");
		return;
	}
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Booking Details
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                 <div class="row">
                    <div class="col-lg-6">

                        <form action="update-booking-details.php" method="post" role="form">

                            <input name="bookingId" type="hidden" value="<?php echo $bookingId; ?>">
                            <div class="form-group">
                                <label>Account Name</label>
                                <input class="form-control" id="disabledInput" type="text" value="<?php echo $bookingId; ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input class="form-control" id="disabledInput" type="text" value="<?php echo $info['contact_number']; ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Number Request</label>
                                <input class="form-control" id="disabledInput" type="text" value="<?php echo $info['num_requested']; ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Time</label>
                                <input class="form-control" id="disabledInput" type="text" value="<?php echo date("M j, Y, g:i a", $info['time_slot']/1000) ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Duration</label>
                                <input class="form-control" id="disabledInput" type="text" value="<?php echo $info['duration']; ?>" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="0">Pending</option>
                                    <option value="1">Confirmed</option>
                                    <option value="2">Unavailable</option>
                                    <option value="3">Cancelled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="grade">Leader</label>
                                <select name="leader" class="form-control">
									<?php 
										$query = "SELECT * FROM `booking_bodyguard` LEFT JOIN `accounts` ON `bodyguard_id` = `accounts`.`id` WHERE `booking_id` = $bookingId ORDER BY `time_responded` ASC";
										if ($result = $mysqli->query($query)) {
											while ($data = $result->fetch_assoc()) {
												echo '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
											}
										} else {
											echo '<option>Error retrieving bodyguards</option>';
										}
									?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Bodyguard</label>
                                <select name="bodyguards[]" multiple class="form-control">
                                    <?php 
										$query = "SELECT * FROM `booking_bodyguard` LEFT JOIN `accounts` ON `bodyguard_id` = `accounts`.`id` WHERE `booking_id` = $bookingId ORDER BY `time_responded` ASC";
										if ($result = $mysqli->query($query)) {
											while ($data = $result->fetch_assoc()) {
												echo '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
											}
										} else {
											echo '<option>Error retrieving bodyguards</option>';
										}
									?>
                                </select>
                            </div>
                            
							<button type="submit" class="btn btn-primary">Save</button>

                        </form>

                    </div>
                   
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include ('footer.php');
?>