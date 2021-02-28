     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data Customer</h3>
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('customer/simpan'); }
                    else 
                    { 
                        foreach($customer as $c){
                            $kode_customer=$c->kode_customer;
                            $nama_customer=$c->nama_customer;
                            $telpon=$c->telpon;
                            $alamat=$c->alamat;
                            $keterangan=$c->keterangan;
                        }
                        echo base_url('customer/simpanubah/'.urlencode($kode_customer)); };?>" method="post">
                        <div class="form-group">
                            <label>Kode Customer</label>
                            <input class="form-control" placeholder="Masukan kode customer" name="kode_customer"
                            <?php if($status=='ubah'){echo "value=\"".$kode_customer."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Customer</label>
                            <input class="form-control" placeholder="Masukan nama customer" name="nama_customer"
                            <?php if($status=='ubah'){echo "value=\"".$nama_customer."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input class="form-control" placeholder="Masukan telepon customer" name="telpon"
                            <?php if($status=='ubah'){echo "value=\"".$telpon."\"" ;} ?> type="number" min="0">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" placeholder="Masukan alamat customer" name="alamat"
                            <?php if($status=='ubah'){echo "value=\"".$alamat."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input class="form-control" placeholder="Masukan keterangan" name="keterangan"
                            <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('customer');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>