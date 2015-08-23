<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Transaction Log
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
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
									$result = $mysqli->query("SELECT *, `balance_requests`.`id` AS `brid` FROM `balance_requests` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `status` = 1 UNION
                                    SELECT *, `balance_requests`.`id` AS `brid` FROM `balance_requests` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `status` = 2");
                                    
                                    $status;
                                    

									$i = 0;
									while($row = $result->fetch_array()) {
                                        
                                        if($row['status'] == 1){
                                            $status = 'approved';
                                        }
                                        else{
                                            $status = 'denied';
                                        }
										echo "<tr>
										<input type='hidden' name='brid[]' value='" . $row['brid'] . "'>
										<td>" . $row['name'] . "</td>
										<td>" . $row['phone_number'] . "</td>
										<td><a href='" . $row['image'] . "' target='_blank'>View</a></td>
                                        <td>" . $row['amount'] ."</td>
										<td>" . $status ."</td>
										</tr>";
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