     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Password</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php echo base_url('savepassword')?>" method="post">
                        <div class="form-group">
                            <label>Ketikan Password Lama :</label>
                            <input class="form-control" placeholder="Masukan password lama" name="password_lama" type="password" required>
                        </div>
                        <div class="form-group">
                            <label>Ketikan Password Baru</label>
                            <input class="form-control" placeholder="Masukan password baru" name="password_baru" type="password" required>
                        </div>
                       <div class="form-group">
                            <label>Ketikan Password Baru Lagi</label>
                            <input class="form-control" placeholder="Masukan password baru lagi" name="password_baru_lagi" type="password" required>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('dashboard');?>" class="btn btn-primary pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-primary pull-right">Simpan</button></div>
					</form>
                </div>
            </div>
        </div>
    </section>
