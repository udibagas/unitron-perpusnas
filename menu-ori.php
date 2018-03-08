 <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                        
                            <h3>General</h3>
                            <ul class="nav side-menu">
                             
                            <?php if($level=="admin" || $level=="SA"){ ?>

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
                                <li><a href="?page=input_sop"><i class="fa fa-check"></i>SOP</a>
                                </li>
                              
								<li><a href="?page=inventory"><i class="fa fa-tags"></i>Inventory</a>
								</li>

                                

                                </li>
                              <li><a href="?page=inputtamu"><i class="fa fa-users"></i> Buku Tamu </a>
                                </li>
                                

                               

                             <li><a><i class="fa fa-sliders"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="?page=pengaturan_umum"><i class="fa fa-volume-up"></i>Umum</a>
                                        </li>
                                        <li><a href="?page=pengaturan"><i class="fa fa-sort"></i>Min Max Sensor</a>
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
                                 
                                    
                                <li><a href="?page=status_req"><i class="fa fa-check"></i> Status izin </a>
                                </li>
                                

                                <?php } elseif($level=="user"){ ?>

                                <!-- USER -->

                               


                                <?php }elseif($level=="pj"){ ?>
                               
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