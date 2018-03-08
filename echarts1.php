<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?><?php
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMADING PERPUSNAS  </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="js/jquery.min.js"></script>
    <script src="js/nprogress.js"></script>
    <script>
        NProgress.start();
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
                        <a href="home.php" class="site_title"><i class="fa fa-tachometer"></i> <span>SMADING PERPUSNAS <?= date('Y') ?></span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <?php include"menu.php" ?>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                       <h5 align="center">Copyright <?= date('Y') ?> SMADING PERPUSNAS v2</h5>
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

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/user.png" alt="">Admin
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profil</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Pengaturan Akun</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Bantuan</a>
                                    </li>
                                    <li><a href="login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Alarm Di ruang Server A
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                       Alarm Di ruang Server B
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                         Alarm Di ruang Server C
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                         Alarm Di ruang Server D
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.php">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->


                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    Echarts
                    <small>
                        Sample
                    </small>
                </h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Bar Graph</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <div id="mainb" style="height:350px;"></div>

                                </div>
                            </div>
                        </div>



                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Bar Graph 2</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a href="#"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="#"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <div id="mainc" style="height:350px;"></div>

                                </div>
                            </div>
                        </div>




                    </div>

                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">SMADING PERPUSNAS <a> </a>. |
                            <span class="lead"> <i class="fa fa-paw"></i> UNI SMADING PERPUSNAS</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>



    <!-- echart -->
    <script src="js/echart/echarts-all.js"></script>
    <script src="js/echart/green.js"></script>

    <?php
$k=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Suhu' GROUP BY tanggal");

$k1=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Lembab' GROUP BY tanggal");

$q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
    ?>

    <script>
        var trenChart9 = echarts.init(document.getElementById('mainb'), theme);
        trenChart9.setOption({
            title: {
                text: 'Trend',
                subtext: 'Trend Mode'
            },
            //theme : theme,
    tooltip : {
        trigger: 'axis'
    },
       tooltip: {
       trigger: "item",
       formatter: "{a} <br/>{b} : {c}"
   },
   legend: {
       x: 'center',
       data: ["SUHU","LEMBAB"]
   },
       dataZoom: {
        show: true,
        start : 70
    },
   xAxis: [
       {
           type: "category",
           name: "x",
           splitLine: {show: true},
           data: [<?php while($r=$q->fetch_array()){ echo "'".$r["tanggal"]."',";}?>]
       }
   ],
   yAxis: [
       {
           type: "log",
           name: "y"
       }
   ],
    toolbox: {
        show : true,
        feature : {
            dataZoom : {show: true},
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "SUHU",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo $t["rata"].",";}?>]

       },
       {
           name: "LEMBAB",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo $t1["rata"].",";}?>]

       }

   ]
});

<?php
            $k=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Suhu' GROUP BY tanggal");

            $k1=$konek->query("SELECT
trans1hari.tanggal,
AVG(trans1hari.rata) as rata,
sensor.PARAMETER
FROM
trans1hari
INNER JOIN sensor ON trans1hari.ID_SENSOR = sensor.ID_SENSOR
WHERE sensor.PARAMETER='Lembab' GROUP BY tanggal");

            $q=$konek->query("SELECT * FROM trans1hari GROUP BY tanggal");
    ?>

        var trenChart8 = echarts.init(document.getElementById('mainc'), theme);
        trenChart8.setOption({
            title: {
                text: 'Trend',
                subtext: 'Trend Mode'
            },
            //theme : theme,
    tooltip : {
        trigger: 'axis'
    },
       tooltip: {
       trigger: "item",
       formatter: "{a} <br/>{b} : {c}"
   },
   legend: {
       x: 'center',
       data: ["SUHU","LEMBAB"]
   },
       dataZoom: {
        show: true,
        start : 70
    },
   xAxis: [
       {
           type: "category",
           name: "x",
           splitLine: {show: true},
           data: [<?php while($r=$q->fetch_array()){ echo "'".$r["tanggal"]."',";}?>]
       }
   ],
   yAxis: [
       {
           type: "log",
           name: "y"
       }
   ],
    toolbox: {
        show : true,
        feature : {
            dataZoom : {show: true},
            magicType : {show: true, type: ['line', 'bar']},
            saveAsImage : {show: true}
        }
    },
   calculable: true,
   series: [
       {
           name: "SUHU",
           type: "line",
           data: [<?php while($t=$k->fetch_array()){ echo $t["rata"].",";}?>]

       },
       {
           name: "LEMBAB",
           type: "line",
           data: [<?php while($t1=$k1->fetch_array()){ echo $t1["rata"].",";}?>]

       }

   ]
});

    </script>
</body>

</html>
