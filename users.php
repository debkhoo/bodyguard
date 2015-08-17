<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Users
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
                                        <th>Email</th>
                                        <th>Balance</th>
                                        <th>More Info</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										$result = $mysqli->query("SELECT * FROM `accounts` WHERE `account_type` = 0 ORDER BY `name`");
										$i = 0;
										while($row = $result->fetch_array()) {
										echo "<tr>
										<td>" . $row['name'] . "</td>
										<td>" . $row['phone_number'] . "</td>
										<td>" . $row['email'] . "</td>
                                        <td>" . $row['balance'] . "</td>
                                        <td><a href='profile.php?id=" . $row['id'] ."' target='' class='fa fa-fw fa-info-circle'></a></td>
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