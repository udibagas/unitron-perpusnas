<?php

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

   ?>

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                    <span class="fa fa-line-chart"></span> Monitoring DataCenter Periode Tertentu
                </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                        <div class="panel-body">

                                        <div class="row">
                                        <?php
                                            include "include/tren_loop.php";
                                         ?>
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


    <?php
          include "include/tren_js.php";

    ?>
