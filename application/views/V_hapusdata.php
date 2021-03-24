     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Hapus Data Transaksi</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php echo base_url('hapusdata/hapus');?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <label>Tanggal Dari *</label>
                            <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" id="tgldari" name="tgldari" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Sampai *</label>
                            <input type="text" class="form-control" value="<?php echo date('d-m-Y'); ?>" id="tglsampai" name="tglsampai" required>
                        </div>
                        <div class="form-group">
                            <label>Transaksi yang Dihapus</label>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"  id="dataproduksi" name="dataproduksi"> Data Transaksi Produksi
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"  id="datagudang" name="datagudang"> Data Transaksi Gudang
                              </label>
                            </div>
                            <div class="checkbox">
                              <label>
                                <input type="checkbox"  id="datapenjualan" name="datapenjualan"> Data Transaksi Penjualan
                              </label>
                            </div>
                            

                        </div>
                        <div class="col-lg-8">
                            <div class="checkbox pull-right">
                              <label>
                                <input type="checkbox" required> Saya Yakin akan Menghapus data ini.
                              </label>
                          </div>
                        </div>
                         <div class="col-lg-4">
                          <button type="submit" class="btn btn-danger pull-right">Hapus</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </section>