<link href="css/ui-progress-bar.css" media="screen" rel="stylesheet" type="text/css" />

<?php
@session_start();
if(isset($_SESSION['username'])==false) {
    echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
}

$sql = $konek->query("SELECT `set` FROM pengaturan WHERE pengaturan='ikhtisar' ");
$data = $sql->fetch_assoc();
$tipe = $data['set'];
$id = (isset($_GET['id'])==true) ? mysqli_real_escape_string($konek, $_GET['id']) : "env_ruang";
?>

<?php include "include/fss_loop.php"; ?>

<?php if ($tipe == "tab") : ?>
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
            <li  class="<?php if($id=='env_ruang'){ echo 'active'; } ?> btn btn-default btn-xs">
                <a href="?page=ikhtisar&id=env_ruang">
                    <h2>Lingkungan Dalam Ruang</h2>
                </a>
            </li>
            <li class="<?php if($id=='kelistrikan'){ echo 'active'; } ?> btn btn-default btn-xs">
                <a href="?page=ikhtisar&id=kelistrikan">
                    <h2>Kelistrikan</h2>
                </a>
            </li>
            <li class="<?php if($id=='ups'){ echo 'active'; } ?> btn btn-default btn-xs">
                <a href="?page=ikhtisar&id=ups">
                    <h2>UPS</h2>
                </a>
            </li>
            <li class="<?php if($id=='pac'){ echo 'active'; } ?> btn btn-default btn-xs">
                <a href="?page=ikhtisar&id=pac">
                    <h2>PAC</h2>
                </a>
            </li>
        </ul>
    </div>
</nav>
<?php endif ?>

<?php
if ($tipe == "tab")
{
    switch ($id)
    {
        case 'env_ruang':
            include "include/suhu_loop.php";
            include "include/lembab_loop.php";
            break;

        case 'kelistrikan':
            include "include/daya_loop.php";
            break;

        case 'ups':
            include "include/ups_loop.php";
            break;

        case 'pac':
            include "include/suhu_PAC_loop.php";
            include "include/lembab_PAC_loop.php";
            break;

        default:
            break;
    }
}
?>

<?php if ($tipe == "semua") : ?>
    <div class="row">
        <div class="col-md-6">
            <?php include "include/suhu_loop.php"; ?>
        </div>
        <div class="col-md-6">
            <?php include "include/lembab_loop.php"; ?>
        </div>
    </div>
    <div class="row">
        <?php include "include/suhu_rak_loop.php"; ?>
        <?php include "include/lembab_rak_loop.php"; ?>
    </div>
    <div class="row">
        <?php include "include/daya_loop.php"; ?>
    </div>
    <div class="row">
        <?php include "include/ups_loop.php"; ?>
    </div>
    <div class="row">
        <?php include "include/suhu_PAC_loop.php"; ?>
        <?php include "include/lembab_PAC_loop.php"; ?>
    </div>
    <div class="row">
        <?php include "include/pdu_loop.php"; ?>
    </div>
<?php endif ?>

<?php /* ?>
elseif ($tipe == "semua")
{
    echo "<div class='row'>";
    include "include/suhu_loop.php";
    include "include/lembab_loop.php";
    echo "<div class='clearfix'></div></div>";
    echo "<div class='row'>";
    //include "include/suhu_rak_loop.php";
    //include "include/lembab_rak_loop.php";
    // include "include/tangki_loop.php";
    include "include/daya_loop.php";
    echo "<div class='clearfix'></div></div>";
    echo "<div class='row'>";
    //  include "include/pdu_loop.php";
    include "include/ups_loop.php";
    echo "<div class='clearfix'></div></div>";
}

<?php */ ?>


<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"> </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="js/echart/echarts-all.js"></script>
<script src="js/echart/green.js"></script>

<?php

if ($tipe == "tab")
{
    switch ($id)
    {
        case 'env_ruang':
            include "include/suhu_js.php";
            include "include/lembab_js.php";
            break;

        case 'kelistrikan':
            include "include/daya_js.php";
            break;

        case 'ups':
            include "include/ups_js.php";
            break;

        case 'pac':
            include "include/suhu_PAC_js.php";
            include "include/lembab_PAC_js.php";
            break;

        case 'pdu':
            include "include/pdu_js.php";
            break;

        default:
            break;
    }
}

elseif ($tipe == "semua")
{
    include "include/suhu_js.php";
    include "include/lembab_js.php";
    include "include/suhu_rak_js.php";
    include "include/lembab_rak_js.php";
    // include "include/tangki_js.php";
    include "include/daya_js.php";
    include "include/pdu_js.php";
    include "include/ups_js.php";
    include "include/suhu_PAC_js.php";
    include "include/lembab_PAC_js.php";
}

?>
