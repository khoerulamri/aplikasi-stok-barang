
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <!-- Main content -->
    <section class="content"> 
    <div class="row">  
      <?php
        $kode_hak_akses = $this->session->userdata('kode_hak_akses');

        if ('administrator'==$kode_hak_akses || 'penjualan'==$kode_hak_akses || 'gudangpenjualan'==$kode_hak_akses)
            {
         ?>
      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Report Penjualan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Tanggal', 'Jumlah Bayar'],
                          <?php 
                          foreach($grafikBulanTerakhir as $c){
                            echo "['".$c->tgl_transaksi."',  ".$c->jumlah_bayar."],";
                          }
                          ?>                    
                        ]);

                        var options = {
                          title: 'Penjualan 30 Hari terakhir',
                          curveType: 'function',
                          legend: { position: 'bottom' },
                          pointSize: 5,

                        };

                        var chart = new google.visualization.LineChart(document.getElementById('penjualanChart'));

                        chart.draw(data, options);
                      }
                    </script>
                    <div id="penjualanChart" style="width: auto; height: auto"></div>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="lineChart" style="height: 250px; width: 510px;" height="250" width="510"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                 <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-fw fa-money"></i></span>
                    <?php 
                        foreach($pendapatanTahunIni as $a) {
                          $jumlah_bayar=$a->jumlah_bayar;
                          $jumlah_transaksi=$a->jumlah_transaksi;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Pendapatan th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $jumlah_bayar;?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                                <?php echo $jumlah_transaksi?> Penjualan dalam 1 tahun
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                 <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="fa fa-fw fa-child"></i></span>
                    <?php 
                        foreach($customerTahunIni as $a) {
                          $jumlah_customer=$a->jumlah_customer;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Customer th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $jumlah_customer ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                            Jumlah Customer bertransaksi
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                <div class="info-box bg-aqua">
                    <span class="info-box-icon"><i class="fa fa-fw fa-dropbox"></i></span>
                    <?php 
                        foreach($barangTahunIni as $a) {
                          $jumlah_barang=$a->jumlah_barang;
                          $qty_barang=$a->qty_barang;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Barang Terjual th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $qty_barang ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                           Barang Terjual
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
           
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

      <?php }
      if ('administrator'==$kode_hak_akses || 'gudang'==$kode_hak_akses || 'gudangpenjualan'==$kode_hak_akses)
            {
      ?>

<div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Report Gudang</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['corechart']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['Tanggal', 'Jumlah Barang'],
                          <?php 
                          foreach($grafikBulanTerakhirGudang as $c){
                            echo "['".$c->tgl_serahkan."',  ".$c->jumlah_datang."],";
                          }
                          ?>                    
                        ]);

                        var options = {
                          title: 'Transaksi Barang Masuk 30 Hari terakhir',
                          curveType: 'function',
                          legend: { position: 'bottom' },
                          pointSize: 5,

                        };

                        var chart = new google.visualization.LineChart(document.getElementById('gudangChart'));

                        chart.draw(data, options);
                      }
                    </script>
                    <div id="gudangChart" style="width: auto; height: auto"></div>

                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <a href="./laporan">
                  <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="fa fa-fw fa-dropbox"></i></span>
                      <?php 
                        foreach($barangStokKosong as $a) {
                          $barang=$a->barang;
                        }
                    ?>
                      <div class="info-box-content">
                        <span class="info-box-text">Barang Stok Kurang/Kosong</span>
                        <span class="info-box-number"><?php echo $barang;?></span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                              Barang dg stok tidak tersedia
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                  </a>

                 <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="fa fa-fw fa-tags"></i></span>
                    <?php 
                        foreach($jumlahBarangTahunIni as $a) {
                          $jumlah_transaksi=$a->jumlah_transaksi;
                          $jumlah_datang=$a->jumlah_datang;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Barang th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $jumlah_datang; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                            <?php echo $jumlah_transaksi;?> Transaksi dalam 1 tahun
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                 <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="fa fa-fw fa-child"></i></span>
                    <?php 
                        foreach($jumlahPelipatTahunIni as $a) {
                          $jumlah_pelipat=$a->jumlah_pelipat;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Pelipat th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $jumlah_pelipat; ?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                            Pelipat Aktif
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
           
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
      <?php } ?>
    </div>
    </section>
   

