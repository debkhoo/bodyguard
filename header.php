<?php
	require('tools.php');
    sec_session_start();
    if (!login_check($mysqli)) {
    	header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Code 7 Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">Code 7</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php $name = $_SESSION['username']; echo " $name"; ?><b class="caret" style="margin-right:20px"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php if (basename($_SERVER['PHP_SELF'], '.php') === "home") echo 'class="active"';?>>
                        <a href="home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li <?php if (getPageName() === "bodyguard") echo 'class="active"'; ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#bodyguard"><i class="fa fa-fw fa-street-view"></i> Bodyguard<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="bodyguard" class="collapse">
                            <li>
                                <a href="bodyguard-add.php">Add New Bodyguard</a>
                            </li>
                            <li>
                                <a href="bodyguards.php">View All Bodyguards</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (getPageName() === "bookings") echo 'class="active"'; ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#bookings"><i class="fa fa-fw fa-cart-plus"></i> Bookings <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="bookings" class="collapse">
                            <li>
                                <a href="bookings.php">Bookings</a>
                            </li>
                            <li>
                                <a href="all-bookings.php">View All Bookings</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (getPageName() === "users") echo 'class="active"'; ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="users" class="collapse">
                            <li>
                                <a href="users-registration.php">Pending Registrations</a>
                            </li>
                            <li>
                                <a href="users.php">View All Users</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if (getPageName() === "transactions") echo 'class="active"'; ?>>
                        <a href="javascript:;" data-toggle="collapse" data-target="#transaction"><i class="fa fa-fw fa-credit-card"></i> Transactions <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="transaction" class="collapse">
                            <li>
                                <a href="pending-requests.php">Pending Requests</a>
                            </li>
                            <li>
                                <a href="past-transactions.php">Past Transactions</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>