<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gudang extends CI_Controller {

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
		  
		  $this->load->model('M_produksi');
		  $this->load->model('M_gudang');
		  $this->load->model('M_barang');
		  $this->load->model('M_pelipat');
		  $this->load->helper('date');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('gudang/V_data_gudang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($id_transaksi_gudang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';
			
			$id_transaksi_gudang=urldecode($id_transaksi_gudang);
			$data['gudang']=$this->M_gudang->deleteGudang($id_transaksi_gudang);
			
			$this->load->view('gudang/V_gudang_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($id_transaksi_gudang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['getAllProduksi'] = $this->M_produksi->getProduksiAll();			
			$data['getAllPelipat'] = $this->M_pelipat->getPelipatAll();
			
			$id_transaksi_gudang=urldecode($id_transaksi_gudang);
			$data['gudang']=$this->M_gudang->getGudangByKode($id_transaksi_gudang);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('gudang/V_gudang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($id_transaksi_gudang)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';
			$data['status']='ubah';

			$id_transaksi_gudangbaru = $this->input->post('id_transaksi_gudang');
			$tgl_input = $this->input->post('tgl_input');
			$tgl_serahkan = $this->input->post('tgl_serahkan');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_pelipat = $this->input->post('kode_pelipat');
			$qty = $this->input->post('qty');
			$id_transaksi_produksi = $this->input->post('id_transaksi_produksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_input=date('Y-m-d',strtotime($tgl_input));
			$tgl_serahkan=date('Y-m-d',strtotime($tgl_serahkan));
			
			$id_transaksi_gudang=urldecode($id_transaksi_gudang);
			$this->M_gudang->updateGudang($id_transaksi_gudang,$id_transaksi_gudangbaru,$tgl_input,$tgl_serahkan,$kode_petugas,$kode_pelipat,$qty,$keterangan,$id_transaksi_produksi);
			$data['id_transaksi_gudang']=$id_transaksi_gudangbaru;
			$this->load->view('gudang/V_gudang_ubah',$data);
			
		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';
			
			$data['status'] = 'tambah';

			$tgl_input = $this->input->post('tgl_input');
			$tgl_serahkan = $this->input->post('tgl_serahkan');
			$id_transaksi_produksi = $this->input->post('id_transaksi_produksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_pelipat = $this->input->post('kode_pelipat');
			$qty = $this->input->post('qty');
			$keterangan = $this->input->post('keterangan');


			$tgl_serahkan=date('Y-m-d',strtotime($tgl_serahkan));

			$this->M_gudang->saveGudang($tgl_input,$tgl_serahkan,$kode_petugas,$kode_pelipat,$qty,$keterangan,$id_transaksi_produksi);
			$data['id_transaksi_gudang']=$id_transaksi_gudang;
			$this->load->view('gudang/V_gudang_simpan',$data);

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'gudang';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			
			$data['status']='tambah';

			$data['getAllProduksi'] = $this->M_produksi->getProduksiAll();
			$data['getAllPelipat'] = $this->M_pelipat->getPelipatAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('gudang/V_gudang',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_gudang()
    {
        $list = $this->M_gudang->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('gudang/ubah/').urlencode($field->id_transaksi_gudang).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('gudang/hapus/').urlencode($field->id_transaksi_gudang).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->tgl_input;
            $row[] = $field->tgl_serahkan;
            $row[] = $field->nama_pelipat;
            $row[] = $field->nama_barang;
            $row[] = $field->qty;
            $row[] = $field->keterangan;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_gudang->count_all(),
            "recordsFiltered" => $this->M_gudang->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_pelipat_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_gudang->get_data_pelipat_select($searchTerm);
      echo json_encode($response);
    }

	public function get_data_produksi_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_gudang->get_data_produksi_select($searchTerm);
      echo json_encode($response);
    }

}
