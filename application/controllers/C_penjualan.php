<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penjualan extends CI_Controller {

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
		  
		  $this->load->model('M_penjualan');
		  $this->load->model('M_barang');
		  $this->load->model('M_sumber_transaksi');
		  $this->load->helper('date');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('penjualan/V_data_penjualan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($id_transaksi_penjualan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';
			
			$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);
			$data['penjualan']=$this->M_penjualan->deletePenjualan($id_transaksi_penjualan);
			
			$this->load->view('penjualan/V_penjualan_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($id_transaksi_penjualan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['getAllBarang'] = $this->M_barang->getBarangAll();
			$data['getAllsumber_transaksi'] = $this->M_sumber_transaksi->getSumberTransaksiAll();

			$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);
			$data['penjualan']=$this->M_penjualan->getPenjualanByKode($id_transaksi_penjualan);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('penjualan/V_penjualan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($id_transaksi_penjualan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';
			$data['status']='ubah';

			$id_transaksi_penjualanbaru = $this->input->post('id_transaksi_penjualan');
			$tgl_input = $this->input->post('tgl_input');
			$tgl_penjualan = $this->input->post('tgl_penjualan');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$kode_sumber_transaksi = $this->input->post('kode_sumber_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_input=date('Y-m-d',strtotime($tgl_input));
			$tgl_penjualan=date('Y-m-d',strtotime($tgl_penjualan));
			
			$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);
			$this->M_penjualan->updatePenjualan($id_transaksi_penjualan,$id_transaksi_penjualanbaru,$tgl_input,$tgl_penjualan,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan);
			$data['id_transaksi_penjualan']=$id_transaksi_penjualanbaru;
			$this->load->view('penjualan/V_penjualan_ubah',$data);
			
		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';
			
			$data['status'] = 'tambah';

			$tgl_input = $this->input->post('tgl_input');
			$tgl_penjualan = $this->input->post('tgl_penjualan');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$kode_sumber_transaksi = $this->input->post('kode_sumber_transaksi');
			$keterangan = $this->input->post('keterangan');


			$tgl_penjualan=date('Y-m-d',strtotime($tgl_penjualan));


			$this->M_penjualan->savePenjualan($tgl_input,$tgl_penjualan,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan);
			$data['id_transaksi_penjualan']=$id_transaksi_penjualan;
			$this->load->view('penjualan/V_penjualan_simpan',$data);

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			
			$data['status']='tambah';

			$data['getAllBarang'] = $this->M_barang->getBarangAll();
			$data['getAllsumber_transaksi'] = $this->M_sumber_transaksi->getSumberTransaksiAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('penjualan/V_penjualan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_penjualan()
    {
        $list = $this->M_penjualan->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('penjualan/ubah/').urlencode($field->id_transaksi_penjualan).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('penjualan/hapus/').urlencode($field->id_transaksi_penjualan).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->tgl_input;
            $row[] = $field->tgl_penjualan;
            $row[] = $field->nama_petugas;
            $row[] = $field->nama_barang;
            $row[] = $field->qty;
            $row[] = $field->nama_sumber_transaksi;
            $row[] = $field->keterangan;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_penjualan->count_all(),
            "recordsFiltered" => $this->M_penjualan->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_barang_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_penjualan->get_data_barang_select($searchTerm);
      echo json_encode($response);
    }

	public function get_data_sumber_transaksi_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_penjualan->get_data_sumber_transaksi_select($searchTerm);
      echo json_encode($response);
    }

}
