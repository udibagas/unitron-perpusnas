<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}
?>

<?php include "include/pue_loop.php"; ?>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<!-- echart -->
<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>
<?php include "include/pue_js.php"; ?>
