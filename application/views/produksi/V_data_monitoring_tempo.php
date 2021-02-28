     <!-- Main content -->
    <section class="content"> 
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Data <strong>
                    <?php 
                    if ("red"==$sumber) {
                    echo '<font color="red">Order Lewat Jatuh Tempo</font>';
                    $namatable='dataMonitoringOrderLewatJatuhTempo';
                    }
                    elseif ("yellow"==$sumber) {
                    echo '<font color="yellow">Order Tempo Kurang 2 Hari</font>';
                    $namatable='dataMonitoringOrderTempoKurang2Hari'; 
                    }
                    elseif ("blue"==$sumber) {
                    echo '<font color="blue">Order Tempo Kurang 3-4 Hari</font>';
                    $namatable='dataMonitoringOrderTempoKurang3-4Hari';
                    }
                    else
                    {
                    echo '<font color="green">Order Tempo lebih dari 5 Hari</font>'  ;
                    $namatable='dataMonitoringOrderTempolebihdari5Hari';
                    }

                    ?></strong></h3>  <span><a href="<?php echo base_url('dashboard');?>" class="btn btn-primary">Kembali</a></span>
            </div>
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="<?php echo   $namatable;?>">
                    <thead>
                        <tr>
							<th>No</th>
							<th>Action</th>
							<th>Kode</th>
                            <th>Tgl Order</th>
                            <th>Customer</th>
                            <th>PJ</th>
                            <th>Total Biaya</th>
                            <th>Kekurangan</th>
                            <th>Status</th>
							<th>Tgl Tempo</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>