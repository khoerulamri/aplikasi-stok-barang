     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Pemesanan per PJ</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                   echo base_url('laporan/laporanPemesananPerPJPDF'); ?>" method="post">
                        <div class="box-header">
                              <h3 class="box-title">Pilih Rentang Laporan</h3>
                            </div>
                            <div class="box-body">
                              <!-- Date -->
                              <div class="form-group">
                                <label>Tanggal Dari :</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right" name="tgldari" id="tgldari" data-inputmask="'alias': 'dd-mm-yyyy'" required>
                                </div>
                                <!-- /.input group -->
                              </div>
                              <!-- Date -->
                              <div class="form-group">
                                <label>Tanggal Sampai :</label>

                                <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                                  <input type="text" class="form-control pull-right"  name="tglsampai" id="tglsampai" data-inputmask="'alias': 'dd-mm-yyyy'" required>
                                </div>
                                <!-- /.input group -->
                              </div>
                              <!-- /.form group -->
                        </div>
                        <div class="pull-right">
                          <span><a href="<?php echo base_url('dashboard');?>" class="btn btn-primary">Kembali</a></span>
                          <span><button type="submit" class="btn btn-primary"><i class="fa fa-download"></i> Generate File</button>
                          </span>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </section>
