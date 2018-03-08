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
                    Inventori
                    <small>
                        Menu
                    </small>
                </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                        <div class="panel-body">


                                        <div class="row">
                                        <?php


                                        if(isset($_GET['pg'])==false){
                                            include "view/bpp21/product.php";
                                         }else{
                                            $pg= $konek->real_escape_string(trim($_GET['pg']));

                                            if($pg=="pd_dt"){
                                             include "view/bpp21/product_detail.php";
                                            }elseif("pd_tb"){
                                             include "view/bpp21/product_add.php";
                                            }

                                         }

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



    <script src="js/echart/green.js"></script>
