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
                            $ukuran_barang=$c->ukuran_barang;
                            $bahan_barang=$c->bahan_barang;
                            $kode_perusahaan=$c->kode_perusahaan;
                        }
                        echo base_url('barang/simpanubah/'.urlencode($kode_barang)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <label>Kode Barang *</label>
                            <input required class="form-control" placeholder="Masukan kode barang" name="kode_barang"
                            <?php if($status=='ubah'){echo "value=\"".$kode_barang."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang *</label>
                            <input required class="form-control" placeholder="Masukan nama barang" name="nama_barang"
                            <?php if($status=='ubah'){echo "value=\"".$nama_barang."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Ukuran *</label>
                            <input required class="form-control" placeholder="Masukan Ukuran barang" name="ukuran_barang"
                            <?php if($status=='ubah'){echo "value=\"".$ukuran_barang."\"" ;} ?>>
                        </div>
                        <div class="form-group">
                            <label>Bahan *</label>
                            <input required class="form-control" placeholder="Masukan Bahan barang" name="bahan_barang"
                            <?php if($status=='ubah'){echo "value=\"".$bahan_barang."\"" ;} ?>>
                        </div>
                         <div class="form-group">
                            <label>Perusahaan *</label>
                            <select id="kode_perusahaan" class="form-control" name="kode_perusahaan" required>
                               <?php 
                                    foreach ($getAllPerusahaan as $gAC) {
                                        if($status=='ubah' && $kode_perusahaan==$gAC->kode_perusahaan)
                                        {
                                        echo "<option value=".$gAC->kode_perusahaan." selected>".$gAC->nama_perusahaan."</option>";
                                        }
                                        else
                                        {
                                        echo " <option value=''>-- Pilih Perusahaan --</option>";
                                        }   
                                    }
                                    ?> 
                            </select>
                        </div>
                        <div class="col-lg-10"><a href="<?php echo base_url('barang');?>" class="btn btn-info pull-right">Kembali</a></div>
                        <div class="col-lg-2"><button type="submit" class="btn btn-success pull-right">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>