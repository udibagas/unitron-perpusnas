 
 <?php
                @session_start();
                if(isset($_GET['id'])==true){
                        $_SESSION['id']=mysqli_real_escape_string($konek, $_GET['id']);
                    }
                $hak_akses = $_SESSION['level'];
        		$link1 = mysqli_real_escape_string($konek, $_GET['page']);
                $link2 = $konek->query("SELECT no_bpp,nama_bpp,hak_akses FROM step WHERE link='$link1'");
                $dlink = $link2->fetch_assoc();
                //echo "$dlink[hak_akses] -- $hak_akses";
                $cek_hak =$dlink['hak_akses'];
                if($hak_akses!='admin'){
                if($cek_hak!=$hak_akses){
                    if($cek_hak!='all'){
                    $direct = $konek->query("SELECT link FROM step WHERE hak_akses='$hak_akses' AND no_bpp='$dlink[no_bpp]' AND nama_bpp='$dlink[nama_bpp]'");
                    $ddirect = $direct->fetch_assoc();
                    echo "<meta http-equiv='refresh' content='0;URL=media.php?page=$ddirect[link]&tipe=detail&id=$_SESSION[id]' />";
                }}}

                $head = $konek->query("SELECT * FROM step WHERE no_bpp='$dlink[no_bpp]' AND nama_bpp='$dlink[nama_bpp]' AND status='Y' ORDER BY step");
        		$page = mysqli_real_escape_string($konek, $_GET['page']);
        		$rr="b";
                $seb = 0;
                $lanjut = 0;
        		while($dhead=$head->fetch_assoc()){
                $cek_hak1 =$dhead['hak_akses'];
                if($dhead['hubungan_step']==$seb || $dhead['hubungan_step']==0){
        	 ?>

        	 <li class="<?php 

        	 	if($dhead['link']==$page)
        	 		{
                    $aktif = "active";
        	 		$rr = 's'; 
        		}else{
                if($rr=='b')
                    { 
                        $aktif="completed";
                    }else{
                        $aktif="";
                        $lanjut = $lanjut+1;
                    }
                    
                }
        		echo "$aktif";

        	 ?>">
        	    <?php
                if($lanjut<2){

                if($cek_hak1!=$hak_akses ){  
                 ?> 

                
                <span class="bubble"></span>
                Langkah <?php echo $dhead['step']; ?>. <br>
                <?php echo $dhead['nama_step']; ?>

                <?php }else{ ?>  

                
                <span class="bubble"></span>
                Langkah <?php echo $dhead['step']; ?>. <br>
                <?php echo $dhead['nama_step']; ?>
                <?php } }else{ 

                    ?>
                <span class="bubble"></span>
                Langkah <?php echo $dhead['step']; ?>. <br>
                <?php echo $dhead['nama_step']; ?>

                <?php } ?>
            </li>
        	 <?php
           
             $seb = $dhead['step'];
              }} 

              echo "";
              
              ?>

