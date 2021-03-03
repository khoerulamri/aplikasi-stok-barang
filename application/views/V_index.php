

     <!-- Main content -->
    <section class="content"> 
    <div class="row">  
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
                  <p class="text-center">
                    <strong>Penjualan 30 Hari terakhir</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="lineChart" style="height: 250px; width: 510px;" height="250" width="510"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                 <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-money-outline"></i></span>
                    <?php 
                        foreach($pendapatanTahunIni as $a) {
                          $jumlah_bayar=$a->jumlah_bayar;
                          $jumlah_bayar=$a->jumlah_transaksi;
                        }
                    ?>
                    <div class="info-box-content">
                      <span class="info-box-text">Pendapatan th <?php echo date("Y");?></span>
                      <span class="info-box-number"><?php echo $jumlah_bayar;?></span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">

                        foreach($pendapatanTahunIni as $a) {
                          $jumlah_bayar=$a->jumlah_bayar;
                          $jumlah_bayar=$a->jumlah_transaksi;
                        }

                            <php echo $jumlah_transaksi> Penjualan dalam 1 tahun
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                 <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="ion ion-ios-user-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Customer th 2021</span>
                      <span class="info-box-number">92,050</span>

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
                    <span class="info-box-icon"><i class="ion ion-ios-user-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Barang Terjual th 2021</span>
                      <span class="info-box-number">92,050</span>

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
                  <p class="text-center">
                    <strong>Transaksi Barang Masuk 30 Hari terakhir</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="lineChart" style="height: 250px; width: 510px;" height="250" width="510"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                 <div class="info-box bg-green">
                    <span class="info-box-icon"><i class="ion ion-ios-money-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Barang th 2021</span>
                      <span class="info-box-number">92,050</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                            2000 Transaksi dalam 1 tahun
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                 <div class="info-box bg-orange">
                    <span class="info-box-icon"><i class="ion ion-ios-user-outline"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Jumlah Pelipat th 2021</span>
                      <span class="info-box-number">92,050</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                      </div>
                      <span class="progress-description">
                            Pelipat Aktif
                          </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                 <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="ion ion-ios-user-outline"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Barang Stok Kosong</span>
                        <span class="info-box-number">92,050</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 100%"></div>
                        </div>
                        <span class="progress-description">
                              stok tidak tersedia
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

    </div>
    </section>
   

