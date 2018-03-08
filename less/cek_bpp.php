<?php 
@session_start();
$idd = $_SESSION['id_req'];
include "koneksi.php";
$page = mysqli_real_escape_string($konek, $_GET['page']);

       $query = $konek->query("SELECT no_bpp,nama_bpp FROM step WHERE status='Y' AND link='$page'");
       $de = $query->fetch_assoc();

      $nobpp = $de['no_bpp'];
      $namabpp = $de['nama_bpp'];

      $status = "x";

      $query = $konek->query("SELECT pelaksana_bpp.step,users.`password`,users.no_indentitas FROM
pelaksana_bpp INNER JOIN users ON users.username = pelaksana_bpp.id_register WHERE pelaksana_bpp.id_register='$idd' AND pelaksana_bpp.aktif='Y' ORDER BY pelaksana_bpp.pelaksana_id DESC LIMIT 1"); 
    
      $data = $query->fetch_assoc();

      $step = $data['step'];

      $pecah = explode(',',$step);

      if($pecah[0]=="ALL"){

        $cnt = count($pecah)-1;
        for($a=1;$a<=$cnt;$a++){
             $pecahan = $pecah[$a];
             $query = $konek->query("SELECT step,no_bpp,nama_bpp FROM step WHERE id_step='$pecahan'");
             $dd = $query->fetch_assoc();
             $test = $dd['nama_bpp'];
             if($namabpp=="$test"){
              $status="b";
             }
              
        }

      }elseif($pecah[0]=="bagi"){
         $cnt = count($pecah)-1;

        for($a=1;$a<=$cnt;$a++){
             $pecahan = $pecah[$a];
             $query = $konek->query("SELECT step,no_bpp,nama_bpp FROM step WHERE id_step='$pecahan'");
             $dd = $query->fetch_assoc();
             if($nobpp=="$dd[no_bpp]" && $namabpp=="$dd[nama_bpp]"){
              $status="b";
             }
             echo "$pecah[$a] $cnt";
      }
    }

       $cek = $query->num_rows;

       if($_SESSION['level']=="admin"){
          $status="b";
       }

      if($status!="b"){
        //echo "<meta http-equiv='refresh' content='0;URL=media.php?page=404_nonakses' />";
      }
      //echo "$namabpp $pecah[0] $pecah[1]";

       ?>