     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Sumber Transaksi</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('sumber_transaksi/simpan'); }
                    else 
                    { 
                        foreach($sumber_transaksi as $c){
                            $kode_sumber_transaksi=$c->kode_sumber_transaksi;
                            $nama_sumber_transaksi=$c->nama_sumber_transaksi;
                        }
                        echo base_url('sumber_transaksi/simpanubah/'.urlencode($kode_sumber_transaksi)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Sumber Transaksi</label>
                            <input class="form-control" placeholder="Masukan kode sumber_transaksi" name="kode_sumber_transaksi"
                            <?php if($status=='ubah'){echo "value=\"".$kode_sumber_transaksi."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Sumber Transaksi</label>
                            <input class="form-control" placeholder="Masukan nama sumber_transaksi" name="nama_sumber_transaksi"
                            <?php if($status=='ubah'){echo "value=\"".$nama_sumber_transaksi."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('sumber_transaksi');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>