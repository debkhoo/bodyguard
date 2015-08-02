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
                            
                            <form role="form">
                            <table class="table table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        
                                        <th>Account Name</th>
                                        <th>Telephone Num</th>
                                        <th>Image</th>
                                        <th>Amount</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        $result = $mysqli->query("SELECT * FROM `balance_requests` LEFT JOIN `accounts` ON `account_id` = `accounts`.`id` WHERE `status` = 0");
                                        while($row = $result->fetch_array()) {
								            echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['phone_number'] . "</td>
                                            <td><a href='" . $row['image'] . "' target='_blank'>View</a></td>
                                            <td><input type =\"textbox\"></td>
                                            <td><input type=\"checkbox\" value =''>
                                            </tr>";
							}

?>
                                </tbody>
                            </table>
                <button type="submit" class="btn btn-primary" style="float: right">Submit Button</button>
                 </form>
                    </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php
    include('footer.php');
?>