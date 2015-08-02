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
                            
                            <form role="form">
                            <table class="table table-hover table-striped table-condensed">
                                <thead>
                                    <tr>
                                        
                                        <th>Account Name</th>
                                        <th>Telephone Num</th>
                                        <th>Email</th>
                                        <th>Approve</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                     <?php
$result = $mysqli->query( "SELECT `id`, `email`, `name`, `phone_number` FROM `accounts` WHERE `approved` = 0");
							while($row = $result->fetch_array()) {
								echo "<tr><td>" . $row['name'] . "</td>
                                <td>" . $row['phone_number'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td><input type=\"checkbox\" value=''>
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