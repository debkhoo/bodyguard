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
                                            <th>More Info</th>
										</tr>
									</thead>
									<tbody>
								<?php
									$result = $mysqli->query("SELECT * FROM `accounts` WHERE `account_type` = 1 ORDER BY `name`");
									$i = 0;
                                    
									while($row = $result->fetch_array()) {
										echo "<tr>
										<td>" . $row['name'] . "</td>
										<td>" . $row['phone_number'] . "</td>
										<td>" . $row['email'] . "</td>
                                        <td><a href='profile.php?id=" . $row['id'] ."' target='' class='fa fa-fw fa-info-circle'></a></td>
								        </tr>";
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