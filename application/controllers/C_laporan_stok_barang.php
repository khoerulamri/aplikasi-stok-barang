<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan_stok_barang extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
    {
          parent::__construct();
		  
		  $this->load->model('M_laporan_stok_barang');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporan_stok_barang';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['laporan_stok_barang']=$this->M_laporan_stok_barang->getSumberTransaksiAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan_stok_barang/V_data_laporan_stok_barang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_laporan_stok_barang()
    {
        $list = $this->M_laporan_stok_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();

            if ($field->minimum_stok>=$field->qty_gudang_saat_ini)
            {
            	$row[] = "<p style='color:red'>$no</p>";
	            $row[] = "<p style='color:red'>$field->nama_perusahaan</p>";
	            $row[] = "<p style='color:red'>$field->nama_barang</p>";
	            $row[] = "<p style='color:red'>$field->minimum_stok</p>";
	            $row[] = "<p style='color:red'>$field->qty_produksi</p>";
	            $row[] = "<p style='color:red'>$field->qty_produksi_belum_kembali</p>";
	            $row[] = "<p style='color:red'>$field->qty_gudang_saat_ini</p>";
	            $row[] = "<p style='color:red'>$field->qty_penjualan</p>";
	            $row[] = "<p style='color:red'>$field->status_stok</p>";
            }
            else
            {
	            $row[] = $no;
	            $row[] = $field->nama_perusahaan;
	            $row[] = $field->nama_barang;
	            $row[] = $field->minimum_stok;
	            $row[] = $field->qty_produksi;
	            $row[] = $field->qty_produksi_belum_kembali;
	            $row[] = $field->qty_gudang_saat_ini;
	            $row[] = $field->qty_penjualan;	
	            $row[] = $field->status_stok;	
            }

            
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_laporan_stok_barang->count_all(),
            "recordsFiltered" => $this->M_laporan_stok_barang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
