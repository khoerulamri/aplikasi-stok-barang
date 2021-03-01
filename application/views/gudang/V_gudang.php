     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Gudang</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('gudang/simpan'); }
                    else 
                    { 
                        foreach($gudang as $c){
                            $id_transaksi_gudang=$c->id_transaksi_gudang;
                            $id_transaksi_produksi=$c->id_transaksi_produksi;
                            $tgl_input=$c->tgl_input;
                            $tgl_serahkan=$c->tgl_serahkan;
                            $kode_pelipat=$c->kode_pelipat;
                            $qty=$c->qty;
                            $keterangan=$c->keterangan;
                        }   


                        if ('01-01-1970'==$tgl_serahkan || '0000-00-00' == $tgl_serahkan) {
                            $tgl_serahkan='';
                        }
                        else
                        {
                            $tgl_serahkan=date('d-m-Y',strtotime($tgl_serahkan));
                        }

                        echo base_url('gudang/simpanubah/'.urlencode($id_transaksi_gudang)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <!-- <label>id_transaksi_gudang</label> -->
                            <input type="hidden" class="form-control" placeholder="Masukan kode order"  name="id_transaksi_gudang"
                            <?php if($status=='ubah'){echo "value=\"".$id_transaksi_gudang."\"" ;} ?> required>
                        </div>
						<div class="form-group">
                            <!--<label>Tanggal Input</label>-->
                            <input type="hidden" type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_input));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_input" name="tgl_input" required>
                        </div>
						<div class="form-group">
                            <label>Tanggal Diserahkan *</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_serahkan));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_serahkan" name="tgl_serahkan" required>
                        </div>
                        <div class="form-group">
                            <label>Produksi *</label>
							<select  id="produksi" class="form-control" name="id_transaksi_produksi" required>
                                <?php 
                                    foreach ($getAllProduksi as $gAC) {
                                        if($status=='ubah' && $id_transaksi_produksi==$gAC->id_transaksi_produksi)
                                        {
                                        echo "<option value=".$gAC->id_transaksi_produksi." selected>".$gAC->tgl_produksi_tampil."-".$gAC->nama_sumber_transaksi."-".$gAC->nama_barang."</option>";
                                        } 
                                        else
                                        {
                                        echo "<option value=".$gAC->id_transaksi_produksi.">".$gAC->tgl_produksi_tampil."-".$gAC->nama_sumber_transaksi."-".$gAC->nama_barang."</option>";
                                        }   
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Pelipat *</label>
                            <select  id="pelipat" class="form-control" name="kode_pelipat" required>
                                <?php 
                                    foreach ($getAllPelipat as $gAC) {
                                        if($status=='ubah' && $kode_pelipat==$gAC->kode_pelipat)
                                        {
                                        echo "<option value=".$gAC->kode_pelipat." selected>".$gAC->nama_pelipat."</option>";
                                        } 
                                        else
                                        {
                                        echo "<option value=".$gAC->kode_pelipat.">".$gAC->nama_pelipat."</option>";
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
                            <label>Keterangan </label>                                          
                            <input class="form-control" placeholder="Masukan keterangan tambahan"   <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>  name="keterangan" >
                        </div>							
                       <div class="pull-right"><a href="<?php echo base_url('gudang');?>" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
           </div>
       </section>
