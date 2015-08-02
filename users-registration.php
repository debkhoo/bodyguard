<?php
    include ('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            User Registration
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                  <div class="col-lg-12">
                        <div class="table-responsive">
                            
                            <form role="form" method="POST" action="approve-user.php">
								<table class="table table-hover table-striped table-condensed">
									<thead>
										<tr>
											<th>Account Name</th>
											<th>Contact Number</th>
											<th>Email</th>
											<th>Approve</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$result = $mysqli->query( "SELECT `id`, `email`, `name`, `phone_number` FROM `accounts` WHERE `approved` = 0");
										$i = 0;
										while($row = $result->fetch_array()) {
											echo "<tr>
											<input type='hidden' name='ids[]' value='" . $row['id'] . "'>
											<td>" . $row['name'] . "</td>
											<td>" . $row['phone_number'] . "</td>
											<td>" . $row['email'] . '</td>
											<td><input name="approved[' . $i . ']" value="0" type="hidden"><input name="approved[' . $i . ']" value="1" type="checkbox"></td>
											</tr>';
											$i += 1;
										}
									?>
								   
									</tbody>
								</table>
							<button type="submit" class="btn btn-primary" style="float: right">Save Changes</button>
						</form>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include('footer.php');
?>