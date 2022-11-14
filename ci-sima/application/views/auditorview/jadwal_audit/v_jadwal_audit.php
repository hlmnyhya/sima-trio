<div class="wrapper wrapper-content m-t-xl wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-horizontal" method="post" action="<?php echo base_url(
                'audit/post_jadwal_audit'
            ); ?>" id="FormJadwalAudit">
                <div class="panel panel-primary">
                    <div class="panel-heading">

                        <div class="col-lg-10">
                            <h4><i class="fa fa-info-circle"></i> Input Jadwal Audit</h4>
                        </div>
                        <div>
                            <a href="<?php echo base_url(
                                'audit/input_jadwal'
                            ); ?>" type="submit" class="btn btn-m btn-danger">Cancel</a>
                            <button type="submit" class="btn btn-success btn-m" id="btn-simpan">Submit</button>
                        </div>
                    </div>

                    <?php
                    $noUrut = $code;
                    $noUrut++;
                    $id = 'AUDIT' . sprintf('%05s', $noUrut);
                    ?>
                    <div class="panel-body">
                        <div class="form-group"><label class="col-sm-2 control-label">ID Jadwal Audit</label>
                            <div class="col-sm-5"><input type="text" class="form-control" name="idjadwal_audit" id="idjadwal_audit" value="<?php echo $id; ?>" readonly></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Auditor</label>
                            <div class="col-sm-5"><select class="form-control m-b" name="auditor" id="auditor">
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Jenis Audit</label>
                            <div class="col-sm-5">
                                <select class="form-control m-b" name="idjenis_audit" id="Optjenisaudit">
                                </select>
                            </div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Cabang</label>
                            <div class="col-sm-5"><select class="form-control" name="id_cabang" id="Optcabang"></select>
                            </div>
                        </div>

                        <!-- <div class="form-group"><label class="col-sm-2 control-label">Lokasi</label>
                                    <div class="col-sm-5"><select class="form-control m-b" name="id_lokasi"  id="Optlokasi" disabled="">
                                    </select>
                                    </div>
                                </div> -->

                        <div class="form-group" id="data_1"><label class="col-sm-2 control-label">Tanggal</label>
                            <div class="col-sm-5">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $tgl; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label class="col-sm-2 control-label">Waktu</label>
                            <div class="col-sm-3">
                                <span id="date_time"></span>
                                <?php
                                date_default_timezone_set('Asia/Makassar');    
                                $wita = date('H:i');
                                $wib = date('H:i',strtotime('-1 hour', strtotime($wita))
                                );   
                                ?>
                                <div class="input-group clockpicker " data-autoclose="true">
                                    <input type="text" class="form-control" name="waktu" id="waktu" value="<?php echo $wita; ?>">
                                    <div class="input-group-addon">
                                        <span class="fa fa-clock-o"></span>
                                        <span>
                                        </span>
                                </div>
                            </div>  
                                
                        </div>
                        
                            <div class="form-group col-sm-2 ">
                            <div class="">
                                <select class="form-control js-example-basic-single" name="zone" id="zone" onchange="timezone()">
                                <option value="<?php echo $wita; ?>">WITA</option>
                                <option value="<?php echo $wib; ?>">WIB</option>
                            </select>
                            </div>
                        </div>  
                            </div>
                        </div>
                        <!-- <input type="hidden" name="data_insert" id="data_insert" value="Insert"/> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>