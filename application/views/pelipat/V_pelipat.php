     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Pelipat</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('pelipat/simpan'); }
                    else 
                    { 
                        foreach($pelipat as $c){
                            $kode_pelipat=$c->kode_pelipat;
                            $nama_pelipat=$c->nama_pelipat;
                            $telpon=$c->telpon;
                            $alamat=$c->alamat;
                            $keterangan=$c->keterangan;
                        }
                        echo base_url('pelipat/simpanubah/'.urlencode($kode_pelipat)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Pelipat</label>
                            <input class="form-control" placeholder="Masukan kode pelipat" name="kode_pelipat"
                            <?php if($status=='ubah'){echo "value=\"".$kode_pelipat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Pelipat</label>
                            <input class="form-control" placeholder="Masukan nama pelipat" name="nama_pelipat"
                            <?php if($status=='ubah'){echo "value=\"".$nama_pelipat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" placeholder="Masukan telepon pelipat" name="telpon"
                            <?php if($status=='ubah'){echo "value=\"".$telpon."\"" ;} ?> type="number" min="0">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" placeholder="Masukan alamat pelipat" name="alamat"
                            <?php if($status=='ubah'){echo "value=\"".$alamat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input class="form-control" placeholder="Masukan keterangan" name="keterangan"
                            <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('pelipat');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>