<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_perusahaan extends CI_Controller {

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
		  
		  $this->load->model('M_perusahaan');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['perusahaan']=$this->M_perusahaan->getPerusahaanAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('perusahaan/V_data_perusahaan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_perusahaan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';
			
			$kode_perusahaan=urldecode($kode_perusahaan);
			$data['perusahaan']=$this->M_perusahaan->deletePerusahaan($kode_perusahaan);
			
			$this->load->view('perusahaan/V_perusahaan_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_perusahaan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_perusahaan=urldecode($kode_perusahaan);
			$data['perusahaan']=$this->M_perusahaan->getPerusahaanByKode($kode_perusahaan);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('perusahaan/V_perusahaan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_perusahaan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';
			
			$kode_perusahaanbaru = $this->input->post('kode_perusahaan');
			$nama_perusahaan = $this->input->post('nama_perusahaan');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');


			//check kode baru sudah digunakan?
			if ($kode_perusahaan!=$kode_perusahaanbaru)
			{
			$hasilcheck = $this->M_perusahaan->checkPerusahaan($kode_perusahaanbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_perusahaan']=$kode_perusahaan;
				$this->load->view('perusahaan/V_perusahaan_konflik',$data);

			}
			else
			{
				//kode perusahaan unik				
				$kode_perusahaan=urldecode($kode_perusahaan);
				$this->M_perusahaan->updatePerusahaan($kode_perusahaan,$kode_perusahaanbaru,$nama_perusahaan,$telpon,$alamat,$keterangan);
				$data['kode_perusahaan']=$kode_perusahaanbaru;
				$this->load->view('perusahaan/V_perusahaan_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';
			
			$kode_perusahaan = $this->input->post('kode_perusahaan');
			$nama_perusahaan = $this->input->post('nama_perusahaan');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');

			$hasilcheck = $this->M_perusahaan->checkPerusahaan($kode_perusahaan);

			if($hasilcheck == true){
				//notif
				$data['kode_perusahaan']=$kode_perusahaan;
				$this->load->view('perusahaan/V_perusahaan_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_perusahaan=urldecode($kode_perusahaan);
				$this->M_perusahaan->savePerusahaan($kode_perusahaan,$nama_perusahaan,$telpon,$alamat,$keterangan);
				$data['kode_perusahaan']=$kode_perusahaan;
				$this->load->view('perusahaan/V_perusahaan_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'perusahaan';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('perusahaan/V_perusahaan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_perusahaan()
    {
        $list = $this->M_perusahaan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('perusahaan/ubah/').urlencode($field->kode_perusahaan).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('perusahaan/hapus/').urlencode($field->kode_perusahaan).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_perusahaan;
            $row[] = $field->nama_perusahaan;
            $row[] = $field->alamat;
            $row[] = $field->telpon;
            $row[] = $field->keterangan; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_perusahaan->count_all(),
            "recordsFiltered" => $this->M_perusahaan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
