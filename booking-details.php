<?php
    include ('header.php');
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

                        <form role="form">

                            
                            <div class="form-group">
                                <label>Account Name</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Name" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Contact Number" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Number Request</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Number Request" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Time</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Time" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Duration</label>
                                <input class="form-control" id="disabledInput" type="text" placeholder="Duration" disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control">
                                    <option>Pending</option>
                                    <option>Confirmed</option>
                                    <option>Unavailable</option>
                                    <option>Cancelled</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="grade">Leader</label>
                                <select name="grade" class="form-control">
									<?php 
										$query = "SELECT * FROM `bodyguard_grade`";
										if ($result = $mysqli->query($query)) {
											while ($data = $result->fetch_assoc()) {
												echo '<option value="' . $data['id'] . '">' . $data['name'] . '</option>';
											}
										} else {
											echo '<option>Error retrieving ranks</option>';
										}
									?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Bodyguard</label>
                                <select multiple class="form-control">
                                    <option>1</option>
                                </select>
                            </div>
                            
                            <button type="reset" class="btn btn-danger">Reset</button>
							<button type="submit" class="btn btn-primary">Submit</button>

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