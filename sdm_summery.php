<?php

include 'koneksi.php';
  if(isset($_POST['submit'])==true){
        $id_kategori_layanan = mysqli_real_escape_string($konek, $_POST['kategori']);
      }
?>
<div class="row" >
	
       <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="navy-line"></div>
                    <h1>Dimensi Kelembagaan Data Center<br/> <span class="navy">Organisasi dan Kebutuhan Kompetensi</span> </h1>
                    <p>Berisi beberapa kelompok kompetensi dalam Tata Kelola Data Center.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-01 - Data Center Civil Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <?php echo "<a href=\"#\"><img alt=\"member\" class=\"img-circle\" src=\"images/sdm/a1.jpg\"></a>"; ?>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a5.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a6.jpg"></a>
                            </div>
                            <h4>Info about Data Center Civil Team</h4>
                            <p>
Kemampuan melakukan desain dan pemeliharaan komponen sipil Data Center. <br>
<ul>
                            <span class="label label-primary pull-right">0</span>
<li>Mampu mengidentifikasi komponen sipil pembentuk Data Center seperti raised floor, ceiling, pintu dan dinding anti api.</li>
                            <span class="label label-primary pull-right">0</span>
<li>Memahami cara pemasangan komponen sipil pembentuk Data Center.</li>
                            <span class="label label-primary pull-right">0</span>
<li>Mampu melakukan desain manual sederhana komponen sipil Data Center.</li>
                            <span class="label label-primary pull-right">0</span>
<li>Mampu melakukan desain komponen sipil Data Center menggunakan sistem komputasi CAD/CAM.</li>
                            <span class="label label-primary pull-right">0</span>
<li>Mampu melakukan rancangan yang efesien, efektif serta melakukan inovasi yang mengoptimalkan penggunaan ruangan dan anggaran tanpa mengurangi kualitas komponen sipil Data Center. </li>
</ul>                            </p>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">0%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 0%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    12
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $200,913 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-04 - Data Center Data Cabling & Rack System Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a7.jpg"></a>
                            </div>
                            <h4>Info about Data Center Data Cabling & Rack System Team</h4>
                            <p>
Kemampuan : melakukan desain dan pemeliharaan sistem kabel data dan rack dalam Data Center<br>
                            </p>
                            <ul>
<li>Mampu mengidentifikasi komponen data cabling & rack system Data Center seperti kabel UTP, kabel FO, PDU Rack.</li>
<li>Mampu menggunakan atau mengoperasikan komponen data cabling dan rack system.</li>
<li>Mampu melakukan trouble shooting terhadap komponen data cabling pada Data Center.</li>
<li>Mampu melakukan analisa performance kinerja data cabling dengan menggunakan tools tertentu.</li>
<li>Mampu melakukan desain data cabling dan rack system yang efesien, efektif serta melakukan inovasi yang mengoptimalkan kabel data, rack dan anggaran tanpa mengurangi kualitas komponen Data Center tersebut.</li>
</ul> 
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">25%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 25%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    25
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    4th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $140,105 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-07 - Data Center Fire Suppression System Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a6.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a7.jpg"></a>
                            </div>
                            <h4>Info about Data Center Fire Suppression System Team</h4>
                            <p>
Kemampuan melakukan desain dan pemeliharaan terhadap sistem pencegah kebakaran  pada Data Center
<ul>
<li>Mampu mengidentifikasi komponen sistem pencegah kebakaran pada Data Center seperti Tabung Gas, Nozle, Sensor dan Controller.</li>
<li>Mampu menggunakan atau mengoperasikan komponen sistem pencegah kebakaran pada Data Center.</li>
<li>Mampu melakukan trouble shooting sederhana terhadap komponen komponen pencegah kebakaran pada Data Center.</li>
<li>Mampu melakukan analisa performance kinerja sistem pencegah kebakaran Data Center dengan menggunakan tools tertentu.</li>
<li>Mampu melakukan desain sistem pencegah kebakaran Data Center yang efesien, efektif serta melakukan inovasi yang mengoptimalkan sistem pencegah kebakaran dan anggaran tanpa mengurangi kualitas komponen Data Center tersebut. </li>
</ul>
                            </p>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">18%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 18%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    53
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    9th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $60,140 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-02 - Data Center Electrical Distribution System Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a8.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a1.jpg"></a>
                            </div>
                            <h4>Info about Data Center Electrical Distribution System Team</h4>
                            <p>
Kemampuan melakukan desain dan pemeliharaan komponen distribusi listrik pada sistem Data Center
                            <ul>
