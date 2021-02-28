<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sumber_transaksi extends CI_Controller {

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
		  
		  $this->load->model('M_sumber_transaksi');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['sumber_transaksi']=$this->M_sumber_transaksi->getSumberTransaksiAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('sumber_transaksi/V_data_sumber_transaksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_sumber_transaksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';
			
			$kode_sumber_transaksi=urldecode($kode_sumber_transaksi);
			$data['sumber_transaksi']=$this->M_sumber_transaksi->deleteSumberTransaksi($kode_sumber_transaksi);
			
			$this->load->view('sumber_transaksi/V_sumber_transaksi_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_sumber_transaksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_sumber_transaksi=urldecode($kode_sumber_transaksi);
			$data['sumber_transaksi']=$this->M_sumber_transaksi->getSumberTransaksiByKode($kode_sumber_transaksi);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('sumber_transaksi/V_sumber_transaksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_sumber_transaksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';
			
			$kode_sumber_transaksibaru = $this->input->post('kode_sumber_transaksi');
			$nama_sumber_transaksi = $this->input->post('nama_sumber_transaksi');

			//check kode baru sudah digunakan?
			if ($kode_sumber_transaksi!=$kode_sumber_transaksibaru)
			{
			$hasilcheck = $this->M_sumber_transaksi->checkSumberTransaksi($kode_sumber_transaksibaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_sumber_transaksi']=$kode_sumber_transaksi;
				$this->load->view('sumber_transaksi/V_sumber_transaksi_konflik',$data);

			}
			else
			{
				//kode sumber_transaksi unik				
				$kode_sumber_transaksi=urldecode($kode_sumber_transaksi);
				$this->M_sumber_transaksi->updateSumberTransaksi($kode_sumber_transaksi,$kode_sumber_transaksibaru,$nama_sumber_transaksi,$telpon,$alamat,$keterangan);
				$data['kode_sumber_transaksi']=$kode_sumber_transaksibaru;
				$this->load->view('sumber_transaksi/V_sumber_transaksi_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';
			
			$kode_sumber_transaksi = $this->input->post('kode_sumber_transaksi');
			$nama_sumber_transaksi = $this->input->post('nama_sumber_transaksi');

			$hasilcheck = $this->M_sumber_transaksi->checkSumberTransaksi($kode_sumber_transaksi);

			if($hasilcheck == true){
				//notif
				$data['kode_sumber_transaksi']=$kode_sumber_transaksi;
				$this->load->view('sumber_transaksi/V_sumber_transaksi_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_sumber_transaksi=urldecode($kode_sumber_transaksi);
				$this->M_sumber_transaksi->saveSumberTransaksi($kode_sumber_transaksi,$nama_sumber_transaksi,$telpon,$alamat,$keterangan);
				$data['kode_sumber_transaksi']=$kode_sumber_transaksi;
				$this->load->view('sumber_transaksi/V_sumber_transaksi_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'sumber_transaksi';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('sumber_transaksi/V_sumber_transaksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_sumber_transaksi()
    {
        $list = $this->M_sumber_transaksi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('sumber_transaksi/ubah/').urlencode($field->kode_sumber_transaksi).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('sumber_transaksi/hapus/').urlencode($field->kode_sumber_transaksi).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->nama_sumber_transaksi;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_sumber_transaksi->count_all(),
            "recordsFiltered" => $this->M_sumber_transaksi->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
