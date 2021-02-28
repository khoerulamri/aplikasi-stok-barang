     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Petugas</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('petugas/simpan'); }
                    else 
                    { 
                        foreach($petugas as $p){
                            $kode_petugas=$p->kode_petugas;
                            $nama_petugas=$p->nama_petugas;
                            $user_name=$p->user_name;
                            $pass_word=$p->pass_word;
                            $kode_hak_akses=$p->kode_hak_akses;
                        }
                        echo base_url('petugas/simpanubah/'.urlencode($kode_petugas)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <label>Kode Petugas *</label>
                            <input required class="form-control" placeholder="Masukan kode petugas" name="kode_petugas"
                            <?php if($status=='ubah'){echo "value=\"".$kode_petugas."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Petugas *</label>
                            <input required class="form-control" placeholder="Masukan nama petugas" name="nama_petugas"
                            <?php if($status=='ubah'){echo "value=\"".$nama_petugas."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" placeholder="Masukan username petugas" name="user_name"
                            <?php if($status=='ubah'){echo "value=\"".$user_name."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" placeholder="Masukan password petugas" name="pass_word"
                            <?php if($status=='ubah'){echo "value=\"".$pass_word."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Hak Akses</label>
                            <input class="form-control" placeholder="Masukan Hak Akses" name="kode_hak_akses"
                            <?php if($status=='ubah'){echo "value=\"".$kode_hak_akses."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('petugas');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>