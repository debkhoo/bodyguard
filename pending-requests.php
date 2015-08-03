<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Pending Requests
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->
                
                  <div class="col-lg-12">
                        <div class="table-responsive">
                            
                            <form role="form" method="POST" action="balance-request-update.php">
                            <table class="table table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        
                                        <th>Account Name</th>
                                        <th>Contact Number</th>
                                        <th>Image</th>
                                        <th>Amount</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$result = $mysqli->query("SELECT *, `balance_requests`.`id` AS `brid` FROM `balance_requests` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `status` = 0");
									$i = 0;
									while($row = $result->fetch_array()) {
										echo "<tr>
										<input type='hidden' name='brid[]' value='" . $row['brid'] . "'>
										<td>" . $row['name'] . "</td>
										<td>" . $row['phone_number'] . "</td>
										<td><a href='" . $row['image'] . "' target='_blank'>View</a></td>
										<td><input name='amount[]' type ='text'></td>
										<td><input name='reject'[" . $i . ']" value="0" type="hidden"><input name="reject[' . $i . ']" value="1" type="checkbox"></td>
										</tr>';
										$i += 0;
									}

								?>
                                </tbody>
                            </table>
						<button type="submit" class="btn btn-primary" style="float: right">Confirm Changes</button>
                 </form>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include('footer.php');
?>