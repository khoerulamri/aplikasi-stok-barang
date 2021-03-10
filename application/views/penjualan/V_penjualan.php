     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
            <h3 class="box-title">Penjualan</h3>
            </div>
            <div class="panel-body">

                <div class="col-lg-6">
                    <form role="form" action="<?php 
                    if($status=='tambah')
                    { echo base_url('penjualan/simpan'); }
                    else 
                    { 
                        foreach($penjualan as $c){
                            $id_transaksi_penjualan=$c->id_transaksi_penjualan;
                            $tgl_input=$c->tgl_input;
                            $tgl_transaksi=$c->tgl_transaksi;
                            $kode_petugas=$c->kode_petugas;
                            $kode_customer=$c->kode_customer;
                            $kode_barang=$c->kode_barang;
                            $qty=$c->qty;
                            $harga_barang=$c->harga_barang;
                            $jumlah_bayar=$c->jumlah_bayar;
                            $status_transaksi=$c->status_transaksi;
                            $keterangan=$c->keterangan;
                        }   


                        if ('01-01-1970'==$tgl_input || '0000-00-00' == $tgl_input) {
                            $tgl_input='';
                        }
                        else
                        {
                            $tgl_input=date('d-m-Y',strtotime($tgl_input));
                        }
                        if ('01-01-1970'==$tgl_transaksi || '0000-00-00' == $tgl_transaksi) {
                            $tgl_transaksi='';
                        }
                        else
                        {
                            $tgl_transaksi=date('d-m-Y',strtotime($tgl_transaksi));
                        }
                        echo base_url('penjualan/simpanubah/'.urlencode($id_transaksi_penjualan)); };?>" method="post">
                        <div class="form-group">*) Wajib Terisi</div>
                        <div class="form-group">
                            <!-- <label>id_transaksi_penjualan</label> -->
                            <input type="hidden" class="form-control" placeholder="Masukan kode order"  name="id_transaksi_penjualan"
                            <?php if($status=='ubah'){echo "value=\"".$id_transaksi_penjualan."\"" ;} ?> required>
                        </div>
						<div class="form-group">
                            <!--<label>Tanggal Input</label>-->
                            <input type="hidden" type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_input));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_input" name="tgl_input" required>
                        </div>
						<div class="form-group">
                            <label>Tanggal Penjualan *</label>
                            <input type="text" class="form-control" value="<?php if($status=='ubah'){echo date('d-m-Y',strtotime($tgl_transaksi));}
                            else
                            { echo date('d-m-Y');} ?>" id="tgl_transaksi" name="tgl_transaksi" required>
                        </div>
                        <div class="form-group">
                            <label>Customer *</label>
							<select  id="customer" class="form-control" name="kode_customer" required>
                                <?php 
                                    foreach ($getAllCustomer as $gAC) {
                                        if($status=='ubah' && $kode_customer==$gAC->kode_customer)
                                        {
                                        echo "<option value=".$gAC->kode_customer." selected>".$gAC->kode_customer."-".$gAC->nama_customer."</option>";
                                        }
                                        else
                                        {
                                        echo " <option value=''>-- Pilih Customer --</option>";
                                        }   
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Barang *</label>
                            <select  id="barang" class="form-control" name="kode_barang" required>
                                <?php 
                                    foreach ($getAllBarang as $gAC) {
                                        if($status=='ubah' && $kode_barang==$gAC->kode_barang)
                                        {
                                        echo "<option value=".$gAC->kode_barang." selected>".$gAC->nama_barang.' - '.$gAC->ukuran_barang.' - '.$gAC->bahan_barang."</option>";
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
                            <input id="jumlah" class="form-control" placeholder="Masukan jumlah barang"  type="number" <?php if($status=='ubah'){echo "value=\"".$qty."\"" ;} ?>  name="qty" required onchange="hitungBayar2(this.value)">
                        </div>
						<div class="form-group">
                            <label>Harga *</label>                                          
                            <input id="harga" class="form-control" placeholder="Masukan harga barang"  type="number" <?php if($status=='ubah'){echo "value=\"".$harga_barang."\"" ;} ?>  name="harga_barang" required onchange="hitungBayar(this.value)">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Bayar *</label>                                          
                            <input id="total_bayar" class="form-control" placeholder="Masukan jumlah bayar"  type="number" <?php if($status=='ubah'){echo "value=\"".$jumlah_bayar."\"" ;} ?>  name="jumlah_bayar" required>
                        </div>
                        <script>
                            function hitungBayar(val) {
                                var jumlahnya = $('#jumlah').val();
                                var tot_price = jumlahnya*val;

                                /*display the result*/
                                var bayar = document.getElementById('total_bayar');
                                bayar.value = tot_price;
                            }
                            function hitungBayar2(val) {
                                var harganya = $('#harga').val();
                                var tot_price = harganya*val;

                                /*display the result*/
                                var bayar = document.getElementById('total_bayar');
                                bayar.value = tot_price;
                            }
                        </script>

                        <div class="form-group">
                            <label>Status Transaksi *</label>
                            <select  id="status_transaksi" class="form-control" name="status_transaksi" required>
                                 <option value='Lunas' 
                                 <?php if('Lunas'==$status_transaksi)
                                    echo "selected";
                                 ?> >Lunas</option>";
                                 <option value='Tempo'
                                 <?php if('Tempo'==$status_transaksi)
                                    echo "selected";
                                 ?>
                                 >Tempo</option>";
                            </select>
                        </div>
                         <div class="form-group">
                            <label>Keterangan </label>                                          
                            <input class="form-control" placeholder="Masukan keterangan tambahan"   <?php if($status=='ubah'){echo "value=\"".$keterangan."\"" ;} ?>  name="keterangan" >
                        </div>							
                       <div class="pull-right"><a href="<?php echo base_url('penjualan');?>" class="btn btn-info">Kembali</a>
                        <button type="submit" class="btn btn-success">Simpan</button></div>
					</form>
                </div>
            </div>
           </div>
       </section>
