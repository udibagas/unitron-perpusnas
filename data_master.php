<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>

    <?php
        if(isset($_GET['id'])==true){
        $id = mysqli_real_escape_string($konek, $_GET['id']);
    }else{
        $id="env_ruang";
    }
    ?>
  <div class="">

     <div class="page-title">
                        <div class="title_left">
                            <h3>
                    <span class="fa fa-leaf"></span> Data Master
                    <small>
                        Menu
                    </small>
                </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

<nav class="navbar navbar-default">
  <div class="container-fluid">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
    </button>

   </div>
   <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">

     <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=lokasi"><h2><span class="fa fa-cogs"></span> Lokasi</h2></a></li>

      <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=ruang"><h2><span class="fa fa-cogs"></span> Ruang</h2></a></li>

       <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=sub_ruang"><h2><span class="fa fa-cogs"></span> Sub Ruang</h2></a></li>

     <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=kota"><h2><span class="fa fa-cogs"></span> Kota Pembuat</h2></a></li>

     <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=merek"><h2><span class="fa fa-cogs"></span> Merek</h2></a></li>

       <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=kode_perangkat"><h2><span class="fa fa-cogs"></span> Kode Perangkat</h2></a></li>

        <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=kel_perangkat"><h2><span class="fa fa-cogs"></span> Kelompok Perangkat</h2></a></li>

         <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=unit"><h2><span class="fa fa-cogs"></span> Unit</h2></a></li>

         <li class="btn btn-default btn-xs"><a href="?page=data_master&tipe=sub_unit"><h2><span class="fa fa-cogs"></span> Sub Unit</h2></a></li>

    </ul>

   </div>
  </div>
 </nav>
<div class="row">
                  <div class="abcdefg">
                            <div class="panel panel-success">

                                <div class="panel-body">
                                                <?php
                                        if(isset($_GET['tipe'])==true){

                                            $tipe = mysqli_real_escape_string($konek, $_GET['tipe']);

                                            if($tipe=="lokasi"){
                                             include "view/input_kodelokasi.php";
                                            }elseif($tipe=="ruang"){
                                             include "view/input_ruang.php";
                                            }elseif($tipe=="sub_ruang"){
                                             include "view/input_sub_ruang.php";
                                            }elseif($tipe=="kota"){
                                             include "view/input_kota.php";
                                            }elseif($tipe=="merek"){
                                             include "view/input_merek.php";
                                            }elseif($tipe=="kode_perangkat"){
                                             include "view/input_kode_perangkat.php";
                                            }elseif($tipe=="kel_perangkat"){
                                             include "view/input_kel_perangkat.php";
                                            }elseif($tipe=="unit"){
                                             include "view/input_unit.php";
                                            }elseif($tipe=="sub_unit"){
                                             include "view/input_sub_unit.php";
                                            }

                                        }

                                         ?>
                                         </div>


                                </div>
                            </div>
                        </div>
                        </div>



                <div class="clearfix">
                     </div>

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
