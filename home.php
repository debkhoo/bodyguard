<?php 

	include('header.php');
?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Code 7 <small>Dashboard</small>
                        </h1>
                    </div>
                </div>
            
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$query = "SELECT COUNT(*) AS `count` FROM `accounts` WHERE `approved` = 0";
											if ($result = $mysqli->query($query)) {
												$data = $result->fetch_assoc();
												$count = $data['count'];
												echo "$count";
											} else {
												echo 'Error';
											}
										?>
										
										</div>
                                        <div>Pending Registrations</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users-registration.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-cart-plus fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$query = "SELECT COUNT(*) AS `count` FROM `bookings` WHERE `status` = 0";
											if ($result = $mysqli->query($query)) {
												$data = $result->fetch_assoc();
												$count = $data['count'];
												echo "$count";
											} else {
												echo 'Error';
											}
										?>
										</div>
                                        <div>Pending Bookings</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-credit-card fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
										<?php
											$query = "SELECT COUNT(*) AS `count` FROM `balance_requests` WHERE `status` = 0";
											if ($result = $mysqli->query($query)) {
												$data = $result->fetch_assoc();
												$count = $data['count'];
												echo "$count";
											} else {
												echo 'Error';
											}
										?>
										</div>
                                        <div>Pending Bank-ins</div>
                                    </div>
                                </div>
                            </div>
                            <a href="pending-requests.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php

	include('footer.php');
?>