<li>Mampu mengidentifikasi komponen sistem kelistrikan pembentuk Data Center seperti panel listrik dan kabel listrik serta grounding.</li>
<li>Memahami fungsi setiap komponen sistem kelistrikan pembentuk Data Center.</li>
<li>Mampu melakukan desain manual single line diagram sistem kelistrikan Data Center.</li>
<li>Mampu melakukan analisa dengan data-data parameter kelistrikan seperti tengangan, arus, true power, apparent power.</li>
<li>Mampu melakukan rancangan sistem kelistrikan yang efesien, efektif serta melakukan inovasi yang mengoptimalkan penggunaan sistem kabel listrik dan anggaran tanpa mengurangi kualitas komponen sipil Data Center. </li>
</ul>
                            </p>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">61%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 61%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    43
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    1th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $705,913 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">

                            <h5>IT-05 - Data Center Electrical Power Generation System Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a7.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a2.jpg"></a>
                            </div>
                            <h4>Info Data Center Electrical Power Generation System Tea</h4>
                            <p>
                                Kemampuan : melakukan desain dan pemeliharaan terhadap sistem pembangkit listrik pada Data Center
                            </p>
                            <ul>
<li>Mampu mengidentifikasi komponen pembangkit listrik seperti UPS dan Genset.</li>
<li>Mampu menggunakan atau mengoperasikan komponen sistem pembangkit listrik.</li>
<li>Mampu melakukan trouble shooting sederhana terhadap komponen komponen pembangkit listrik.</li>
<li>Mampu melakukan analisa performance kinerja pembangkit listrik Data Center dengan menggunakan tools tertentu.</li>
<li>Mampu melakukan desain sistem pembangkit listrik yang efesien, efektif serta melakukan inovasi yang mengoptimalkan sistem pembangkit listrik dan anggaran tanpa mengurangi kualitas komponen Data Center tersebut. </li>
                            </ul>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">82%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 82%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    68
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    2th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $701,400 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <span class="label label-warning pull-right">DEADLINE</span>
                            <h5>IT-03 - Data Center Monitoring & Evalution Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a6.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a3.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a7.jpg"></a>
                            </div>
                            <h4>Info about Data Center Monitoring & Evalution Team</h4>
                            <p>
Kemampuan melakukan monitoring dan evaluasi komponen-komponen pada sistem Data Center
                            <ul>
<li>Mampu mengidentifikasi komponen monitoring Data Center seperti aplikasi simulasi modeling Data Center, aplikasi monitoring Data Center, layar monitoring, CCTV dan access control.</li>
<li>Mampu mengoperasikan komponen sederhana monitoring Data Center.</li>
<li>Mampu membaca dan memahami aplikasi monitoring Data Center.</li>
<li>Mampu melakukan analisa prediktif kondisi Data Center sebelum dilakukan implementasi sistem baru.</li>
<li>Mampu melakukan modeling simulasi Data Center yang efesien, efektif serta melakukan inovasi yang mengoptimalkan penyusunan spesifikasi komponen Data Center dan anggaran tanpa mengurangi kualitas komponen Data Center tersebut. </li>

                            </p>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">14%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 14%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    8
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    7th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $40,200 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>IT-06 - Data Center Cooling System Team</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="team-members">
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a1.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a2.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a4.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a7.jpg"></a>
                                <a href="#"><img alt="member" class="img-circle" src="images/sdm/a8.jpg"></a>
                            </div>
                            <h4>Info about Data Center Cooling System Team</h4>
                            <p>
Kemampuan melakukan desain dan pemeliharaan terhadap sistem pendinginan  pada Data Center.
                            </p>
                            <ul>
<li>Mampu mengidentifikasi komponen sistem pendinginan pada Data Center seperti PAC indoor dan outdoor unit.</li>
<li>Mampu menggunakan atau mengoperasikan komponen sistem pendinginan pada Data Center.</li>
<li>Mampu melakukan trouble shooting sederhana terhadap komponen komponen pendinginan Data Center.</li>
<li>Mampu melakukan analisa performance kinerja sistem pendinginan Data Center dengan menggunakan tools tertentu.</li>
<li>Mampu melakukan desain sistem pendingin Data Center yang efesien, efektif serta melakukan inovasi yang mengoptimalkan sistem pendingin dan anggaran tanpa mengurangi kualitas komponen Data Center tersebut.               
                            </li>
                            </ul>
                            <div>
                                <span>Status Kompetensi SDM:</span>
                                <div class="stat-percent">26%</div>
                                <div class="progress progress-mini">
                                    <div style="width: 26%;" class="progress-bar"></div>
                                </div>
                            </div>
                            <div class="row  m-t-sm">
                                <div class="col-sm-4">
                                    <div class="font-bold">PROJECTS</div>
                                    16
                                </div>
                                <div class="col-sm-4">
                                    <div class="font-bold">RANKING</div>
                                    8th
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div class="font-bold">BUDGET</div>
                                    $160,100 <i class="fa fa-level-up text-navy"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
</div>