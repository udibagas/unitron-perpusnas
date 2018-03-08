<?php 

include "koneksi.php";
 $id = mysqli_real_escape_string($konek, $_GET['id']);

$sql = $konek->query("UPDATE register SET tgl_konfirmasi=NOW() WHERE konfirmasi='$id'");

 $sql = $konek->query("SELECT * FROM register WHERE konfirmasi='$id'");
 $num = $sql->num_rows;

 if($num==0){
 	echo "<script>
 		alert('Halaman tidak tersedia !');
 		</script>";
 	echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
 }

 ?>

 <link rel="stylesheet" type="text/css" href="less/login.css" />

    <!-- Bootstrap Core CSS -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Core JS -->
    <script src="js/bootstrap.min.js"></script>

<!--  include JQuery Library -->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ajaxlogin.js"></script>


<div class="container">
    <section class="login-form">
        <div class="panel panel-default">
            <div class="panel-heading">
               <a href="menu_login.php" class="btn btn-info" style="text-decoration:none;">Kembali </span></a> &nbsp;&nbsp;&nbsp; Lupa Password
                </div>

                <?php 
                include "koneksi.php";
                    if(isset($_GET['nama'])==true){

                    $nama = mysqli_real_escape_string($konek, $_GET['nama']);
                    $alamat = mysqli_real_escape_string($konek, $_GET['alamat']);
                    $email = mysqli_real_escape_string($konek, $_GET['email']);
                    $instansi = mysqli_real_escape_string($konek, $_GET['instansi']);
                    echo "<div>Input data salah, atau kode box salah !</div>";
                    }else{

                    $nama = '';
                    $alamat = '';
                    $email = '';
                    $instansi = '';
                    }
                    $konek->close();

                ?>
                    <div class="panel-body">
                        <form method="POST" action="less/aksi.php?tipe=forget_pass">
                           
                            
                            <div><label for="password">Sandi</label><input name="password" type="password" placeholder="Sandi" required id="ajaxlogin_password" class="form-control input-lg" />
                            </div>
                            <div><label for="password">Konfirmasi Sandi</label><input name="password_konfirmasi" type="password" placeholder="Konfirmasi Sandi" required id="ajaxlogin_password" class="form-control input-lg" />
                            <input name="konfir" type="hidden" value="<?php echo $id; ?>" />
                            </div>
                            
                            <div><br><p><img src="captcha.php" width="200" height="50" border="1" alt="CAPTCHA"></p>
                            <p><input type="text" size="6" maxlength="5" name="captcha" id="captcha" value="" required/><br>
                            <small>Silahkan Isi Angka yang sesuai dengan Box</small></p>
                            </div>
                            .<div id="progress"><input type="submit" value="Reset" id="ajaxlogin_submit" class="btn btn-lg btn-info btn-block" />
                            </div>

                        </form>

                        <a class="btn btn-danger btn-block btn-lg" href="forget.php" style="text-decoration:none;">Batal</a>
                    </div>
                            
        </div></section>
        </div>

<script>
$(document).ready(function() {
var msg="";
var elements = document.getElementsByTagName("INPUT");
for (var i = 0; i < elements.length; i++) {
   elements[i].oninvalid =function(e) {
        if (!e.target.validity.valid) {
        switch(e.target.id){
            case 'ajaxlogin_email' : 
            e.target.setCustomValidity("Silahkan Isi Email yang benar !");break;
            case 'ajaxlogin_username' : 
            e.target.setCustomValidity("Username cannot be blank");break;
            case 'captcha' : 
            e.target.setCustomValidity("Silahkan isi Box captcha");break;
        default : e.target.setCustomValidity("Isi Data yang Kosong");break;

        }
       }
    };
   elements[i].oninput = function(e) {
        e.target.setCustomValidity(msg);
    };
} 
})
        </script>