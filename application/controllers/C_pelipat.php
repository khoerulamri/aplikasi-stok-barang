<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pelipat extends CI_Controller {

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
		  
		  $this->load->model('M_pelipat');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['pelipat']=$this->M_pelipat->getPelipatAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pelipat/V_data_pelipat',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_pelipat)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';
			
			$kode_pelipat=urldecode($kode_pelipat);
			$data['pelipat']=$this->M_pelipat->deletePelipat($kode_pelipat);
			
			$this->load->view('pelipat/V_pelipat_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_pelipat)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_pelipat=urldecode($kode_pelipat);
			$data['pelipat']=$this->M_pelipat->getPelipatByKode($kode_pelipat);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pelipat/V_pelipat',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_pelipat)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';
			
			$kode_pelipatbaru = $this->input->post('kode_pelipat');
			$nama_pelipat = $this->input->post('nama_pelipat');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');


			//check kode baru sudah digunakan?
			if ($kode_pelipat!=$kode_pelipatbaru)
			{
			$hasilcheck = $this->M_pelipat->checkPelipat($kode_pelipatbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_pelipat']=$kode_pelipat;
				$this->load->view('pelipat/V_pelipat_konflik',$data);

			}
			else
			{
				//kode pelipat unik				
				$kode_pelipat=urldecode($kode_pelipat);
				$this->M_pelipat->updatePelipat($kode_pelipat,$kode_pelipatbaru,$nama_pelipat,$telpon,$alamat,$keterangan);
				$data['kode_pelipat']=$kode_pelipatbaru;
				$this->load->view('pelipat/V_pelipat_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';
			
			$kode_pelipat = $this->input->post('kode_pelipat');
			$nama_pelipat = $this->input->post('nama_pelipat');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');

			$hasilcheck = $this->M_pelipat->checkPelipat($kode_pelipat);

			if($hasilcheck == true){
				//notif
				$data['kode_pelipat']=$kode_pelipat;
				$this->load->view('pelipat/V_pelipat_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_pelipat=urldecode($kode_pelipat);
				$this->M_pelipat->savePelipat($kode_pelipat,$nama_pelipat,$telpon,$alamat,$keterangan);
				$data['kode_pelipat']=$kode_pelipat;
				$this->load->view('pelipat/V_pelipat_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'pelipat';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pelipat/V_pelipat',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_pelipat()
    {
        $list = $this->M_pelipat->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pelipat/ubah/').urlencode($field->kode_pelipat).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pelipat/hapus/').urlencode($field->kode_pelipat).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_pelipat;
            $row[] = $field->nama_pelipat;
            $row[] = $field->alamat;
            $row[] = $field->telpon;
            $row[] = $field->keterangan; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_pelipat->count_all(),
            "recordsFiltered" => $this->M_pelipat->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
