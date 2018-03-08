<?php 

    @session_start();
    if(isset($_SESSION['username'])==false)
    {
        echo "<meta http-equiv='refresh' content='0;URL=menu_login.php' />";
    }

?>
  <div class="clearfix">	</div>
  <a href="?page=peta_tampil"> <div class="" id="kondisi_alert" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">X</span>
                                    </button>
                                    <strong><marquee><h1 id="kondisi"></h1></marquee></strong>
                                </div></a> 



<script type="text/javascript">
  


setIntervalAndExecute(function (){
            $.getJSON("less/cek.php", function(json) {
              var pesan;
              var i=0;


                  if(json!=''){

                    pesan = "Kondisi Alarm ! "
                      if(document.getElementById("server_a")){
                      document.getElementById("server_a").className="gambar";
                      document.getElementById("staff_a").className="gambar";
                      document.getElementById("pac_a").className="gambar";
                      document.getElementById("command_a").className="gambar";
                      document.getElementById("noc_a").className="gambar";
                      document.getElementById("powerb_a").className="gambar";
                      document.getElementById("powera_a").className="gambar";
                     
 }                        
                    for(i=0;i<json.length;i++){
                    pesan=pesan+[String(json[i].pesan)]+', ';
                    cek_pesan = [String(json[i].pesan)];
                     var lokasi = [String(json[i].NAMALOKASI)];
                     var posisi = [String(json[i].POSISIDETAIL)];

          //$("#prb1")
          //.attr('data-original-title', pesan)
          //.tooltip('fixTitle')
          // ;

                   if(lokasi=="Ruang Server"){
                    if(document.getElementById("server_a") && cek_pesan!=""){ 
                        document.getElementById("server_a").className="gambar blink_me alarm";
                     }
                   }
                   if(lokasi=="Ruang Power-A"){
                    if(document.getElementById("powera_a")){ 
                        document.getElementById("powera_a").className="gambar blink_me alarm";
                     }
                   }
                    if(lokasi=="Ruang Power-B"){
                    if(document.getElementById("powerb_a")){ 
                        document.getElementById("powerb_a").className="gambar blink_me alarm";

                     }
                   }
                   

                     if(lokasi=="Ruang PAC"){
                    if(document.getElementById("pac_a")){ 
                        document.getElementById("pac_a").className="gambar blink_me alarm";
                     }
                   }

                   if(posisi=="Ruang NOC"){
                    if(document.getElementById("noc_a")){ 
                        document.getElementById("noc_a").className="gambar blink_me alarm";
                     }
                   }


                   }

                   document.getElementById("kondisi_alert").className="alert alert-danger alert-dismissible fade in blink_me";
                   document.getElementById("kondisi").innerHTML=pesan;
                   document.getElementById("kondisi_alert").style.display = 'absolute';
                   document.getElementById("setan").style.display = 'block';

               	  }else{
                    if(document.getElementById("server_a")){
                      document.getElementById("server_a").className="gambar";
                      document.getElementById("staff_a").className="gambar";
                      document.getElementById("pac_a").className="gambar";
                      document.getElementById("command_a").className="gambar";
                      document.getElementById("noc_a").className="gambar";
                      document.getElementById("powerb_a").className="gambar";
                      document.getElementById("powera_a").className="gambar";
                        }

               	   document.getElementById("kondisi_alert").className="";
               	   document.getElementById("kondisi").innerHTML="";
               	   document.getElementById("kondisi_alert").style.display = 'none';
                   document.getElementById("setan").style.display = 'none';
               	  }
              });

              //option<?php //echo $b; ?>.series[0].data[0].value = nilai;

},2000);



</script>



