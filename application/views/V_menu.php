<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('dashboard'); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Stok Barang </b>v.1.0.0.0</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url('assets/dist/img/avatar04.png')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <strong><?php echo $nama_petugas;?> </strong><br>
          <a href="<?php echo base_url('changepassword');?>"><i class="fa fa-key"></i> Ganti Password</a><br>
          <a href="<?php echo base_url('logout');?>"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" <?php if($menu_active=='dashboard')
                                    {
                                        echo 'active';
                                    }?> ">
          <a href="<?php echo base_url('dashboard');?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php
        $kode_hak_akses = $this->session->userdata('kode_hak_akses');
         ?>

        <li class="<?php if(($menu_active=='produksi')||($menu_active=='gudang')||($menu_active=='gudang_produksi')||($menu_active=='penjualan')||($menu_active=='gudangpenjualan')||($menu_active=='produksigudang'))
                                    {
                                        echo 'active';
                                    }?> treeview" >
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <?php
            if ('administrator'==$kode_hak_akses || 'produksi'==$kode_hak_akses || 'produksigudang'==$kode_hak_akses)
            { ?>
            <li <?php if($menu_active=='produksi')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('produksi');?>"><i class="fa fa-file-text-o"></i>Data Produksi</a></li>
            <?php } 
            if ('administrator'==$kode_hak_akses || 'gudang'==$kode_hak_akses || 'gudangpenjualan'==$kode_hak_akses || 'produksigudang'==$kode_hak_akses)
            { ?>
            <li <?php if($menu_active=='gudang')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('gudang');?>"><i class="fa fa-file-text"></i>Data Gudang</a></li>
            <?php } 
            if ('administrator'==$kode_hak_akses || 'penjualan'==$kode_hak_akses || 'gudangpenjualan'==$kode_hak_akses)
            { ?>
           <li <?php if($menu_active=='penjualan')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('penjualan');?>"><i class="fa fa-file-text"></i>Data Penjualan</a></li>
            <?php } ?>
          </ul>
        </li>

        <?php
            if ('administrator'==$kode_hak_akses || 'gudang'==$kode_hak_akses || 'penjualan'==$kode_hak_akses || 'gudangpenjualan'==$kode_hak_akses || 'produksigudang'==$kode_hak_akses)
            { ?>
        <li class="<?php if(($menu_active=='laporan_stok_barang'))
                                    {
                                        echo 'active';
                                    }?> treeview" >
          <a href="#">
            <i class="fa fa-book"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($menu_active=='laporan_stok_barang')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('laporan')?>"><i class="fa fa-book"></i>Lap. Stok Barang</a></li>
          </ul>
        </li>
        <?php } 
            
        //Menu setting hanya muncul di halaman admin
        if("administrator"==$kode_hak_akses)
        {
        ?>
        <li class=" <?php if(($menu_active=='petugas')||($menu_active=='barang')||($menu_active=='pelipat')||($menu_active=='customer')||($menu_active=='sumber_transaksi')||($menu_active=='perusahaan')||($menu_active=='hapusdata'))
                                    {
                                        echo 'active';
                                    }?> treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($menu_active=='petugas')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('petugas');?>"><i class="fa fa-user"></i>Petugas</a></li>
            <li <?php if($menu_active=='barang')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('barang');?>"><i class="fa fa-users"></i>Barang</a></li>
            <li <?php if($menu_active=='pelipat')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('pelipat');?>"><i class="fa fa-user"></i>Pelipat</a></li>
            <li <?php if($menu_active=='customer')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('customer');?>"><i class="fa fa-users"></i>Customer</a></li>
            <li <?php if($menu_active=='sumber_transaksi')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('sumber_transaksi');?>"><i class="fa fa-bars"></i>Sumber Transaksi</a></li>
            <li <?php if($menu_active=='perusahaan')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('perusahaan');?>"><i class="fa fa-home"></i>Perusahaan</a></li>
            <li <?php if($menu_active=='hapusdata')
                                    {
                                        echo 'class="active"';
                                    }?>><a href="<?php echo base_url('hapusdata');?>"><i class="fa fa-file-text"></i>Hapus Data Transaksi</a></li>
          </ul>
        </li>
        <?php 
        }
        //end if menu setting login admin
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">