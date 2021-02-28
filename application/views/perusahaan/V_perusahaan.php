     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Perusahaan</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('perusahaan/simpan'); }
                    else 
                    { 
                        foreach($perusahaan as $c){
                            $kode_perusahaan=$c->kode_perusahaan;
                            $nama_perusahaan=$c->nama_perusahaan;
                            $telpon=$c->telpon;
                            $alamat=$c->alamat;
                            $keterangan=$c->keterangan;
                        }
                        echo base_url('perusahaan/simpanubah/'.urlencode($kode_perusahaan)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <label>Kode Perusahaan *</label>
                            <input required class="form-control" placeholder="Masukan kode perusahaan" name="kode_perusahaan"
                            <?php if($status=='ubah'){echo "value=\"".$kode_perusahaan."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Perusahaan *</label>
                            <input required class="form-control" placeholder="Masukan nama perusahaan" name="nama_perusahaan"
                            <?php if($status=='ubah'){echo "value=\"".$nama_perusahaan."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" placeholder="Masukan telepon perusahaan" name="telpon"
                            <?php if($status=='ubah'){echo "value=\"".$telpon."\"" ;} ?> type="number" min="0">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" placeholder="Masukan alamat perusahaan" name="alamat"
                            <?php if($status=='ubah'){echo "value=\"".$alamat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input class="form-control" placeholder="Masukan keterangan" name="keterangan"
                            <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('perusahaan');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>

                    </form>
                </div>
            </div>
        </div>
    </section>