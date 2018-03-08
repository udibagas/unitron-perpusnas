<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">INVENTORY MANAGEMENT</h3>
    </div>
    <div class="panel-body">
        <?php
            if (isset($_GET['pg']) == false) {
                include "product.php";
            }

            else {
                $pg= $konek->real_escape_string(trim($_GET['pg']));

                if ($pg == "pd_dt") {
                    include "product_detail.php";
                }

                elseif ($pg == "pd_tb") {
                    include "product_add.php";
                }
            }
        ?>
    </div>
</div>


<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>


<script src="js/echart/green.js"></script>
