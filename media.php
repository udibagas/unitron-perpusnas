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

    <title>SMADING - SMART MONITORING BULDING  </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="css/jqueryui/jquery-ui.min.css" rel="stylesheet">
	  <link type="text/css" rel="stylesheet" href="css/gambar.css" />
      <link type="text/css" rel="stylesheet" href="css/progress-wizard.min.css" />
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/custom-bagas.css" rel="stylesheet">

    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>


    <script src="js/nprogress.js"></script>
    <script type="text/javascript" src="js/datetime.js"></script>

    <script type="text/javascript">
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

<body>
    <!-- <div class="navbar-fixed-top" style="height:100px;"> -->
        <div class="container-fluid">
            <a href="?page=ikhtisar">
                <img src="images/smading.png" alt="" style="width:150px;margin-top:-30px;display:inline-block;">
                <span style="font-size:45px;margin-left:-30px;font-weight:bold;">SMADING UNITRON-NG</span>
            </a>
            <!-- Smart Building Monitoring System -->
            <br><br>
        </div>
    <!-- </div> -->

    <div id="app">
        <div class="container-fluid main-content">
            <?php include('cek_semua.php'); ?>
            <?php include('isi.php'); ?>
            <?php $konek->close(); ?>
        </div>

        <?php include('menu.php'); ?>

        <div id="setan"> </div>
    </div>
    <script src="js/custom.js"></script>
</body>

</html>
