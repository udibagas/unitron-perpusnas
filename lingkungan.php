<?php
    @session_start();
    if(isset($_SESSION['username'])==false) {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

    $id = isset($_GET['id']) ? mysqli_real_escape_string($konek, $_GET['id']) : "env_ruang";
    $ruang = $konek->query("SELECT DISTINCT NAMALOKASI FROM sensor WHERE NAMALOKASI != '' ORDER by ID_SENSOR");
?>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">LINGKUNGAN</h3>
    </div>
    <div class="panel-body">

        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <?php while($druang = $ruang->fetch_assoc()) : $nl = $druang['NAMALOKASI']; ?>
                <li role="presentation" class="<?= $id == $nl ? 'active' : '' ?>">
                    <a href="?page=lingkungan&id=<?= $druang['NAMALOKASI']; ?>">
                        <?= strtoupper($druang['NAMALOKASI']); ?>
                    </a>
                </li>
                <?php endwhile ?>
            </ul>


            <div class="row">
                <?php include "include/suhu_sensor_loop.php"; ?>
                <?php include "include/lembab_sensor_loop.php"; ?>
            </div>

            <div class="row">
                <?php include "include/suhu_rak_sensor_loop.php"; ?>
                <?php include "include/lembab_rak_sensor_loop.php"; ?>
            </div>

        </div>


    </div>
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"> </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<!-- echart -->
<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>

<?php
    include "include/lembab_sensor_js.php";
    include "include/suhu_sensor_js.php";
    include "include/suhu_rak_sensor_js.php";
    include "include/lembab_rak_sensor_js.php";
?>
