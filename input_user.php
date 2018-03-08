 	
	<div class="row">
    	<div class="abcdefg">
      		 <div class="panel panel-success">
                   <div class="panel-heading">
                  		<h2><i class="fa fa-bars"></i> Input User <small></small></h2>
                   	<div class="clearfix"></div>
                   </div>                    
        		<div class="panel-body">
        		<form method="POST" action="less/aksi.php?tipe=users&module=input" class="form-horizontal form-label-left" enctype="multipart/form-data">

        			<div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Tipe User <span class="required">*</span>
				      </label>
				       <div class="col-md-2 col-sm-6 col-xs-12">
				          <select name="tipe" id="tipe" class="form-control">
				          <option value="#">Pilih Tipe</option>
				          <option value="pns">PNS</option>
				          <option value="non-pns">NON-PNS</option>
				          </select>
				       </div>
				    </div>


				 	<div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Username <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				          <input class="form-control" type="text" name="username" id="username" placeholder="Username" /> 
				       </div>
				    </div>

				    <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Password <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				          <input class="form-control" type="password" id="password" name="password" placeholder="Password" />
				       </div>
				    </div>

				    <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Nama Pelaksana <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				          <input class="form-control" type="text" id="nama_pelaksana" name="nama_pelaksana" placeholder="Nama Pelaksana" /> 
				       </div>
				    </div>

				    <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Email <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				          <input class="form-control" type="email" id="email" name="email" placeholder="Email" /> 
				       </div>
				    </div>

				    <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Instansi <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				          <input class="form-control" type="text" id="instansi" name="instansi" placeholder="Instansi" /> 
				       </div>
				    </div>

				    <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">Kategori <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				        <select name="kategori" id="kategori" class="form-control">
				        <option value=''>Pilih Kategori</option>
				        <option value='ALL'>ALL</option>
                                                  <?php 	
                                                  	$n=1;
                                                  	$qq = $konek->query("SELECT id_step,nama_bpp,no_bpp FROM step WHERE status='Y' GROUP BY nama_bpp ORDER by id_step");
                                                  	while($data=$qq->fetch_assoc()){
                                                   ?>
                                                  	<option value="<?php echo $data['nama_bpp']; ?>">
                                                       <?php echo $data['nama_bpp']; ?>
                                                       </option>

                                                   <?php $n++; } ?>

                                                   </select>               
				       </div>
				    </div>

				      <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan">BPP Akses <span class="required">*</span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12" id="isi">
				         
				       </div>
				    </div>

				     <div class="item form-group">
				      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tujuan"><span class="required"></span>
				      </label>
				       <div class="col-md-8 col-sm-6 col-xs-12">
				         <input type="submit" name="simpan" class="btn btn-info" value="Simpan" />
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

    <script type="text/javascript">
            $(document).ready(function(){

            $('#tipe').change(function(){
            	var id=$(this).val();

            	if(id=="pns"){
                    document.getElementById("password").readOnly =true;
                    document.getElementById("nama_pelaksana").readOnly =true;
                    document.getElementById("email").readOnly =true;
                    document.getElementById("instansi").readOnly =true;

                $('#username').typeahead({
                name: 'username',
                remote: 'less/pegawai.php?query=%QUERY'
            });

            	}else if(id=="non-pns"){
            		document.getElementById("password").readOnly =false;
                    document.getElementById("nama_pelaksana").readOnly =false;  
                    document.getElementById("email").readOnly =false;
                    document.getElementById("instansi").readOnly =false;     
                    document.getElementById("password").value ="";
                    document.getElementById("nama_pelaksana").value ="";
                    document.getElementById("username").value ="";
                    document.getElementById("email").value ='';
                    document.getElementById("instansi").value ='';
            	}

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
                        $.each(json, function(index, row) {
                            document.getElementById("password").value =row.password;
                            document.getElementById("nama_pelaksana").value =row.nama_lengkap;
                            document.getElementById("email").value =row.email;
                            document.getElementById("instansi").value =row.nalokl;
                        });
                    });
                };

			    $('#username').on('change keyup paste click blur',ambil);


            });
        </script>