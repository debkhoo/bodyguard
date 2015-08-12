<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Bodyguards
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                  <div class="col-lg-12">
                        <div class="table-responsive">
                            
                           
								<table class="table table-hover table-striped table-condensed">
									<thead>
										<tr>
											<th>Account Name</th>
											<th>Contact Number</th>
											<th>Email</th>
											<th>Age</th>
                                            <th>Description</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Grade</th>
										</tr>
									</thead>
									<tbody>
								<?php
									$result = $mysqli->query("SELECT *, `bodyguards`.`id` AS `bgid` FROM `bodyguards` LEFT JOIN `accounts` ON `bodyguards`.`id` = `accounts`.`id` ORDER BY `name`");
									$i = 0;
                                    
									while($row = $result->fetch_array()) {
										echo "<tr>
										<input type='hidden' name='bgid[]' value='" . $row['bgid'] . "'>
										<td>" . $row['name'] . "</td>
										<td>" . $row['phone_number'] . "</td>
										<td>" . $row['email'] . "</td>
                                        <td>" . $row[''] . "</td>
                                        <td>" . $row['experience'] . "</td>
                                        <td>" . $row['height'] . "</td>
                                        <td>" . $row['weight'] . "</td>
                                        <td>" . $row[''] . '</td>
											</tr>';
									}

								?>
                                </tbody>
								</table>
							
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include('footer.php');
?>