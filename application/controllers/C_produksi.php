<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_produksi extends CI_Controller {

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
		  $this->load->model('M_barang');
		  $this->load->model('M_sumber_transaksi');
		  $this->load->helper('date');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('produksi/V_data_produksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($id_transaksi_produksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';
			
			$id_transaksi_produksi=urldecode($id_transaksi_produksi);
			$data['produksi']=$this->M_produksi->deleteProduksi($id_transaksi_produksi);
			
			$this->load->view('produksi/V_produksi_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($id_transaksi_produksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['getAllBarang'] = $this->M_barang->getBarangAll();
			$data['getAllsumber_transaksi'] = $this->M_sumber_transaksi->getSumberTransaksiAll();

			$id_transaksi_produksi=urldecode($id_transaksi_produksi);
			$data['produksi']=$this->M_produksi->getProduksiByKode($id_transaksi_produksi);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('produksi/V_produksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($id_transaksi_produksi)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';
			$data['status']='ubah';

			$id_transaksi_produksibaru = $this->input->post('id_transaksi_produksi');
			$tgl_input = $this->input->post('tgl_input');
			$tgl_produksi = $this->input->post('tgl_produksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$kode_sumber_transaksi = $this->input->post('kode_sumber_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_input=date('Y-m-d',strtotime($tgl_input));
			$tgl_produksi=date('Y-m-d',strtotime($tgl_produksi));
			
			$id_transaksi_produksi=urldecode($id_transaksi_produksi);
			$this->M_produksi->updateProduksi($id_transaksi_produksi,$id_transaksi_produksibaru,$tgl_input,$tgl_produksi,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan);
			$data['id_transaksi_produksi']=$id_transaksi_produksibaru;
			$this->load->view('produksi/V_produksi_ubah',$data);
			
		}else{
			redirect('index');
		}

	}

	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';
			
			$data['status'] = 'tambah';

			$tgl_input = $this->input->post('tgl_input');
			$tgl_produksi = $this->input->post('tgl_produksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$kode_sumber_transaksi = $this->input->post('kode_sumber_transaksi');
			$keterangan = $this->input->post('keterangan');


			$tgl_produksi=date('Y-m-d',strtotime($tgl_produksi));


			$this->M_produksi->saveProduksi($tgl_input,$tgl_produksi,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan);
			$data['id_transaksi_produksi']=$id_transaksi_produksi;
			$this->load->view('produksi/V_produksi_simpan',$data);

		}else{
			redirect('index');
		}

	}

	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'produksi';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			
			$data['status']='tambah';

			$data['getAllBarang'] = $this->M_barang->getBarangAll();
			$data['getAllsumber_transaksi'] = $this->M_sumber_transaksi->getSumberTransaksiAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('produksi/V_produksi',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_produksi()
    {
    	$var = $this->session->userdata;
		$kode_petugas=$var['kode_petugas'];
		
        $list = $this->M_produksi->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;

            if ($kode_petugas==$field->kode_petugas)
            {
            $row[] = '<a href="'.base_url('produksi/ubah/').urlencode($field->id_transaksi_produksi).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('produksi/hapus/').urlencode($field->id_transaksi_produksi).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            }
            else
            {
            	$row[] ='';	
            }

            $row[] = $field->tgl_input;
            $row[] = $field->tgl_produksi;
            $row[] = $field->nama_petugas;
            $row[] = $field->nama_barang;
            $row[] = $field->qty;
            $row[] = $field->nama_sumber_transaksi;
            $row[] = $field->keterangan;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_produksi->count_all(),
            "recordsFiltered" => $this->M_produksi->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function get_data_barang_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_produksi->get_data_barang_select($searchTerm);
      echo json_encode($response);
    }

	public function get_data_sumber_transaksi_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_produksi->get_data_sumber_transaksi_select($searchTerm);
      echo json_encode($response);
    }

	public function get_data_perusahaan_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_produksi->get_data_perusahaan_select($searchTerm);
      echo json_encode($response);
    }

}
