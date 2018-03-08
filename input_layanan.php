

    
    <?php
    if(isset($_GET['id'])==true){
      $id=mysqli_real_escape_string($konek, $_GET['id']);
       $sql = $konek->query("SELECT layanan.id_layanan,layanan.nama_layanan,layanan.link,layanan.pemilik_layanan,layanan.defenisi_layanan,layanan.level_layanan,layanan.tidak_layanan,layanan.ketersediaan_layanan,layanan.BPP,layanan.SOP,layanan.`status`,kategori_layanan.kategori_layanan,kategori_layanan.id_kategori_layanan FROM layanan INNER JOIN kategori_layanan ON kategori_layanan.id_kategori_layanan = layanan.id_kategori_layanan WHERE layanan.id_layanan='$id'");
        $data3=$sql->fetch_assoc();
        $id_layanan = $data3['id_layanan'];
        $defenisi_layanan = $data3['defenisi_layanan'];
        $level_layanan = $data3['level_layanan'];
        $tidak_layanan = $data3['tidak_layanan'];
        $ketersediaan_layanan = $data3['ketersediaan_layanan'];
        $BPP = $data3['BPP'];
        $SOP = $data3['SOP'];
        $status = $data3['status'];
        $kategori_layanan = $data3['kategori_layanan'];
        $id_kategori_layanan = $data3['id_kategori_layanan'];
        $nama_layanan = $data3['nama_layanan'];
        $pemilik_layanan = $data3['pemilik_layanan'];
        $link = $data3['link'];
        $perintah="edit";
        }else{
        $id_layanan = "";
        $defenisi_layanan = "";
        $level_layanan = "";
        $tidak_layanan = "";
        $ketersediaan_layanan = "";
        $BPP = "";
        $SOP = "";
        $status = "";
        $kategori_layanan = "Pilih Kategori";
        $id_kategori_layanan = "#";
        $nama_layanan = "";
        $pemilik_layanan = "";
        $perintah="";
        $link = "";
    }
    ?>

	<div class="row">
    	<div class="abcdefg">
      		 <div class="panel panel-success">
                   <div class="panel-heading">
                  		<h2><i class="fa fa-bars"></i> Manajemen Katalog Layanan <small></small></h2>
                   	<div class="clearfix"></div>
                   </div>                    
        		<div class="panel-body">
            <?php if($perintah!="edit"){ ?>
        		<form method="POST" action="less/aksi.php?tipe=katlay&module=input" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <?php } 
            else{ ?>
              <form method="POST" action="less/aksi.php?tipe=katlay&module=edit&id=<?php echo $id ; ?>" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <?php  } ?>

                <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Kategori <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                          <select class="form-control" name="kategori">
                          <option value="<?php echo $id_kategori_layanan; ?>"><?php echo $kategori_layanan; ?></option>
                          <?php $sql = $konek->query("SELECT * FROM kategori_layanan ORDER BY id_kategori_layanan");
                          while($data11=$sql->fetch_assoc()){
                           ?>
                          <option value="<?php echo $data11['id_kategori_layanan']; ?>"><?php echo $data11['kategori_layanan']; ?></option>
                          <?php } ?>
                          </select>
                       </div>
                    </div>

                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Pemilik Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                       <textarea class="form-control ckeditor" type="text" name="pemilik_layanan" id="pemilik_layanan" placeholder="Pemilik Layanan"><?php echo $pemilik_layanan;?></textarea>
                       </div>
                    </div>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Nama Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                       <textarea class="form-control ckeditor" type="text" name="nama_layanan" id="nama_layanan" placeholder="Nama Layanan"><?php echo $nama_layanan;?></textarea>
                       </div>
                    </div>

  
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Defenisi Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                          <textarea class="form-control ckeditor" type="text" name="defenisi_layanan" id="defenisi_layanan" placeholder="Defenisi Layanan"><?php echo $defenisi_layanan;?></textarea>
                       </div>
                    </div>

                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Level Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                       <textarea class="form-control ckeditor" type="text" name="level_layanan" id="level_layanan" placeholder="Level Layanan"><?php echo $level_layanan;?></textarea>
                       </div>
                    </div>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Tidak Termasuk Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                       <textarea class="form-control ckeditor" type="text" name="tidak_layanan" id="tidak_layanan" placeholder="Tidak Termasuk Layanan"><?php echo $tidak_layanan;?></textarea>
                       </div>
                    </div>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan"> Ketersedian Layanan <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea class="form-control ckeditor" type="text" name="ketersediaan_layanan" id="tidak_layanan" placeholder="Ketersedian Layanan"><?php echo $ketersediaan_layanan;?></textarea>
                       </div>
                    </div>

                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">BPP <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea class="form-control ckeditor" type="text" name="BPP" id="BPP" placeholder="Bussinness Process Procedure"><?php echo $BPP;?></textarea>
                       </div>
                    </div>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">SOP <span class="required">*</span>
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                        <textarea class="form-control ckeditor" type="text" name="SOP" id="SOP" placeholder="Standart Operation Procedure"><?php echo $SOP;?></textarea>
                         
                       </div>
                    </div>

                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Link 
                      </label>
                       <div class="col-md-8 col-sm-6 col-xs-12">
                        <input class="form-control" type="text" name="link" placeholder="Link Layanan " value="<?php echo $link;?>" />
                         
                       </div>
                       </div>

				     <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan"><span class="required"></span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				         <input type="submit" name="simpan" class="btn btn-info" value="Simpan"  />
				       </div>
				    </div>

				    </form>
    			</div>
    		</div>
    	</div>
    </div>
    
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="js/typeahead.js"></script>

    <style>

     	  .tt-hint{
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

    	 .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }


    </style>

    <script src="js/ckeditor/ckeditor.js" type="text/javascript"></script>
    <script type="text/javascript">
            $(document).ready(function(){
                    document.getElementById("password").readOnly =true;
                    document.getElementById("nama_pelaksana").readOnly =true;
                    document.getElementById("email").readOnly =true;
                    document.getElementById("instansi").readOnly =true;

                $('#username').typeahead({
                name: 'username',
                remote: 'less/pegawai.php?query=%QUERY'
            });
	 var no = 1;
                $('#kategori').change(function(){
                    $.getJSON('less/jstep.php',{action:'get_step', kategori:$(this).val()}, function(json){
                        $('#isi').html('');
                        $.each(json, function(index, row) {
                            $('#isi').append('<input type="checkbox" class="flat" name="id_step'+no+'" value="'+row.id_step+'">'+row.nama_bpp+'-'+row.no_bpp+' <input type="hidden" name="kode" value="'+row.kode+'" /> ');
                            no=no+1;
                        });
                    });
                });

                function ambil(){
                	$.getJSON('less/pegawai1.php',{action:'get_pegawai', username:$(this).val()}, function(json){
                        if(json!=""){
                        $.each(json, function(index, row) {
                            document.getElementById("password").value =row.password;
                            document.getElementById("nama_pelaksana").value =row.nama_lengkap;
                            document.getElementById("email").value =row.email;
                            document.getElementById("instansi").value =row.nalokl;
                        });
                    }else{
                             document.getElementById("password").value ='';
                            document.getElementById("nama_pelaksana").value ='';
                            document.getElementById("email").value ='';
                            document.getElementById("instansi").value ='';
                    }
                    });
                };

			    $('#username').on('change keyup paste click blur',ambil);


            });
        </script>