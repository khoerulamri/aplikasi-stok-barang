     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Barang</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('barang/simpan'); }
                    else 
                    { 
                        foreach($barang as $c){
                            $kode_barang=$c->kode_barang;
                            $nama_barang=$c->nama_barang;
                        }
                        echo base_url('barang/simpanubah/'.urlencode($kode_barang)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Barang</label>
                            <input class="form-control" placeholder="Masukan kode barang" name="kode_barang"
                            <?php if($status=='ubah'){echo "value=\"".$kode_barang."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input class="form-control" placeholder="Masukan nama barang" name="nama_barang"
                            <?php if($status=='ubah'){echo "value=\"".$nama_barang."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('barang');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>