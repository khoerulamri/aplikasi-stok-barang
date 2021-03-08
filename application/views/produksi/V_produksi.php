     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Produksi</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('produksi/simpan'); }
                    else 
                    { 
                        foreach($produksi as $c){
                            $id_transaksi_produksi=$c->id_transaksi_produksi;
                            $tgl_input=$c->tgl_input;
                            $kode_petugas=$c->kode_petugas;
                            $kode_barang=$c->kode_barang;
                            $qty=$c->qty;
                            $tgl_produksi=$c->tgl_produksi;
                            $kode_sumber_transaksi=$c->kode_sumber_transaksi;
                            $keterangan=$c->keterangan;
                        }   


                        if ('01-01-1970'==$tgl_input || '0000-00-00' == $tgl_input) {
                            $tgl_input='';
                        }
                        else
                        {
                            $tgl_input=date('d-m-Y',strtotime($tgl_input));
                        }
                        if ('01-01-1970'==$tgl_produksi || '0000-00-00' == $tgl_produksi) {
                            $tgl_produksi='';
                        }
                        else
                        {
                            $tgl_produksi=date('d-m-Y',strtotime($tgl_produksi));
                        }
                        echo base_url('produksi/simpanubah/'.urlencode($id_transaksi_produksi)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <!-- <label>id_transaksi_produksi</label> -->
                            <input type="hidden" class="form-control" placeholder="Masukan kode order"  name="id_transaksi_produksi"
                            <?php if($status=='ubah'){echo "value=\"".$id_transaksi_produksi."\"" ;} ?> required>
                        </div>
						<div class="form-group">
                            <!--<label>Tanggal Input</label>-->
                            <input type="hidden" type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_input));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_input" name="tgl_input" required>
                        </div>
						<div class="form-group">
                            <label>Tanggal Produksi *</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_produksi));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_produksi" name="tgl_produksi" required>
                        </div>
                        <div class="form-group">
                            <label>Barang</label>
							<select  id="barang" class="form-control" name="kode_barang" required>
                                <?php 
                                    foreach ($getAllBarang as $gAC) {
                                        if($status=='ubah' && $kode_barang==$gAC->kode_barang)
                                        {
                                        echo "<option value=".$gAC->kode_barang." selected>".$gAC->nama_barang." - ".$gAC->ukuran_barang." - ".$gAC->bahan_barang."</option>";
                                        }
                                        else
                                        {
                                        echo " <option value=''>-- Pilih Barang --</option>";
                                        }   
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah *</label>                                          
                            <input class="form-control" placeholder="Masukan jumlah barang"  type="number" <?php if($status=='ubah'){echo "value=\"".$qty."\"" ;} ?>  name="qty" required>
                        </div>
						<div class="form-group">
                            <label>Sumber Transaksi *</label>
							<select id="sumber_transaksi" class="form-control" name="kode_sumber_transaksi" required>
                               <?php 
                                    foreach ($getAllsumber_transaksi as $gAC) {
                                        if($status=='ubah' && $kode_sumber_transaksi==$gAC->kode_sumber_transaksi)
                                        {
                                        echo "<option value=".$gAC->kode_sumber_transaksi." selected>".$gAC->nama_sumber_transaksi."</option>";
                                        }
                                        else
                                        {
                                        echo " <option value=''>-- Pilih Sumber Transaksi --</option>";
                                        }   
                                    }
                                    ?> 
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Keterangan </label>                                          
                            <input class="form-control" placeholder="Masukan keterangan tambahan"   <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>  name="keterangan" >
                        </div>							
                       <div class="pull-right"><a href="<?php echo base_url('produksi');?>" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
           </div>
       </section>
