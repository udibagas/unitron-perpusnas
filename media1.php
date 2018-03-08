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

    <title>DKI+PERPUSNAS  </title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
    <link href="css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <link href="css/jqueryui/jquery-ui.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/gambar.css" />   
    <link type="text/css" rel="stylesheet" href="css/progress-wizard.min.css" /> 

    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    <script src="js/nprogress.js"></script>
    <script type="text/javascript" src="js/datetime.js"></script>
	
    <!-------------------------------------------------------------------- Tambahan -->
    <!-- Toastr style -->
    <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
	
    <!-- Data Tables -->
    <link href="css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
    <link href="css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">

    <link href="css/plugins/jQueryUI/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href="css/plugins/jqGrid/ui.jqgrid.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <link href="css/plugins/select2/select2.min.css" rel="stylesheet">

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">

    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

	<!-- TinyMCE (WYSIYWG Editor) -->
	<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_lokomedia.js"></script>

    <!-- Sweet Alert -->
    <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

	<!-- START : DropDown Vertical Menu -->
	<link href="css/dropVerticalMenu.css" rel="stylesheet" type="text/css" />  
	<!-- END : DropDown Vertical Menu -->
	
    <!----------------------------------------------------------------------------------- end Tambahan -->
    
    <script>
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


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="redirect.php" class="site_title"><i class="fa fa-tachometer"></i> <span>DKI+PERPUSNAS UNIQUE</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2><?php echo $_SESSION['username']; ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                        
                            <h3>General</h3>
                            <ul class="nav side-menu">
                             
                            <?php if($level=="admin" || $level=="SA"){ ?>
                               <li><a href="?page=menu_layanan"><i class="fa fa-tachometer"></i> Menu Utama </a>
                                </li>
                                <li><a href="?page=ikhtisar"><i class="fa fa-tachometer"></i> Ikhtisar </a>
                                </li>
                                <li><a href="?page=tren"><i class="fa fa-line-chart"></i>Tren </a>
                                 <li><a href="?page=peta_tampil"><i class="fa fa-comment"></i>Denah </a>
                                </li>
                                <li><a><i class="fa fa-binoculars"></i> Pemantauan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=lingkungan"><i class="fa fa-retweet"></i>Lingkungan</a>
                                        </li>
                                        <li><a href="?page=kelistrikan"><i class="fa fa-plug"></i>Kelistrikan</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tasks"></i> Rekaman <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=histori_alarm"><i class="fa fa-bell"></i>Alarm</a>
                                        </li>
                                        <li><a href="?page=PUE"><i class="fa fa-bolt"></i>Efiensi Listrik</a>
                                        </li>
                                        
                                    </ul>
                                </li>

<!--                                <li><a><i class="fa fa-tags"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=inventory"><i class="fa fa-tags"></i>Inventory Transaksi</a>
                                        </li>
                                        <li><a href="?page=data_master"><i class="fa fa-tags"></i> Data Master</a>
                                        </li>
                                        
                                    </ul> 
                                </li> -->
								<li><a href="?page=inventory"><i class="fa fa-tags"></i>Inventory</a>
								</li>


                              

                                </li>
                              <li><a href="?page=inputtamu"><i class="fa fa-users"></i> Buku Tamu </a>
                                </li>
                                

                                <li><a><i class="fa fa-check"></i> Permohonan<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                       <li><a href="?page=p1permohonan"><i class="fa fa-check"></i> Kunjungan Aktif</a>
                                </li> 
                                        <li><a href="?page=manage_req_history"><i class="fa fa-check"></i> Histori Kunjungan </a>
                                </li> 
                                        
                                    </ul>
                                </li>

                             <li><a><i class="fa fa-sliders"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=pengaturan_umum"><i class="fa fa-volume-up"></i>Umum</a>
                                        </li>
                                        <li><a href="?page=pengaturan"><i class="fa fa-sort"></i>Min Max Sensor</a>
                                        </li>
                                        <li><a href="?page=input_hakakses"><i class="fa fa-sort"></i>Manajemen Hak Akses</a>
                                        </li>
                                        <li><a href="?page=enroll"><i class="fa fa-sort"></i>Manajemen Finger</a>
                                        </li>
                                        <li><a href="?page=tabel_user"><i class="fa fa-sort"></i>Manajemen Data User</a>
                                        </li>
                                        <li><a href="?page=input_data"><i class="fa fa-sort"></i>Update Data User</a>
                                        </li>
                                        <li><a href="?page=data_master"><i class="fa fa-tags"></i> Data Master</a>
                                        </li>
                                    <!--
                                        <li ><a href="?page=data_master&tipe=lokasi"><i class="fa fa-check"></i> Lokasi</a></li>  

                              <li ><a href="?page=data_master&tipe=ruang"><i class="fa fa-check"></i> Ruang</a></li> 

                               <li ><a href="?page=data_master&tipe=sub_ruang"><i class="fa fa-check"></i> Sub Ruang</a></li> 

                             <li ><a href="?page=data_master&tipe=kota"><i class="fa fa-check"></i> Kota Pembuat</a></li> 

                             <li ><a href="?page=data_master&tipe=merek"><i class="fa fa-check"></i> Merek</a></li> 

                               <li ><a href="?page=data_master&tipe=kode_perangkat"><i class="fa fa-check"></i> Kode Perangkat</a></li> 

                                <li ><a href="?page=data_master&tipe=kel_perangkat"><i class="fa fa-check"></i> Kelompok Perangkat</a></li> 

                                 <li ><a href="?page=data_master&tipe=unit"><i class="fa fa-check"></i> Unit</a></li> 

                                 <li ><a href="?page=data_master&tipe=sub_unit"><i class="fa fa-check"></i> Sub Unit</a></li> -->

                             </ul>
                                </li>
                                <?php } elseif($level=="skpd"){ ?>
                                 <li><a href="?page=menu_layanan"><i class="fa fa-tachometer"></i> Menu Utama </a>
                                </li>
                                     <li><a href="?page=request"><i class="fa fa-users"></i> Permohonan izin </a>

                                </li> 
                                <li><a href="?page=status_req"><i class="fa fa-check"></i> Status izin </a>
                                </li>
                                

                                <?php } elseif($level=="user"){ ?>

                                <!-- USER -->

                               


                                <?php }elseif($level=="pj"){ ?>
                                 <li><a href="?page=menu_layanan"><i class="fa fa-tachometer"></i> Menu Utama </a>
                                </li>
                                    <li><a href="?page=ikhtisar"><i class="fa fa-tachometer"></i> Ikhtisar </a>
                                </li>
                                <li><a href="?page=tren"><i class="fa fa-line-chart"></i>Tren </a>
                                 <li><a href="?page=peta_tampil"><i class="fa fa-comment"></i>Notifikasi </a>
                                </li>
                                <li><a><i class="fa fa-binoculars"></i> Pemantauan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=lingkungan"><i class="fa fa-retweet"></i>Lingkungan</a>
                                        </li>
                                        <li><a href="?page=kelistrikan"><i class="fa fa-plug"></i>Kelistrikan</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tasks"></i> Rekaman <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=histori_alarm"><i class="fa fa-bell"></i>Alarm</a>
                                        </li>
                                        <li><a href="?page=PUE"><i class="fa fa-bolt"></i>Efiensi Listrik</a>
                                        </li>
                                        
                                    </ul>
                                </li>


                              <li><a href="?page=inventory"><i class="fa fa-tags"></i> Inventory </a>
                                </li>
                              <li><a href="?page=inputtamu"><i class="fa fa-users"></i> Buku Tamu </a>
                                </li>
                              
                                <?php } elseif($level=="skpd"){ ?>
                                 <li><a href="?page=menu_layanan"><i class="fa fa-tachometer"></i> Menu Utama </a>
                                </li>
                                <li><a href="?page=ikhtisar"><i class="fa fa-tachometer"></i> Ikhtisar </a>
                                </li>
                                <li><a href="?page=tren"><i class="fa fa-line-chart"></i>Tren </a>
                                 <li><a href="?page=peta_tampil"><i class="fa fa-comment"></i>Denah </a>
                                </li>
                                <li><a><i class="fa fa-binoculars"></i> Pemantauan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=lingkungan"><i class="fa fa-retweet"></i>Lingkungan</a>
                                        </li>
                                        <li><a href="?page=kelistrikan"><i class="fa fa-plug"></i>Kelistrikan</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tasks"></i> Rekaman <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=histori_alarm"><i class="fa fa-bell"></i>Alarm</a>
                                        </li>
                                        <li><a href="?page=PUE"><i class="fa fa-bolt"></i>Efiensi Listrik</a>
                                        </li>
                                        
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tags"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=inventory"><i class="fa fa-tags"></i>Inventory Transaksi</a>
                                        </li>
                                        <li><a href="?page=data_master"><i class="fa fa-tags"></i> Data Master</a>
                                        </li>
                                        
                                    </ul>
                                </li>

                                </li>
                              <li><a href="?page=inputtamu"><i class="fa fa-users"></i> Buku Tamu </a>
                                </li>
                                

                                <li><a><i class="fa fa-check"></i> Permohonan<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                       <li><a href="?page=p1permohonan"><i class="fa fa-check"></i> Kunjungan Aktif</a>
                                </li> 
                                        <li><a href="?page=manage_req_history"><i class="fa fa-check"></i> Histori Kunjungan </a>
                                </li> 
                                        
                                    </ul>
                                </li>

                                 <?php } elseif($level=="operator"){ ?>
                                    <li><a href="?page=status_tamu"><i class="fa fa-tachometer"></i> Buku Tamu </a>
                                </li>
                                 <li><a href="?page=manage_req_history"><i class="fa fa-check"></i> Histori Kunjungan </a></li>
                                <?php } ?>

                                <?php if($dcek['temp_admin']=='Y'){ ?>
                                    <li><a href="?page=buka_finger"><i class="fa fa-check"></i> Buka Ruangan </a></li>
                                <?php } ?>
                                </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                       <h5 align="center">Copyright 2016 UNIQUE DKI-PERPUSNAS v2</h5>
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

                        <div class="nav toggle">
                            <button class="btn btn-info" type="button" onclick="history.back(-1)"><i class="fa fa-reply"></i> Back</button>

                        </div>

                         
               
           
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/user.png" alt=""><?php echo $_SESSION['username']; ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                   
                                    <li>
                                    <a href="?page=set_pass">
                                            <span class="badge bg-red pull-right"></span>
                                            <span>Pengaturan Akun</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Bantuan</a>
                                    </li>
                                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle"  aria-expanded="false">
                                    <p  valign="center" id="date_time"></p>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>
                                </a>
                               
                            </li>
                            <li class="">
                                 <p  valign="center" id="date_time"></p>
                                <script type="text/javascript">window.onload = date_time('date_time');</script>
                            </li>
                            

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

        
            <!-- page content -->
            <div class="right_col" role="main">
  
           <div class="navbar navbar-inner aot" id="setan" data-spy="affix" data-offset-top="50">
            <?php
            include "cek_semua.php";
            ?>
            
            </div>
               
            <div>
           
            <?php
             include "isi.php";
            $konek->close();
            ?>
            </div>
               <script src="js/custom.js"></script>

    <!-- Mainly scripts -->

	<script type="text/javascript" src="js/jquery.media.js"></script> 
	<script type="text/javascript" src="jquery.metadata.js"></script> 
				<script>
				$(document).ready(function() {
				$('a.media').media({width:900, height:900});
				}); 
				</script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="js/plugins/flot/jquery.flot.pie.js"></script>


    <script>
        $(document).ready(function() {

            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Data Center One Stop Service', 'Welcome to PERPUSNAS');

            }, 1300);

			$('.demo3').click(function () {
				swal({
					title: "Lanjutkan?",
					text: "Anda yakin akan keluar dari halaman administrator!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Ya, keluar!",
					closeOnConfirm: false
				}, function () {
					swal("Waiting!", "Your imaginary system has been logout.", "success");
					window.location = 'index.php'
				});
			});

			$('.summernote').summernote();
});
			
		
    </script>			   
			   
</body>
</html>
