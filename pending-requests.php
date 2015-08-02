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
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Pending Requests
                            </li>
                        </ol>
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
                                        <th>Telephone Phone</th>
                                        <th>Image</th>
                                        <th>Amount</th>
                                        <th>Reject</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>blabla</td>
                                        <td>blabla</td>
                                        <td>blabla</td>
                                        <td><input></input></td>
                                        <td>
                                        <input type="checkbox" value="">
                                </td>
                                    </tr>
                                    
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