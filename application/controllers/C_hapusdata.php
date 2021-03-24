<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_hapusdata extends CI_Controller {

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
		  
		  $this->load->model('M_hapusdata');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'hapusdata';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('V_hapusdata',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}


	public function hapus()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'hapusdata';
			
			$tgldari = $this->input->post('tgldari');	
			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = $this->input->post('tglsampai');
			$tglsampai = date('Y-m-d',strtotime($tglsampai));
			$dataproduksi = $this->input->post('dataproduksi');
			$datagudang = $this->input->post('datagudang');
			$datapenjualan = $this->input->post('datapenjualan');

			
			if (true==$dataproduksi)
			{
				
				$data=$this->M_hapusdata->hapusProduksi($tgldari,$tglsampai);
			}
			if (true==$datagudang)
			{
				
				$data=$this->M_hapusdata->hapusGudang($tgldari,$tglsampai);
			}
			if (true==$datapenjualan)
			{
				
				$data=$this->M_hapusdata->hapusPenjualan($tgldari,$tglsampai);
			}

			if (true==$dataproduksi||true==$datagudang||true==$datapenjualan)
			{
				$this->load->view('V_hapusdata_hapus',$data);
			}


		}else{
			redirect('index');
		}

	}



}
