<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_index extends CI_Controller {

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
          
		  $this->load->model('M_dashboard');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['Menu'] = 'dashboard';
			
			$data['menu_active'] = 'dashboard';

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			$data['pendapatanTahunIni']=$this->M_dashboard->pendapatanTahunIni();
			$data['customerTahunIni']=$this->M_dashboard->customerTahunIni();
			$data['barangTahunIni']=$this->M_dashboard->barangTahunIni();
			$data['grafikBulanTerakhir']=$this->M_dashboard->grafikBulanTerakhir();
            $data['grafikBulanTerakhirGudang']=$this->M_dashboard->grafikBulanTerakhirGudang();
            $data['jumlahBarangTahunIni']=$this->M_dashboard->jumlahBarangTahunIni();
            $data['jumlahPelipatTahunIni']=$this->M_dashboard->jumlahPelipatTahunIni();
            $data['barangStokKosong']=$this->M_dashboard->barangStokKosong();

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('V_index',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}


}
