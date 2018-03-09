<div class="row top_tiles">

    <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i id="gb_gas" class="fa fa-check"></i>
            </div>
            <div class="count" style="color:grey;" id="k_gas">0</div>

            <h3 id="t_gas">Kebocoran Gas</h3>

        </div>
    </div>
    <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i id="gb_air" class="fa fa-check"></i>
            </div>
            <div class="count" style="color:grey;" id="k_air">0</div>

            <h3 id="t_air">Air Normal</h3>

        </div>
    </div>
    <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i id="gb_suhu" class="fa fa-check"></i>
            </div>
            <div class="count" style="color:grey;" id="k_suhu">0</div>

            <h3 id="t_suhu">Suhu Normal</h3>

        </div>
    </div>
     <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i id="gb_lembab" class="fa fa-check"></i>
            </div>
            <div class="count" style="color:grey;" id="k_lembab">0</div>

            <h3 id="t_lembab">Lembab Normal</h3>

        </div>
    </div>

    <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i style="color:green;" id="gb_pue" class="fa fa-leaf"></i>
            </div>
            <div class="count" style="color:green;" id="pue">0</div>

            <h3 id="t_pue">PUE</h3>

        </div>
    </div>

    <div class="animated flipInY col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i style="color:green;" id="gb_daya" class="fa fa-bolt"></i>
            </div>
            <div class="count" style="color:green;" id="k_daya">0</div>

            <h3 id="t_daya">Daya PLN (KW)</h3>

        </div>
    </div>
</div>

<script type="text/javascript">

    setIntervalAndExecute(function (){
    $.getJSON("less/jfss.php", function(json) {

        var nilai = json['k_gas'];
        var nilai_air = json['k_air'];
        var nilai_suhu = json['k_suhu'];
        var nilai_lembab = json['k_lembab'];
        var nilai_daya = json['k_daya'];
        var PUE = json['PUE'];

        if (nilai_daya > 0) {
            nilai_daya =nilai_daya.substr(0,5);
        }

        else {
            nilai_daya = 0;
        }

        if (PUE > 0) {
            PUE =PUE.substr(0,4);
        } else {
            PUE = 0;
        }

        document.getElementById("kondisi_alert").style.display = 'block';

        if(nilai>0){
            document.getElementById("k_gas").style.color = 'red';
            document.getElementById("gb_gas").style.color = 'red';
            document.getElementById("gb_gas").className = 'fa-fire';
             document.getElementById("t_gas").style.color = 'red';
            document.getElementById("t_gas").innerHTML = 'Gas Tidak Normal';
        }else{
            document.getElementById("k_gas").style.color = 'green';
            document.getElementById("gb_gas").style.color = 'green';
            document.getElementById("gb_gas").className = 'fa fa-check';
            document.getElementById("t_gas").style.color = 'green';
            document.getElementById("t_gas").innerHTML = 'Gas Normal';
        }
         if(nilai_air>0){
            document.getElementById("k_air").style.color = 'red';
            document.getElementById("gb_air").style.color = 'red';
            document.getElementById("gb_air").className = 'fa-tint';
            document.getElementById("t_air").style.color = 'red';
            document.getElementById("t_air").innerHTML = 'Air Tidak Normal';
        }else{
            document.getElementById("k_air").style.color = 'green';
            document.getElementById("gb_air").style.color = 'green';
            document.getElementById("gb_air").className = 'fa fa-check';
            document.getElementById("t_air").style.color = 'green';
            document.getElementById("t_air").innerHTML = 'Air Normal';
        }
         if(nilai_suhu>0){
            document.getElementById("k_suhu").style.color = 'red';
            document.getElementById("gb_suhu").style.color = 'red';
            document.getElementById("gb_suhu").className = 'fa fa-exclamation-triangle';
            document.getElementById("t_suhu").style.color = 'red';
            document.getElementById("t_suhu").innerHTML = 'Suhu Tidak Normal';
        }else{
            document.getElementById("k_suhu").style.color = 'green';
            document.getElementById("gb_suhu").style.color = 'green';
            document.getElementById("gb_suhu").className = 'fa fa-check';
            document.getElementById("t_suhu").style.color = 'green';
            document.getElementById("t_suhu").innerHTML = 'Suhu Normal';
        }
         if(nilai_lembab>0){
            document.getElementById("k_lembab").style.color = 'red';
            document.getElementById("gb_lembab").style.color = 'red';
            document.getElementById("gb_lembab").className = 'fa fa-exclamation-circle';
            document.getElementById("t_lembab").style.color = 'red';
            document.getElementById("t_lembab").innerHTML = 'Lembab Tidak Normal';
        }else{
            document.getElementById("k_lembab").style.color = 'green';
            document.getElementById("gb_lembab").style.color = 'green';
            document.getElementById("gb_lembab").className = 'fa fa-check';
            document.getElementById("t_lembab").style.color = 'green';
            document.getElementById("t_lembab").innerHTML = 'Lembab Normal';
        }


         if(PUE>=3){
            document.getElementById("pue").style.color = 'orange';
            document.getElementById("gb_pue").style.color = 'orange';
            document.getElementById("t_pue").style.color = 'orange';
            document.getElementById("t_pue").innerHTML = 'PUE(Tidak Efisien)';
        }else if(PUE>=2){
             document.getElementById("pue").style.color = 'Green';
            document.getElementById("gb_pue").style.color = 'Green';
            document.getElementById("t_pue").style.color = 'Green';
            document.getElementById("t_pue").innerHTML = 'PUE(Efisien)';
        }else if(PUE<2){
             document.getElementById("pue").style.color = 'Green';
            document.getElementById("gb_pue").style.color = 'Green';
            document.getElementById("t_pue").style.color = 'Green';
            document.getElementById("t_pue").innerHTML = 'PUE(Sangat Efisien)';
        }

         document.getElementById("k_gas").innerHTML=nilai;
         document.getElementById("k_air").innerHTML=nilai_air;
         document.getElementById("k_suhu").innerHTML=nilai_suhu;
         document.getElementById("k_lembab").innerHTML=nilai_lembab;
         document.getElementById("k_daya").innerHTML=nilai_daya;
         document.getElementById("pue").innerHTML=PUE;

      });
    },2000);

</script>
