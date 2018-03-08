<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}

if($_SESSION['level']!='admin') {
    if($_SESSION['level']!='pj') {
        if($_SESSION['level']!='pimpinan') {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
        }
    }
}
?>

<?php include "include/tren_loop.php"; ?>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"> </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<!-- echart -->
<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>


<?php include "include/tren_js.php"; ?>
