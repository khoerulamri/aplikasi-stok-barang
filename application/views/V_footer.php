    </div>      
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0.0
    </div>
    <strong>Copyright &copy;</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->


    <!-- jQuery 3 -->
    <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- Morris.js charts -->
    <script src="<?php echo base_url('assets/bower_components/raphael/raphael.min.js'); ?>"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js'); ?>"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js'); ?>"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?php echo base_url('assets/dist/js/demo.js'); ?>"></script> -->
    <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>

        <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.flash.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/buttons.colVis.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/currency.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-plugins/numeric-comma.js'); ?>"></script>
    <script src="<?php echo base_url('assets/datatables-responsive/dataTables.responsive.js'); ?>"></script>

    <script type="text/javascript">
    var table;
    $(document).ready(function() {
 
        //datatables
        table = $('#dataCustomer').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('customer/get_data_customer')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Customer',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('customer/tambah');?>';
                }
            }],
            "scrollX": true,
        });

        table = $('#dataPetugas').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('petugas/get_data_petugas')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Petugas',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('petugas/tambah');?>';
                }
            }],
            "scrollX": true,
        });


        table = $('#dataBarang').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('barang/get_data_barang')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Barang',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('barang/tambah');?>';
                }
            }],
            "scrollX": true,
        });


        table = $('#dataPelipat').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('pelipat/get_data_pelipat')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Pelipat',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('pelipat/tambah');?>';
                }
            }],
            "scrollX": true,
        });

        table = $('#dataPerusahaan').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('perusahaan/get_data_perusahaan')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Perusahaan',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('perusahaan/tambah');?>';
                }
            }],
            "scrollX": true,
        });


        table = $('#dataSumberTransaksi').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('sumber_transaksi/get_data_sumber_transaksi')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Sumber Transaksi',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('sumber_transaksi/tambah');?>';
                }
            }],
            "scrollX": true,
        });


         table = $('#dataProduksiBarang').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('produksi/get_data_produksi')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Data Produksi',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('produksi/tambah');?>';
                }
            }],
            "scrollX": true,
        });


         table = $('#dataBarangGudang').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('gudang/get_data_gudang')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Data Gudang',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('gudang/tambah');?>';
                }
            }],
            "scrollX": true,
        });


         table = $('#dataPenjualanBarang').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('penjualan/get_data_penjualan')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            {
                text: 'Tambah Data Penjualan',
                action: function ( e, dt, node, config ) {
                     window.location = '<?php echo base_url('penjualan/tambah');?>';
                }
            }],
            "scrollX": true,
        });

       
         table = $('#dataLaporanStokBarang').DataTable({ 
 
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "lengthMenu": [[ 5, 20, 50, 100, -1 ],[ '5 baris', '20 baris', '50 baris', '100 baris', 'Tampilkan Semua' ]],
            "ajax": {
                "url": "<?php echo base_url('laporan/get_data_laporan_stok_barang')?>",
                "type": "POST"
            },
            "columnDefs": [
            { 
                "targets": [ 0 ], 
                "orderable": false, 
            },
            { 
                "targets": [ 1 ], 
                "orderable": false, 
            }
            ],
            "dom": 'lBfrtip',
            "buttons": ['copy', 'print', 'csv', 'excel', 'pdf', 'colvis',
            ],
            "scrollX": true,
        });

       
    });
 
</script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#barang").select2({
         ajax: { 
           url: '<?php echo base_url('produksi/get_data_barang_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },

           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#pelipat").select2({
         ajax: { 
           url: '<?php echo base_url('gudang/get_data_pelipat_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#customer").select2({
         ajax: { 
           url: '<?php echo base_url('penjualan/get_data_customer_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#produksi").select2({
         ajax: { 
           url: '<?php echo base_url('gudang/get_data_produksi_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#kode_perusahaan").select2({
         ajax: { 
           url: '<?php echo base_url('barang/get_data_perusahaan_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>

<script type="text/javascript">
   $(document).ready(function(){

      $("#sumber_transaksi").select2({
         ajax: { 
           url: '<?php echo base_url('produksi/get_data_sumber_transaksi_select')?>',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         }
     });
   });
   </script>


<script type="text/javascript">
        //Date picker
    $('#tglorder').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_input').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_produksi').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgltempo').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_serahkan').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_transaksi').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tglbayar').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgl_bayar').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>

<script type="text/javascript">
        //Date picker
    $('#tgldari').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })  
</script>
<script type="text/javascript">
        //Date picker
    $('#tglsampai').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
     })
</script>



</body>
</html>