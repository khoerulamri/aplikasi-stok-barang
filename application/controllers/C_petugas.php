<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_petugas extends CI_Controller {

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
		  
		  $this->load->model('M_petugas');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['petugas']=$this->M_petugas->getPetugasAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('petugas/V_data_petugas',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_petugas)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';
			
			$kode_petugas=urldecode($kode_petugas);
			$data['petugas']=$this->M_petugas->deletePetugas($kode_petugas);
			
			$this->load->view('petugas/V_petugas_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_petugas)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_petugas=urldecode($kode_petugas);
			$data['petugas']=$this->M_petugas->getPetugasByKode($kode_petugas);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('petugas/V_petugas',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_petugas)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';
			
			$kode_petugasbaru = $this->input->post('kode_petugas');
			$nama_petugas = $this->input->post('nama_petugas');
			$user_name = $this->input->post('user_name');
			$pass_word = $this->input->post('pass_word');
			$kode_hak_akses = $this->input->post('kode_hak_akses');


			//check kode baru sudah digunakan?
			if ($kode_petugas!=$kode_petugasbaru)
			{
			$hasilcheck = $this->M_petugas->checkPetugas($kode_petugasbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_petugas']=$kode_petugas;
				$this->load->view('petugas/V_petugas_konflik',$data);

			}
			else
			{
				//kode petugas unik				
				$kode_petugas=urldecode($kode_petugas);
				$this->M_petugas->updatePetugas($kode_petugas,$kode_petugasbaru,$nama_petugas,$user_name,$pass_word,$kode_hak_akses);
				$data['kode_petugas']=$kode_petugasbaru;
				$this->load->view('petugas/V_petugas_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';
			
			$kode_petugas = $this->input->post('kode_petugas');
			$nama_petugas = $this->input->post('nama_petugas');
			$user_name = $this->input->post('user_name');
			$pass_word = $this->input->post('pass_word');
			$kode_hak_akses = $this->input->post('kode_hak_akses');

			$hasilcheck = $this->M_petugas->checkPetugas($kode_petugas);

			if($hasilcheck == true){
				//notif
				$data['kode_petugas']=$kode_petugas;
				$this->load->view('petugas/V_petugas_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_petugas=urldecode($kode_petugas);
				$this->M_petugas->savePetugas($kode_petugas,$nama_petugas,$user_name,$pass_word,$kode_hak_akses);
				$data['kode_petugas']=$kode_petugas;
				$this->load->view('petugas/V_petugas_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'petugas';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('petugas/V_petugas',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_petugas()
    {
        $list = $this->M_petugas->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('petugas/ubah/').urlencode($field->kode_petugas).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('petugas/hapus/').urlencode($field->kode_petugas).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_petugas;
            $row[] = $field->nama_petugas;
            $row[] = $field->user_name;
            $row[] = $field->kode_hak_akses; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_petugas->count_all(),
            "recordsFiltered" => $this->M_petugas->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
