


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
               <a href="menu_login.php" class="btn btn-info" style="text-decoration:none;">Kembali </span></a> &nbsp;&nbsp;&nbsp; Formulir Registrasi
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
                        <form method="POST" action="less/aksi.php?tipe=regis">
                           
                            <div>
                            <label for="username">Nama</label>
                            <input type="text" placeholder="Nama" name="nama" required id="ajaxlogin_username" class="form-control input-lg" value="<?php echo $nama; ?>" />
                            </div>
                            <div>
                            <label for="alamat">Alamat</label>
                            <input type="text" placeholder="Alamat" name="alamat" required id="ajaxlogin_alamat" class="form-control input-lg" value="<?php echo $alamat; ?>" />
                            </div>
                            <div>
                            <label for="email">Email</label>
                            <input type="email" placeholder="Email" name="email" required id="ajaxlogin_email" class="form-control input-lg" value="<?php echo $email; ?>" />
                            </div>
                             <div>
                            <label for="instansi">Instansi</label>
                            <input type="text" placeholder="Instansi" name="instansi" required id="ajaxlogin_instansi" class="form-control input-lg" value="<?php echo $instansi; ?>" />
                            </div>
                            <div><label for="password">Sandi</label><input name="password" type="password" placeholder="Sandi" required id="ajaxlogin_password" class="form-control input-lg" />
                            </div>
                            <div><label for="password">Konfirmasi Sandi</label><input name="password_konfirmasi" type="password" placeholder="Konfirmasi Sandi" required id="ajaxlogin_password" class="form-control input-lg" />
                            </div>

                            <div><br><p><img src="captcha.php" width="200" height="50" border="1" alt="CAPTCHA"></p>
                            <p><input type="text" size="6" maxlength="5" name="captcha" id="captcha" value="" required/><br>
                            <small>Silahkan Isi Angka yang sesuai dengan Box</small></p>
                            </div>
                            .<div id="progress"><input type="submit" value="Daftarkan" id="ajaxlogin_submit" class="btn btn-lg btn-info btn-block" />
                            </div>

                        </form>

                        <a class="btn btn-danger btn-block btn-lg" href="registrasi.php" style="text-decoration:none;">Batal</a>
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