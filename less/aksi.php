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
 
$mail->setFrom('Unitron@Unitron.co.id', 'UNITRONS admin');
$mail->addReplyTo('Unitron@Unitron.co.id', 'UNITRONS Admin');
 
$mail->addAddress($email, $nama);

$mail->Subject = 'Konfirmasi AKUN UNITRONS';
$mail->msgHTML("
	<p>Dear $nama</p>

	<p>Terima Kasih telah mendaftar di Website Pelayanan Terpadu Satu Pintu</p>
	<p>Silahkan Konfirmasi dengan menekan link konfirmasi dibawah </p>
	<br>
	<h2><a href='http://localhost/Unitron_Baru/konfirmasi.php?id=$number'>Konfirmasi</a></h2>
<br><br>
	Best Regard,
<br><br><br>
<b>Admin UNITRONS</b>
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
 
$mail->setFrom('Unitron@Unitron.co.id', 'UNITRONS admin');
$mail->addReplyTo('Unitron@Unitron.co.id', 'UNITRONS Admin');
 
$mail->addAddress($email, $nama);

$mail->Subject = 'Reset AKUN UNITRONS';
$mail->msgHTML("
    <p>Dear $nama</p>

    <p>Ini Adalah fitur lupa Password,</p>
    <p>Silahkan Reset dengan menekan link Reset dibawah </p>
    <br>
    <h2><a href='http://localhost/Unitron_Baru/forget_pass.php?id=$number'>Reset</a></h2>
<br><br>
    Best Regard,
<br><br><br>
<b>Admin UNITRONS</b>
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

    }elseif($tipe=="request"&& $module=="input")
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

 $sql1 = $konek->query("SELECT id_req+1 as ju FROM request");
            
            $num = $sql1->num_rows;

            if($num>0){
                $qq1 = $sql1->fetch_assoc();
                $ii1 = $qq1['ju'];
            }else{
                $ii1=1;
            }
$pesan = "";
$nama_file = $idd. $ii1."file.pdf";
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
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } else {

    $pesan = $pesan." Upload Error ! ";

    }
}
            if($uploadOk=="1"){

            $konek->query("INSERT INTO request SET tanggal_masuk='$tgl1',tanggal_keluar='$tgl2', id_regis='$idd',tujuan='$tujuan',  akses_ruang='$ruang',file='$nama_file'");

            $sql = $konek->query("SELECT id_req FROM request WHERE id_regis='$idd' ORDER BY id_req DESC LIMIT 1");
            $qq = $sql->fetch_assoc();
            $ii = $qq['id_req'];

            $konek->query("UPDATE tim_req SET status='Y',id_req='$ii' WHERE id_register='$idd'");
            echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=request' />";
            }else{
                echo "<script>alert('$pesan');</script>";
                echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=request' />";
            }
    }

    elseif($tipe=="pendamping"&& $module=="ganti")
    {
         $pendamping = mysqli_real_escape_string($konek, $_POST['pendamping']);
         $id_req = mysqli_real_escape_string($konek, $_POST['id_req']);
         $konek->query("UPDATE request SET pendamping='$pendamping' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
    }  elseif($tipe=="request"&& $module=="terima"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='Y' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
    }  elseif($tipe=="request"&& $module=="tolak"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='R' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
    }   elseif($tipe=="request"&& $module=="batal"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='N' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=detail_req&id=$id_req' />";
     }elseif($tipe=="request"&& $module=="batalkan"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='B' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=status_req' />";
    }elseif($tipe=="request"&& $module=="selesai"){
        $id_req = mysqli_real_escape_string($konek, $_GET['id']);
         $konek->query("UPDATE request SET status='S' WHERE id_req='$id_req'");
         echo "<meta http-equiv='refresh' content='0;URL=../media.php?page=status_req' />";
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
    }

 $konek->close();
 ?>
