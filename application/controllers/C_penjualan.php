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
		  $this->load->model('M_customer');
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
			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();

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

	public function ubah_cart($id_transaksi_penjualan)
		{
			if($this->session->is_logged){
				$user_id = $this->session->userid;
				$data['menu_active'] = 'penjualan';

				$var = $this->session->userdata;
				$data['nama_petugas']=$var['nama_petugas'];
				$data['kode_hak_akses']=$var['kode_hak_akses'];
				
				$data['getAllBarang'] = $this->M_barang->getBarangAll();
				$data['getAllCustomer'] = $this->M_customer->getCustomerAll();

				$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);

				$data['penjualan']=$this->M_penjualan->getPenjualanByKodeCart($id_transaksi_penjualan);
				$detailpenjualan=$this->M_penjualan->getPenjualanDetailByKodeCart($id_transaksi_penjualan);
				$this->cart->destroy();

				foreach ($detailpenjualan as $gdp) {
					
				 	$nama=str_replace(",",".",$gdp->name);
				    $nama=str_replace("+","-Plus",$nama);
				    
				 		$belanjaan = array(
							'id' => $gdp->id, 
							'name' => $nama, 
							'price' => $gdp->price, 
							'qty' => $gdp->qty, 
						);
						$this->cart->insert($belanjaan);
				 }

				$data['status']='ubah';
				
				$this->load->view('V_header',$data);
				$this->load->view('V_menu',$data);
				$this->load->view('penjualan/V_penjualan_cart',$data);
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
			$tgl_transaksi = $this->input->post('tgl_transaksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_customer = $this->input->post('kode_customer');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$harga_barang = $this->input->post('harga_barang');
			$jumlah_bayar = $this->input->post('jumlah_bayar');
			$status_transaksi = $this->input->post('status_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_input=date('Y-m-d',strtotime($tgl_input));
			$tgl_transaksi=date('Y-m-d',strtotime($tgl_transaksi));
			
			$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);

			$this->M_penjualan->updatePenjualan($id_transaksi_penjualan,$id_transaksi_penjualanbaru,$tgl_input, $tgl_transaksi, $kode_petugas, $kode_customer, $kode_barang, $qty, $harga_barang, $jumlah_bayar, $status_transaksi, $keterangan);
			$data['id_transaksi_penjualan']=$id_transaksi_penjualanbaru;
			$this->load->view('penjualan/V_penjualan_ubah',$data);
			
		}else{
			redirect('index');
		}

	}

	public function simpanubah_cart($id_transaksi_penjualan)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';
			$data['status']='ubah';

			$id_transaksi_penjualanbaru = $this->input->post('id_transaksi_penjualan');
			$tgl_input = $this->input->post('tgl_input');
			$tgl_transaksi = $this->input->post('tgl_transaksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_customer = $this->input->post('kode_customer');
			
			$jumlah_bayar = $this->cart->total();
			$status_transaksi = $this->input->post('status_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_input=date('Y-m-d',strtotime($tgl_input));
			$tgl_transaksi=date('Y-m-d',strtotime($tgl_transaksi));
			
			$id_transaksi_penjualan=urldecode($id_transaksi_penjualan);

			$belanjaan = $this->cart->contents();

			$this->M_penjualan->updatePenjualanCart($id_transaksi_penjualan,$id_transaksi_penjualanbaru,$tgl_input, $tgl_transaksi, $kode_petugas, $kode_customer, $kode_barang, $qty, $harga_barang, $jumlah_bayar, $status_transaksi, $keterangan,$belanjaan);
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

			$tgl_transaksi = $this->input->post('tgl_transaksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_customer = $this->input->post('kode_customer');
			$kode_barang = $this->input->post('kode_barang');
			$qty = $this->input->post('qty');
			$harga_barang = $this->input->post('harga_barang');
			$jumlah_bayar = $this->input->post('jumlah_bayar');
			$status_transaksi = $this->input->post('status_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_transaksi=date('Y-m-d',strtotime($tgl_transaksi));


			$this->M_penjualan->savePenjualan($tgl_input, $tgl_transaksi, $kode_petugas, $kode_customer, $kode_barang, $qty, $harga_barang, $jumlah_bayar, $status_transaksi, $keterangan);
			$data['id_transaksi_penjualan']=$id_transaksi_penjualan;
			$this->load->view('penjualan/V_penjualan_simpan',$data);

		}else{
			redirect('index');
		}

	}

	public function simpan_cart()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';
			
			$data['status'] = 'tambah';

			$tgl_transaksi = $this->input->post('tgl_transaksi');
			$kode_petugas = $this->session->userdata('kode_petugas');
			$kode_customer = $this->input->post('kode_customer');
			$jumlah_bayar = $this->cart->total();
			$status_transaksi = $this->input->post('status_transaksi');
			$keterangan = $this->input->post('keterangan');

			$tgl_transaksi=date('Y-m-d',strtotime($tgl_transaksi));


			$belanjaan = $this->cart->contents();

			$this->M_penjualan->savePenjualanChart($tgl_input, $tgl_transaksi, $kode_petugas, $kode_customer, $kode_barang, $qty, $harga_barang, $jumlah_bayar, $status_transaksi, $keterangan,$belanjaan);
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
			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('penjualan/V_penjualan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function tambah_cart()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'penjualan';


			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			
			$data['status']='tambah';

			$data['getAllBarang'] = $this->M_barang->getBarangAll();
			$data['getAllCustomer'] = $this->M_customer->getCustomerAll();
			
			$this->cart->destroy();

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('penjualan/V_penjualan_cart',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}


	function add_to_cart(){ 
		$data = array(
			'id' => $this->input->post('product_id'), 
			'name' => $this->input->post('product_name'), 
			'price' => $this->input->post('product_price'), 
			'qty' => $this->input->post('quantity'), 
		);
		$this->cart->insert($data);
		echo $this->show_cart(); 
	}

	function show_cart(){ 
		$output = '';
		$no = 0;
		foreach ($this->cart->contents() as $items) {
			$no++;
			$output .='
				<tr>
					<td>'.$no.'</td>
					<td>'.$items['name'].'</td>
					<td>'.number_format($items['price']).'</td>
					<td>'.$items['qty'].'</td>
					<td>'.number_format($items['subtotal']).'</td>
					<td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
				</tr>
			';
		}
		$output .= '
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">'.'Rp '.number_format($this->cart->total()).'</th>
			</tr>
		';
		return $output;
	}

	function load_cart(){ 
		echo $this->show_cart();
	}

	function delete_cart(){ 
		$data = array(
			'rowid' => $this->input->post('row_id'), 
			'qty' => 0, 
		);
		$this->cart->update($data);
		echo $this->show_cart();
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
            $row[] = '<a href="'.base_url('penjualan/ubah_cart/').urlencode($field->id_transaksi_penjualan).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('penjualan/hapus/').urlencode($field->id_transaksi_penjualan).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->tgl_input;
            $row[] = $field->tgl_transaksi_tampil;
            $row[] = $field->nama_petugas;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_barang;
            $row[] = $field->jumlah_bayar;
            $row[] = $field->status_transaksi;
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

	public function get_data_customer_select(){
      $searchTerm = $this->input->post('searchTerm');
      $response = $this->M_penjualan->get_data_customer_select($searchTerm);
      echo json_encode($response);
    }

}
