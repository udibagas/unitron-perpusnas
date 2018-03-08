<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="fa fa-filter"> Filter</h3>
    </div>
    <div class="panel-body">
        <form method="POST">
            <label class="control-label col-md-2 col-sm-4 col-xs-12">Berdasarkan Ruangan & Tanggal</label>
            <div class="col-md-2 col-sm-4 col-xs-12">
                <select name="filter1" class="select2_single form-control" tabindex="-1">
                    <option value="#">Pilih Ruang</option>
                    <?php
                    $sql=$konek->query("SELECT DISTINCT NAMALOKASI FROM sensor");
                    while ($data=$sql->fetch_assoc()) {
                        echo "<option value='$data[NAMALOKASI]'>$data[NAMALOKASI]</option>";
                    }
                    ?>
                </select>
                <?php
                if(isset($_POST['submit'])==true){
                echo "<h2>Filter Berdasarkan $_POST[filter1]</h2>";
                }
                ?>
            </div>

            <div class="col-md-2 col-sm-6 col-xs-12">
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="Tanggal Awal" aria-describedby="inputSuccess2Status" name="tgl_awal" data-toggle="tooltip" data-placement="top" title="<h2>Inputkan Tanggal Awal</h2>" >
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>


            <div class="col-md-2 col-sm-6 col-xs-12">
                <fieldset>
                    <div class="control-group">
                        <div class="controls">
                            <div class="col-md-11 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Tanggal Akhir" aria-describedby="inputSuccess2Status" name="tgl_akhir" data-toggle="tooltip" data-placement="top" title="<h2>Inputkan Tanggal Akhir</h2>">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="col-md-2 col-sm-4 col-xs-12">
                <input type="submit" name="submit" value="Filter" class="btn btn-success" />
            </div>
        </form>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        <h3 class="panel-title">Tren Keseluruhan</h3>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <div id="tren1" style="height:350px;"></div>
    </div>
</div>


<div class="row">
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tren 2</h3>
            </div>
            <div class="panel-body">
                <div id="tren2" style="height:350px;"></div>
            </div>
        </div>
    </div>

     <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tren 2</h3>
            </div>
            <div class="panel-body">
                <div id="tren3" style="height:350px;"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tren 2</h3>
            </div>
            <div class="panel-body">
                <div id="tren4" style="height:350px;"></div>
            </div>
        </div>
    </div>
</div>
