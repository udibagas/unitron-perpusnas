   <!--
    #####################################################################
    #   Author : Andri Kurnia Putra                                     #
    #   Release: 1-4-2016                                               #
    #   Judul  : Konfirmasi Email 			                            #
    #   Powered: PHP MAILER                                             #
    #####################################################################
     -->

<?php
	include "../koneksi.php";

 

 if(isset($_GET['module'])==true){
     $module = mysqli_real_escape_string($konek, $_GET['module']);
 }

 if(isset($_GET['tipe'])==true){
     $tipe = mysqli_real_escape_string($konek, $_GET['tipe']);
 }

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

 
   if($tipe=="request_pbk"&& $module=="input")
    {
           @session_start();
            $idd = $_SESSION['id_req'];
            $nama = $_SESSION['username'];

            $sql = $konek->query("SELECT * FROM ruang");
            $jum = $sql->num_rows;
            $a=1;
            $ruang = "";
            while($data = $sql->fetch_assoc()){
            
                if(isset($_POST['ch'.$a])==true){

                     $rr = mysqli_real_escape_string($konek, $_POST['ch'.$a]);
                    $ruang = $ruang.", ".$rr; 

                    $ruang_id = $data['ruang_id'];
                    $ip = $data['ip'];
                    $tipe = $data['tipe'];

                     $em = $konek->query("SELECT temp_sidik_jari,temp_wajah,card_id FROM enroll_master WHERE kode_enroll='$idd'");

                     $dem = $em->fetch_assoc();

                     $temp = $dem['temp_sidik_jari'];
                     $wajah = $dem['temp_wajah'];
                     $card = $dem['card_id'];

                     $konek->query("INSERT INTO enroll(kode_enroll,username,password,hak_akses,aktif,card_id,nama,perintah,status,ruang_id,ip,tipe,temp_sidik_jari,temp_wajah) VALUE('$idd','$nama','123','0','N','$card','$nama','load_user','Y','$ruang_id','$ip','$tipe','$temp','$wajah')");
                }
                $a++;
            }
            $ruang = substr($ruang,2);
            //echo $ruang;

                $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl1']);
                $tgl2 = mysqli_real_escape_string($konek, $_POST['tgl2']);
                
                $tgl1 = date("Y-m-d h:i:s",strtotime($tgl1));  
                $tgl2 = date("Y-m-d h:i:s",strtotime($tgl2));

                $tujuan = mysqli_real_escape_string($konek, $_POST['tujuan']);
                //$file = mysqli_real_escape_string($konek, $_POST['file']);
                //
                //
$target_dir = "../upload/";
$file = $_FILES["file"]["name"];
$number = generateRandomString();
//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM request");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
if($file!=''){
$pesan = "";
$nama_file = $idd. $ii1.$file.$number."file.pdf";
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$mimetype = mime_content_type($_FILES['file']['tmp_name']);
// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
    $pesan = $pesan."File Sudah Ada !. ";
    $uploadOk = 0;
}
// Check file size
// 
    $sizeee = 1024*1024;
if ($_FILES["file"]["size"] > $sizeee) {
    $pesan = $pesan." File Terlalu Besar !. ";
    $uploadOk = 0;
}

if($mimetype!="application/pdf"){
    $pesan = $pesan." File Harus Berupa Gambar atau PDF .  ". $mimetype;
    $uploadOk = 0;
}

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $pesan = $pesan." File Tidak bisa Di Upload ";
// if everything is ok, try to upload file
} elseif($uploadOk == 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {

    $pesan = $pesan." Upload Error ! ";

    }
}}else{
   $uploadOk="2"; 
   $nama_file=''; 
}
            if($uploadOk=="1" || $uploadOk=="2"){

            $konek->query("INSERT INTO request SET tanggal_masuk='$tgl1',tanggal_keluar='$tgl2', id_regis='$idd',tujuan='$tujuan',  akses_ruang='$ruang',file='$nama_file',tiket='Y',step_user='pbk1permohonan',step_pj='pbk1permohonan',step='pbk1permohonan'");

            $sql = $konek->query("SELECT id_req FROM request WHERE id_regis='$idd' ORDER BY id_req DESC LIMIT 1");
            $qq = $sql->fetch_assoc();
            $ii = $qq['id_req'];

            $konek->query("UPDATE tim_req SET status='Y',id_req='$ii' WHERE id_register='$idd' AND Status='N'");
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk1permohonan&tipe=input' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk1permohonan&tipe=input' />";
            }
    }

    elseif($tipe=="sujaw" && $module="input"){

        $target_dir = "../upload/";
        $file = $_FILES["file"]["name"];
//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM request");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
if($file!=''){

$number = generateRandomString();
$pesan = "";
$nama_file =  $ii1.$file.$number."sujawfile.pdf";
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$mimetype = mime_content_type($_FILES['file']['tmp_name']);
// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
    $pesan = $pesan."File Sudah Ada !. ";
    $uploadOk = 0;
}
// Check file size
// 
    $sizeee = 1024*1024;
if ($_FILES["file"]["size"] > $sizeee) {
    $pesan = $pesan." File Terlalu Besar !. ";
    $uploadOk = 0;
}

if($mimetype!="application/pdf"){
    $pesan = $pesan." File Harus Berupa Gambar atau PDF .  ". $mimetype;
    $uploadOk = 0;
}

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $pesan = $pesan." File Tidak bisa Di Upload ";
// if everything is ok, try to upload file
} elseif($uploadOk == 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {

    $pesan = $pesan." Upload Error ! ";

    }
}}else{
   $uploadOk="2"; 
   $nama_file=''; 
}
            if($uploadOk=="1" || $uploadOk=="2"){
                $id_req = mysqli_real_escape_string($konek, $_GET['id']);

            $konek->query("UPDATE request SET surat_jawaban='$nama_file' WHERE id_req='$id_req'");
          
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk2persetujuan&tipe=detail&id=$id_req' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk2persetujuan&tipe=detail&id=$id_req' />";
            }
    }

     elseif($tipe=="pendamping"&& $module=="ganti")
    {
         $pendamping = mysqli_real_escape_string($konek, $_POST['pendamping']);
         $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
         $konek->query("UPDATE request SET pendamping='$pendamping',atasan='Y' WHERE id_req='$id_req'");

        $sql = $konek->query("SELECT * FROM pemandu WHERE id_req='$id_req' AND status='N'");
        $nr = $sql->num_rows;

        if($nr<1)
        {
        $konek->query("INSERT INTO pemandu(id_regis,waktu,keterangan,status,id_req) VALUES('$pendamping',NOW(),'Pemandu Data Center','N','$id_req')");
        }else{
         $konek->query("UPDATE pemandu SET id_regis='$pendamping',waktu=NOW() WHERE id_req='$id_req'");    
        }

         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk4pemandu&tipe=detail&id=$id_req' />";
   
     }elseif($tipe=="request_pbk"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk3itinerary&tipe=detail&id=$id_req' />";

     }elseif($tipe=="review_pbk"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status_review='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk7pengumuman&tipe=detail&id=$id_req' />";

     }elseif($tipe=="ppanjang"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='Y',pendamping='',pengumuman='',status_review='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk4pemandu&tipe=detail&id=$id_req' />";

    }elseif($tipe=="ppanjang"&& $module=="tolak"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='S',tiket='N',atasan='N',status_review='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET status='N',tiket='N',atasan='N',status_review='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE itinerary SET status='N',tiket='N',atasan='N',status_review='N' WHERE id_req='$id_req'");

         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk12selesai&tipe=aktif&id=$id_req' />";

    
    }elseif($tipe=="itinerary_pbk"&& $module=="input"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);
        $tgl = mysqli_real_escape_string($konek, $_POST['tgl']);
        $tgl = date("Y-m-d",strtotime($tgl));   

        $t = mysqli_real_escape_string($konek, $_POST['tipe']);
                $qq = $konek->query("SELECT count(id_req) as jumlah FROM pp_kunjungan WHERE id_req='$id_req'");
        if(isset($_GET['pp'])==true){
        $dd = $qq->fetch_assoc();
        $id2 = $dd['jumlah'];
        $id_req2=$id_req.$id2;
        }else{
          $id_req2='';  
        }

        $konek->query("INSERT INTO itinerary(id_req,id_perpanjang,waktu,lokasi,detail_aktifitas,status,tipe) VALUES('$id_req','$id_req2','$tgl','$lokasi','$detail','Y','$t')");

        if($t=="rn"){
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk3itinerary&tipe=itinerary&id=$id_req&t=$t' />";
        }elseif($t=="ra"){
          echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk5bukutamu&tipe=itinerary&id=$id_req&t=$t' />";  
        }
    }

    elseif($tipe=="itinerary_pbk1"&& $module=="input"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);
        $tgl = mysqli_real_escape_string($konek, $_POST['tgl']);
        $tgl = date("Y-m-d",strtotime($tgl));   

        $t = mysqli_real_escape_string($konek, $_POST['tipe']);
                $qq = $konek->query("SELECT count(id_req) as jumlah FROM pp_kunjungan WHERE id_req='$id_req'");
        if(isset($_GET['pp'])==true){
        $dd = $qq->fetch_assoc();
        $id2 = $dd['jumlah'];
        $id_req2=$id_req.$id2;
        }else{
          $id_req2='';  
        }

        $konek->query("INSERT INTO itinerary(id_req,id_perpanjang,waktu,lokasi,detail_aktifitas,status,tipe) VALUES('$id_req','$id_req2','$tgl','$lokasi','$detail','Y','$t')");

        if($t=="rn"){
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk3itinerary&tipe=itinerary&id=$id_req&t=$t' />";
        }elseif($t=="ra"){
          echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk8realita&tipe=itinerary&id=$id_req&t=$t' />";  
        }
    }elseif($tipe=="rekomendasi"&& $module=="input"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $judul = mysqli_real_escape_string($konek, $_POST['judul']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);
        $tgl = mysqli_real_escape_string($konek, $_POST['tgl']);
        $tgl = date("Y-m-d",strtotime($tgl));   

        

        $konek->query("INSERT INTO rekom_cp(id_req,waktu,rekomendasi,detail_rekomendasi,status) VALUES('$id_req','$tgl','$judul','$detail','Y')");

        
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp4rekomendasi&tipe=rekomendasi&id=$id_req' />";
        

    } elseif($tipe=="request_pbk"&& $module=="tolak"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);

        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='R',atasan='N' WHERE id_req='$id_req'");
          $konek->query("DELETE FROM enroll WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk2persetujuan&tipe=aktif&id=$id_req' />";

    } elseif($tipe=="review_pbk"&& $module=="tolak"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);

        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status_review='N' WHERE id_req='$id_req'");
          $konek->query("DELETE FROM enroll WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk8realita&tipe=aktif&id=$id_req' />";

    }  elseif($tipe=="perpanjang" && $module=="input"){

         $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl1']);
         $alasan = mysqli_real_escape_string($konek, $_POST['tujuan']);
                
                
                $tgl1 = date("Y-m-d h:i:s",strtotime($tgl1)); 

            $sql = $konek->query("SELECT COUNT(ruang_name) as jumlah FROM ruang");
            $data = $sql->fetch_assoc();
            $jum = $data['jumlah'];
            $ruang = "";
            for($a=1;$a<=$jum;$a++){

                if(isset($_POST['ch'.$a])==true){

                     $rr = mysqli_real_escape_string($konek, $_POST['ch'.$a]);
                    $ruang = $ruang.", ".$rr; 

                }
            }
            $ruang = substr($ruang,2); 
               

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);

        $qq = $konek->query("SELECT count(id_req) as jumlah FROM pp_kunjungan WHERE id_req='$id_req'");
        $dd = $qq->fetch_assoc();
        $id2 = $dd['jumlah']+1;
        $id_req2=$id_req.$id2;

        $konek->query("INSERT INTO pp_kunjungan(id_perpanjang,id_req,alasan_perpanjang,tanggal_perpanjang,ruang_masuk,status) VALUES('$id_req2','$id_req','$alasan','$tgl1','$ruang','Y')");

         $konek->query("UPDATE request SET status='P',alasan_perpanjang='$alasan', perpanjang='$tgl1',status_hadir='N',atasan='N',cek_finger='Y' WHERE id_req='$id_req'");
         
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk8realita&tipe=detail&id=$id_req&selesai=on' />";

    } elseif($tipe=="perpanjang1" && $module=="input"){

         $tgl1 = mysqli_real_escape_string($konek, $_POST['tgl1']);
         $alasan = mysqli_real_escape_string($konek, $_POST['tujuan']);
                
                
                $tgl1 = date("Y-m-d h:i:s",strtotime($tgl1)); 

            $sql = $konek->query("SELECT COUNT(ruang_name) as jumlah FROM ruang");
            $data = $sql->fetch_assoc();
            $jum = $data['jumlah'];
            $ruang = "";
            for($a=1;$a<=$jum;$a++){

                if(isset($_POST['ch'.$a])==true){

                     $rr = mysqli_real_escape_string($konek, $_POST['ch'.$a]);
                    $ruang = $ruang.", ".$rr; 

                }
            }
            $ruang = substr($ruang,2); 
               

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);

        $qq = $konek->query("SELECT count(id_req) as jumlah FROM pp_kunjungan WHERE id_req='$id_req'");
        $dd = $qq->fetch_assoc();
        $id2 = $dd['jumlah']+1;
        $id_req2=$id_req.$id2;

        $konek->query("INSERT INTO pp_kunjungan(id_perpanjang,id_req,alasan_perpanjang,tanggal_perpanjang,ruang_masuk,status) VALUES('$id_req2','$id_req','$alasan','$tgl1','$ruang','Y')");

         $konek->query("UPDATE request SET status='P',alasan_perpanjang='$alasan', perpanjang='$tgl1' WHERE id_req='$id_req'");
         
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk11pperpanjang&tipe=aktif&id=$id_req' />";
    }  
	elseif($tipe=="request"&& $module=="batal"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='N' WHERE id_req='$id_req'");
          $konek->query("DELETE FROM enroll WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
     }elseif($tipe=="request"&& $module=="batalkan"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='B' WHERE id_req='$id_req'");
          $konek->query("DELETE FROM enroll WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=status_req' />";

        }elseif($tipe=="pemandu"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE pemandu SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p5pp&tipe=detail&id=$id_req' />";
        } elseif($tipe=="pemandu"&& $module=="tolak"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET pendamping='T' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET id_regis='0' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p5pp&tipe=detail&id=$id_req' />";
         

    }elseif($tipe=="request"&& $module=="selesai"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='S',tiket='N',atasan='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET status='N',tiket='N',atasan='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE itinerary SET status='N',tiket='N',atasan='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk12selesai&tipe=aktif&id=$id_req' />";
    }elseif($tipe=="tampilan"){
        $set = mysqli_real_escape_string($konek, $_POST['p_ikhtisar']);

         $konek->query("UPDATE pengaturan SET `set`='$set' WHERE pengaturan='ikhtisar'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pengaturan_umum' />";

    }elseif($tipe=="nohp"){

        $no1 = mysqli_real_escape_string($konek, $_POST['no1']);
        $no2 = mysqli_real_escape_string($konek, $_POST['no2']);
        $no3 = mysqli_real_escape_string($konek, $_POST['no3']);
        $no4 = mysqli_real_escape_string($konek, $_POST['no4']);
        $no5 = mysqli_real_escape_string($konek, $_POST['no5']);
        $no6 = mysqli_real_escape_string($konek, $_POST['no6']);
        $no7 = mysqli_real_escape_string($konek, $_POST['no7']);
        $no8 = mysqli_real_escape_string($konek, $_POST['no8']);

         $konek->query("UPDATE pengaturan SET `set`='$no1' WHERE pengaturan='no_hp1'");
         $konek->query("UPDATE pengaturan SET `set`='$no2' WHERE pengaturan='no_hp2'");
         $konek->query("UPDATE pengaturan SET `set`='$no3' WHERE pengaturan='no_hp3'");
         $konek->query("UPDATE pengaturan SET `set`='$no4' WHERE pengaturan='no_hp4'");
         $konek->query("UPDATE pengaturan SET `set`='$no5' WHERE pengaturan='no_hp5'");
         $konek->query("UPDATE pengaturan SET `set`='$no6' WHERE pengaturan='no_hp6'");
         $konek->query("UPDATE pengaturan SET `set`='$no7' WHERE pengaturan='no_hp7'");
         $konek->query("UPDATE pengaturan SET `set`='$no8' WHERE pengaturan='no_hp8'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pengaturan_umum' />";

        }elseif($tipe=="nota"&& $module=="input"){
             $id_req = mysqli_real_escape_string($konek, $_POST['id']);
             $nota = mysqli_real_escape_string($konek, $_POST['nota']);
             $konek->query("UPDATE request SET nota_dinas='$nota' WHERE id_req='$id_req'");
             echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p4pemandu&tipe=detail&id=$id_req' />";

        }elseif($tipe=="pengumuman_pbk"&& $module=="input"){
             $id_req = mysqli_real_escape_string($konek, $_POST['id']);
             $pengumuman = mysqli_real_escape_string($konek, $_POST['nota']);
             $konek->query("UPDATE request SET pengumuman='$pengumuman' WHERE id_req='$id_req'");
             echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk7pengumuman&tipe=pengumuman&id=$id_req' />";

        }elseif($tipe=="buku"&& $module=="hadir"){
             $id_req = mysqli_real_escape_string($konek, $_GET['id']);
             $konek->query("UPDATE request SET status_hadir='Y' WHERE id_req='$id_req'");
             $konek->query("UPDATE enroll SET aktif='Y',status='Y' WHERE id_req='$id_req'");
             echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=pbk8realita&tipe=detail&id=$id_req' />";
        }



     elseif($tipe=="doeval" && $module="input"){

        $target_dir = "../upload/";
        $file = $_FILES["file"]["name"];
//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM request");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
if($file!=''){

$number = generateRandomString();
$pesan = "";
$nama_file =  $ii1.$file.$number."usulfile.pdf";
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$mimetype = mime_content_type($_FILES['file']['tmp_name']);
// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
    $pesan = $pesan."File Sudah Ada !. ";
    $uploadOk = 0;
}
// Check file size
// 
    $sizeee = 1024*1024;
if ($_FILES["file"]["size"] > $sizeee) {
    $pesan = $pesan." File Terlalu Besar !. ";
    $uploadOk = 0;
}

if($mimetype!="application/pdf"){
    $pesan = $pesan." File Harus Berupa Gambar atau PDF .  ". $mimetype;
    $uploadOk = 0;
}

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $pesan = $pesan." File Tidak bisa Di Upload ";
// if everything is ok, try to upload file
} elseif($uploadOk == 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {

    $pesan = $pesan." Upload Error ! ";

    }
}}else{
   $uploadOk="2"; 
   $nama_file=''; 
}
            if($uploadOk=="1" || $uploadOk=="2"){
                $id_req = mysqli_real_escape_string($konek, $_GET['id']);

            $konek->query("UPDATE req_capacity SET dokumen_evaluasi='$nama_file' WHERE id_req='$id_req'");
          
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp2eval&tipe=detail&id=$id_req' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp2eval&tipe=detail&id=$id_req' />";
            }
    }
    elseif($tipe=="dogap" && $module="input"){

        $target_dir = "../upload/";
        $file = $_FILES["file"]["name"];
//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM request");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
if($file!=''){

$number = generateRandomString();
$pesan = "";
$nama_file =  $ii1.$file.$number."gapfile.pdf";
$target_file = $target_dir . $nama_file;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$mimetype = mime_content_type($_FILES['file']['tmp_name']);
// Check if image file is a actual image or fake image


// Check if file already exists
if (file_exists($target_file)) {
    $pesan = $pesan."File Sudah Ada !. ";
    $uploadOk = 0;
}
// Check file size
// 
    $sizeee = 1024*1024;
if ($_FILES["file"]["size"] > $sizeee) {
    $pesan = $pesan." File Terlalu Besar !. ";
    $uploadOk = 0;
}

if($mimetype!="application/pdf"){
    $pesan = $pesan." File Harus Berupa Gambar atau PDF .  ". $mimetype;
    $uploadOk = 0;
}

// Allow certain file formats

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $pesan = $pesan." File Tidak bisa Di Upload ";
// if everything is ok, try to upload file
} elseif($uploadOk == 1){
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {

    $pesan = $pesan." Upload Error ! ";

    }
}}else{
   $uploadOk="2"; 
   $nama_file=''; 
}
            if($uploadOk=="1" || $uploadOk=="2"){
                $id_req = mysqli_real_escape_string($konek, $_GET['id']);

            $konek->query("UPDATE req_capacity SET dokumen_gap='$nama_file' WHERE id_req='$id_req'");
          
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp2eval&tipe=detail&id=$id_req' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp2eval&tipe=detail&id=$id_req' />";
            }
    }

     elseif($tipe=="cp"&& $module=="setuju"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE pemandu SET id_regis='0' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p5pp&tipe=detail&id=$id_req' />";
         

    }

 $konek->close();
 ?>
