<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_barang extends CI_Controller {

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
		  
		  $this->load->model('M_barang');
		  $this->load->model('M_perusahaan');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['barang']=$this->M_barang->getBarangAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('barang/V_data_barang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_barang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';
			
			$kode_barang=urldecode($kode_barang);
			$data['barang']=$this->M_barang->deleteBarang($kode_barang);
			
			$this->load->view('barang/V_barang_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_barang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			

			$data['getAllPerusahaan'] = $this->M_perusahaan->getPerusahaanAll();

			$kode_barang=urldecode($kode_barang);
			$data['barang']=$this->M_barang->getBarangByKode($kode_barang);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('barang/V_barang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_barang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';
			
			$kode_barangbaru = $this->input->post('kode_barang');
			$nama_barang = $this->input->post('nama_barang');
			$ukuran_barang = $this->input->post('ukuran_barang');
			$bahan_barang = $this->input->post('bahan_barang');

			$kode_perusahaan = $this->input->post('kode_perusahaan');
			$minimum_stok = $this->input->post('minimum_stok');

			//check kode baru sudah digunakan?
			if ($kode_barang!=$kode_barangbaru)
			{
			$hasilcheck = $this->M_barang->checkBarang($kode_barangbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_barang']=$kode_barang;
				$this->load->view('barang/V_barang_konflik',$data);

			}
			else
			{
				//kode barang unik				
				$kode_barang=urldecode($kode_barang);
				$this->M_barang->updateBarang($kode_barang,$kode_barangbaru,$nama_barang,$ukuran_barang,$bahan_barang,$kode_perusahaan,$minimum_stok);
				$data['kode_barang']=$kode_barangbaru;
				$this->load->view('barang/V_barang_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';
			
			$kode_barang = $this->input->post('kode_barang');
			$nama_barang = $this->input->post('nama_barang');

			$ukuran_barang = $this->input->post('ukuran_barang');
			$bahan_barang = $this->input->post('bahan_barang');

			$kode_perusahaan = $this->input->post('kode_perusahaan');
			$minimum_stok = $this->input->post('minimum_stok');

			$hasilcheck = $this->M_barang->checkBarang($kode_barang);

			if($hasilcheck == true){
				//notif
				$data['kode_barang']=$kode_barang;
				$this->load->view('barang/V_barang_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_barang=urldecode($kode_barang);
				$this->M_barang->saveBarang($kode_barang,$nama_barang,$ukuran_barang,$bahan_barang,$kode_perusahaan,$minimum_stok);
				$data['kode_barang']=$kode_barang;
				$this->load->view('barang/V_barang_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'barang';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';


			$data['getAllPerusahaan'] = $this->M_perusahaan->getPerusahaanAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('barang/V_barang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_barang()
    {
        $list = $this->M_barang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('barang/ubah/').urlencode($field->kode_barang).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('barang/hapus/').urlencode($field->kode_barang).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_barang;
            $row[] = $field->nama_barang;
            $row[] = $field->ukuran_barang;
            $row[] = $field->bahan_barang;
            $row[] = $field->nama_perusahaan;
            $row[] = $field->minimum_stok;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_barang->count_all(),
            "recordsFiltered" => $this->M_barang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_perusahaan_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_barang->get_data_perusahaan_select($searchTerm);
      echo json_encode($response);
    }
}
