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

 if($tipe=="regis")
 {
 	@session_start();
 	$captcha = mysqli_real_escape_string($konek, $_POST['captcha']);
 	$nama = mysqli_real_escape_string($konek, $_POST['nama']);
 	$alamat = mysqli_real_escape_string($konek, $_POST['alamat']);
 	$email = mysqli_real_escape_string($konek, $_POST['email']);
 	$instansi = mysqli_real_escape_string($konek, $_POST['instansi']);
 	$password = mysqli_real_escape_string($konek, $_POST['password']);
 	$passkon = mysqli_real_escape_string($konek, $_POST['password_konfirmasi']);
 	$number = generateRandomString();

 	$sql=$konek->query("SELECT email FROM register WHERE email='$email'");
 	$row = $sql->num_rows;

 	if($row==0){

 	$konek->query("SELECT email FROM register WHERE email='$email'");


 	if($_SESSION['digit']==$captcha && $password==$passkon){
 		$password = md5($password);
 	$konek->query("INSERT INTO register(nama,alamat,email,instansi,password,tgl_regis,konfirmasi) 
 		VALUES('$nama','$alamat','$email','$instansi','$password',NOW(),'$number')");


 

date_default_timezone_set('Etc/UTC');
 
require '../class/phpmailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
 
$mail->Host = "ssl://smtp.googlemail.com";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "unitronapp@gmail.com";
$mail->Password = "xwivaqqtuufpvigq";
 
$mail->setFrom('Unitron@Unitron.co.id', 'PERPUSNAS admin');
$mail->addReplyTo('Unitron@Unitron.co.id', 'PERPUSNAS Admin');
 
$mail->addAddress($email, $nama);

$mail->Subject = 'Konfirmasi AKUN PERPUSNAS';
$mail->msgHTML("
	<p>Dear $nama</p>

	<p>Terima Kasih telah mendaftar di Website Pelayanan Terpadu Satu Pintu</p>
	<p>Silahkan Konfirmasi dengan menekan link konfirmasi dibawah </p>
	<br>
	<h2><a href='http://localhost/Unitron_Baru/konfirmasi.php?id=$number'>Konfirmasi</a></h2>
<br><br>
	Best Regard,
<br><br><br>
<b>Admin PERPUSNAS</b>
	");
//$mail->addAttachment('images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "";
}
 	echo "<script>
 		alert('Registrasi Berhasil, Lihat Email untuk Konfirmasi !');
 	</script>";

 	echo "<meta http-equiv='refresh' content='0;URL=../menu_login.php?req=regis' />";
 	}else{
 	echo "<script>
 		alert('Registrasi Gagal, Cek Kode di BOX dan password !');
 	</script>";
 	echo "<meta http-equiv='refresh' content='0;URL=../registrasi.php?nama=$nama&alamat=$alamat&email=$email&instansi=$instansi' />";
	 }
	}else{
		echo "<script>
 		alert('Registrasi Gagal, Email sudah Ada !');
 		</script>";
 	echo "<meta http-equiv='refresh' content='0;URL=../registrasi.php?nama=$nama&alamat=$alamat&email=$email&instansi=$instansi' />";
	}
}
if($tipe=="forget")
 {
 @session_start();
    $captcha = mysqli_real_escape_string($konek, $_POST['captcha']);
    $email = mysqli_real_escape_string($konek, $_POST['email']);

    $sql=$konek->query("SELECT email,nama,konfirmasi FROM register WHERE email='$email'");

    $data = $sql->fetch_assoc();
    $nama = $data['nama'];
    $number = $data['konfirmasi'];
    $row = $sql->num_rows;
   

    if($row==0){
    echo "<script>
        alert('Email Tidak ada !');
    </script>";

     echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";

     }else{

    if($_SESSION['digit']==$captcha){
    
date_default_timezone_set('Etc/UTC');
 
require '../class/phpmailer/PHPMailerAutoload.php';
 
$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
 
$mail->Host = "ssl://smtp.googlemail.com";
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "unitronapp@gmail.com";
$mail->Password = "xwivaqqtuufpvigq";
 
$mail->setFrom('Unitron@Unitron.co.id', 'PERPUSNAS admin');
$mail->addReplyTo('Unitron@Unitron.co.id', 'PERPUSNAS Admin');
 
$mail->addAddress($email, $nama);

$mail->Subject = 'Reset AKUN PERPUSNAS';
$mail->msgHTML("
    <p>Dear $nama</p>

    <p>Ini Adalah fitur lupa Password,</p>
    <p>Silahkan Reset dengan menekan link Reset dibawah </p>
    <br>
    <h2><a href='http://localhost/Unitron_Baru/forget_pass.php?id=$number'>Reset</a></h2>
<br><br>
    Best Regard,
<br><br><br>
<b>Admin PERPUSNAS</b>
    ");
//$mail->addAttachment('images/phpmailer_mini.png');

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "";
}

    echo "<script>
        alert('Reset Password Berhasil, Lihat Email untuk Konfirmasi !');
    </script>";

    echo "<meta http-equiv='refresh' content='0;URL=../menu_login.php?req=regis' />";
    }else{
    echo "<script>
        alert('Reaset Gagal, Cek Kode di BOX dan password !');
    </script>";
    echo "<meta http-equiv='refresh' content='0;URL=forget.php' />";
     }
    }

    }   
    elseif($tipe=="forget_pass")
    {

    @session_start();
    $captcha = mysqli_real_escape_string($konek, $_POST['captcha']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);
    $konfir = mysqli_real_escape_string($konek, $_POST['konfir']);
    $passkon = mysqli_real_escape_string($konek, $_POST['password_konfirmasi']);
    $number = generateRandomString();


    if($_SESSION['digit']==$captcha && $password==$passkon){
        $password = md5($password);
    $konek->query("UPDATE register SET password='$password',konfirmasi='$number' WHERE konfirmasi='$konfir'");
        }

         echo "<meta http-equiv='refresh' content='0;URL=../menu_login.php' />";

    }elseif($tipe=="request_BPP31"&& $module=="input") /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    {
            @session_start();
            $idd = $_SESSION['id_req'];

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

            $konek->query("INSERT INTO request SET tanggal_masuk='$tgl1',tanggal_keluar='$tgl2', id_regis='$idd',tujuan='$tujuan',  akses_ruang='$ruang',file='$nama_file'");

            $sql = $konek->query("SELECT id_req FROM request WHERE id_regis='$idd' ORDER BY id_req DESC LIMIT 1");
            $qq = $sql->fetch_assoc();
            $ii = $qq['id_req'];

            $konek->query("UPDATE tim_req SET status='Y',id_req='$ii' WHERE id_register='$idd' AND Status='N'");
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_1&tipe=input' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_1&tipe=input' />";
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
          
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p2persetujuan&tipe=detail&id=$id_req' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p2persetujuan&tipe=detail&id=$id_req' />";
            }
    }

    elseif($tipe=="pendamping"&& $module=="ganti")
    {
         $pendamping = mysqli_real_escape_string($konek, $_POST['pendamping']);
         $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
         $konek->query("UPDATE request SET pendamping='$pendamping' WHERE id_req='$id_req'");

        $sql = $konek->query("SELECT * FROM pemandu WHERE id_req='$id_req' AND status='N'");
        $nr = $sql->num_rows;

        if($nr<1)
        {
        $konek->query("INSERT INTO pemandu(id_regis,waktu,keterangan,status,id_req) VALUES('$pendamping',NOW(),'Pemandu Data Center','N','$id_req')");
        }else{
         $konek->query("UPDATE pemandu SET id_regis='$pendamping',waktu=NOW() WHERE id_req='$id_req'");    
        }

         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_4&tipe=detail&id=$id_req' />";
    }  elseif($tipe=="request"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_2&tipe=aktif&id=$id_req' />";

     }  elseif($tipe=="request"&& $module=="terima2"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status2='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_6&tipe=aktif&id=$id_req' />";

     } elseif($tipe=="request"&& $module=="terima3"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status2='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_7&tipe=aktif&id=$id_req' />";

     }elseif($tipe=="ppanjang"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_4&tipe=aktif&id=$id_req' />";

    }elseif($tipe=="ppanjang"&& $module=="tolak"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='S' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET status='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE itinerary SET status='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_14&tipe=aktif&id=$id_req' />";

    }elseif($tipe=="itinerary"&& $module=="input"){

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
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_3&tipe=itinerary&id=$id_req&t=$t' />";
        }elseif($t=="ra"){
          echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p6buku&tipe=itinerary&id=$id_req&t=$t' />";  
        }
    }
	elseif($tipe=="itinerary2"&& $module=="input"){

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
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_10&tipe=itinerary&id=$id_req&t=$t' />";
        }elseif($t=="ra"){
          echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_10&tipe=itinerary&id=$id_req&t=$t' />";  
        }
    }

    elseif($tipe=="rekomendasi"&& $module=="input"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $judul = mysqli_real_escape_string($konek, $_POST['judul']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);
        $tgl = mysqli_real_escape_string($konek, $_POST['tgl']);
        $tgl = date("Y-m-d",strtotime($tgl));   

        

        $konek->query("INSERT INTO rekom_cp(id_req,waktu,rekomendasi,detail_rekomendasi,status) VALUES('$id_req','$tgl','$judul','$detail','Y')");

        
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp4rekomendasi&tipe=rekomendasi&id=$id_req' />";
        

    }  elseif($tipe=="request"&& $module=="tolak"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);

        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='R' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p2persetujuan&tipe=aktif&id=$id_req' />";

    }   elseif($tipe=="request"&& $module=="tolak2"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);

        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status2='A' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_6&tipe=aktif&id=$id_req' />";

    }    elseif($tipe=="request"&& $module=="tolak3"){

        $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
        $lokasi = mysqli_real_escape_string($konek, $_POST['lokasi']);
        $detail = mysqli_real_escape_string($konek, $_POST['detail']);

        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status2='P' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_7&tipe=aktif&id=$id_req' />";

    }	elseif($tipe=="perpanjang" && $module=="input"){

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
         
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p8pperpanjang&tipe=aktif&id=$id_req' />";
    }	elseif($tipe=="perpanjang2" && $module=="input"){

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
         
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_12&tipe=aktif&id=$id_req' />";
    }   elseif($tipe=="request"&& $module=="batal"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
     }elseif($tipe=="request"&& $module=="batalkan"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='B' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=status_req' />";

        }elseif($tipe=="pemandu"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE pemandu SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_4&tipe=detail&id=$id_req' />";
        } elseif($tipe=="pemandu"&& $module=="tolak"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET pendamping='T' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET id_regis='0' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_4&tipe=detail&id=$id_req' />";
         

    }elseif($tipe=="request"&& $module=="selesai"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='S' WHERE id_req='$id_req'");
         $konek->query("UPDATE pemandu SET status='N' WHERE id_req='$id_req'");
         $konek->query("UPDATE itinerary SET status='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=p9selesai&tipe=aktif&id=$id_req' />";
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

        }elseif($tipe=="buku"&& $module=="hadir"){
             $id_req = mysqli_real_escape_string($konek, $_GET['id']);
             $konek->query("UPDATE request SET status_hadir='Y' WHERE id_req='$id_req'");
             echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=bbp31_5&tipe=detail&id=$id_req' />";
        }

        elseif($tipe=="users"&& $module=="input"){

            $kode = mysqli_real_escape_string($konek, $_POST['kode']);

            if($kode=="ALL"){
                $query = "SELECT id_step,nama_bpp,'' as no_bpp FROM step GROUP BY nama_bpp ORDER BY id_step";
                 $data = 'ALL';
            }else{
                $kategori = mysqli_real_escape_string($konek, $_POST['kategori']);
                $query = "SELECT id_step,nama_bpp,no_bpp FROM step WHERE nama_bpp='$kategori' GROUP BY nama_bpp,no_bpp ORDER BY id_step";
                $data = 'bagi';
            }

            $sql = $konek->query($query);
            $num = $sql->num_rows;
           
            for($a=1;$a<=$num;$a++){
                if(isset($_POST['id_step'.$a])==true){
               $nilai = mysqli_real_escape_string($konek, $_POST['id_step'.$a]);
               $data = $data.",".$nilai;
                }
            }
          

            @session_start();
            $idd = $_SESSION['id_req'];
            $username = mysqli_real_escape_string($konek, $_POST['username']);
            $pelaksana = mysqli_real_escape_string($konek, $_POST['nama_pelaksana']);
           /* $tipe = mysqli_real_escape_string($konek, $_POST['tipe']);

            if($tipe=="non-pns"){
            $konek->query("INSERT INTO register(id_register,status,nama) VALUES ('$username','Y','$pelaksana')");

            $konek->query("INSERT INTO pelaksana_bpp(id_register,step,aktif,pelaksana_nama) VALUES ('$username','$data','Y','$pelaksana')");
            }elseif($tipe=="pns"){

                $konek->query("INSERT INTO register(id_register,status,nama) VALUES ('$username','Y','$pelaksana')");

            $konek->query("INSERT INTO pelaksana_bpp(id_register,step,aktif,pelaksana_nama) VALUES ('$username','$data','Y','$pelaksana')");

            } */

            $konek->query("INSERT INTO pelaksana_bpp(id_register,step,aktif,pelaksana_nama) VALUES ('$username','$data','Y','$pelaksana')");
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=input_user' />";  
        }
        elseif($tipe=="katlay"&& $module=="input"){
        
        $defenisi_layanan = mysqli_real_escape_string($konek, $_POST['defenisi_layanan']);
        $level_layanan = mysqli_real_escape_string($konek, $_POST['level_layanan']);
        $tidak_layanan = mysqli_real_escape_string($konek, $_POST['tidak_layanan']);
        $ketersediaan_layanan = mysqli_real_escape_string($konek, $_POST['ketersediaan_layanan']);
        $BPP = mysqli_real_escape_string($konek, $_POST['BPP']);
        $SOP = mysqli_real_escape_string($konek, $_POST['SOP']);
        $id_kategori_layanan = mysqli_real_escape_string($konek, $_POST['kategori']);

        $konek->query("INSERT INTO layanan SET defenisi_layanan='$defenisi_layanan',level_layanan='$level_layanan',tidak_layanan='$tidak_layanan',ketersediaan_layanan='$ketersediaan_layanan',BPP='$BPP',SOP='$SOP',id_kategori_layanan='$id_kategori_layanan',status='Y'");
        echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=tabel_layanan' />"; 
        }

        elseif($tipe=="reqcp"&& $module=="input")
    {
            @session_start();
            $idd = $_SESSION['id_req'];

            //echo $ruang;

                $tujuan = mysqli_real_escape_string($konek, $_POST['tujuan']);
                //$file = mysqli_real_escape_string($konek, $_POST['file']);
                //
                //
$target_dir = "../upload/";
$file = $_FILES["file"]["name"];
$number = generateRandomString();
//$cek_file=mysqli_real_escape_string($konek, $_POST['file']);

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM req_capacity");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
if($file!=''){
$pesan = "";
$nama_file = $idd. $ii1.$number."file.pdf";
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

            $konek->query("INSERT INTO req_capacity SET id_regis='$idd',tujuan='$tujuan', dokumen_usulan='$nama_file'");

            $sql = $konek->query("SELECT id_req FROM req_capacity WHERE id_regis='$idd' ORDER BY id_req DESC LIMIT 1");
            $qq = $sql->fetch_assoc();
            $ii = $qq['id_req'];

            $konek->query("UPDATE rencana SET status='Y',id_req='$ii' WHERE id_register='$idd' AND Status='N'");
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp1pengajuan&tipe=input' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=cp1pengajuan&tipe=input' />";
            }
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
