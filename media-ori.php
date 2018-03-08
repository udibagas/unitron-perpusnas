<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }
?>

<?php include "koneksi.php";
$a=0;$b=0;
@session_start();

 $level = $_SESSION['level'];
 $user = $_SESSION['id_req'];

 $qcek = "SELECT temp_admin FROM users WHERE username='$user'";
 $cek = $konek->query($qcek);
 $dcek = $cek->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMADING PERPUSNAS  </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="css/jqueryui/jquery-ui.min.css" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="css/gambar.css" />
      <link type="text/css" rel="stylesheet" href="css/progress-wizard.min.css" />

    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>


    <script src="js/nprogress.js"></script>
    <script type="text/javascript" src="js/datetime.js"></script>


    <script>
        NProgress.start();

    function setIntervalAndExecute(fn, t) {
    fn();
    return(setInterval(fn, t));
}




    </script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="redirect.php" class="site_title"><i class="fa fa-tachometer"></i> <span>SMADING PERPUSNAS 2016</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['username']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                        <?php include "menu.php"; ?>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                       <h5 align="center">Copyright 2016 SMADING PERPUSNAS v2</h5>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                   <nav class="" role="navigation">

                        <div class="nav toggle">

                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>

                        </div>

                        <div class="nav toggle">
                            <button class="btn btn-info" type="button" onclick="history.back(-1)"><i class="fa fa-reply"></i> Back</button>

                        </div>




                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/user.png" alt=""><?php echo $_SESSION['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">

                                    <li>
                                    <a href="?page=set_pass">
                                            <span class="badge bg-red pull-right"></span>
                                            <span>Pengaturan Akun</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Bantuan</a>
                                    </li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle"  aria-expanded="false">
                                    <p  valign="center" id="date_time"></p>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>
                                </a>

                            </li>
                            <li class="">
                                 <p  valign="center" id="date_time"></p>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>
                            </li>


                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">

           <div class="navbar navbar-inner aot" id="setan" data-spy="affix" data-offset-top="50">
            <?php
            include "cek_semua.php";
            ?>

            </div>

            <div>

            <?php
             include "isi.php";
            $konek->close();
            ?>
            </div>
               <script src="js/custom.js"></script>
</body>

</html>
