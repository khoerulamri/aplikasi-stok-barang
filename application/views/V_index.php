

     <!-- Main content -->
    <section class="content"> 
        <div class="row">
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <a href="<?php echo base_url('pemesanan/tambah');?>">
            <span class="info-box-icon bg-grey"><i class="fa fa-file-text-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Klik Disini untuk </span>
              <span class="info-box-number">PEMESANAN</span>
            </div>
               </a>
            <!-- /.info-box-content -->
          </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <a href="<?php echo base_url('pembayaran/tambah');?>">
            <span class="info-box-icon bg-grey"><i class="fa fa-file-text"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Klik Disini untuk </span>
              <span class="info-box-number">PEMBAYARAN </span>
            </div>
              </a>
            <!-- /.info-box-content -->
          </div>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
              <div class="info-box-content">
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
              
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
             
              <p>Order Lewat Jatuh Tempo</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/red');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              
              <p>Order Tempo Kurang 2 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/yellow');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
             
              <p>Order Tempo Kurang 3-4 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/blue');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
             

              <p>Order Tempo lebih dari 5 Hari</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="<?php echo base_url('dashboard/monitoringTempo/green');?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
    </section>
    <!-- /.content -->

