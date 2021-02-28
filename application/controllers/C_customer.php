<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_customer extends CI_Controller {

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
		  
		  $this->load->model('M_customer');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';
			

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$data['customer']=$this->M_customer->getCustomerAll();
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('customer/V_data_customer',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function hapus($kode_customer)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';
			
			$kode_customer=urldecode($kode_customer);
			$data['customer']=$this->M_customer->deleteCustomer($kode_customer);
			
			$this->load->view('customer/V_customer_delete',$data);

		}else{
			redirect('index');
		}

	}

	public function ubah($kode_customer)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$kode_customer=urldecode($kode_customer);
			$data['customer']=$this->M_customer->getCustomerByKode($kode_customer);
			$data['status']='ubah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('customer/V_customer',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function simpanubah($kode_customer)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';
			
			$kode_customerbaru = $this->input->post('kode_customer');
			$nama_customer = $this->input->post('nama_customer');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');


			//check kode baru sudah digunakan?
			if ($kode_customer!=$kode_customerbaru)
			{
			$hasilcheck = $this->M_customer->checkCustomer($kode_customerbaru);
			}
			else
			{
			$hasilcheck=false;	
			}


			if($hasilcheck == true){
				//notif
				$data['kode_customer']=$kode_customer;
				$this->load->view('customer/V_customer_konflik',$data);

			}
			else
			{
				//kode customer unik				
				$kode_customer=urldecode($kode_customer);
				$this->M_customer->updateCustomer($kode_customer,$kode_customerbaru,$nama_customer,$telpon,$alamat,$keterangan);
				$data['kode_customer']=$kode_customerbaru;
				$this->load->view('customer/V_customer_ubah',$data);
			}
			

		}else{
			redirect('index');
		}

	}


	public function simpan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';
			
			$kode_customer = $this->input->post('kode_customer');
			$nama_customer = $this->input->post('nama_customer');
			$telpon = $this->input->post('telpon');
			$alamat = $this->input->post('alamat');
			$keterangan = $this->input->post('keterangan');

			$hasilcheck = $this->M_customer->checkCustomer($kode_customer);

			if($hasilcheck == true){
				//notif
				$data['kode_customer']=$kode_customer;
				$this->load->view('customer/V_customer_konflik',$data);

			}
			else
			{
				//kode pj unik				
				$kode_customer=urldecode($kode_customer);
				$this->M_customer->saveCustomer($kode_customer,$nama_customer,$telpon,$alamat,$keterangan);
				$data['kode_customer']=$kode_customer;
				$this->load->view('customer/V_customer_simpan',$data);
			}
			

		}else{
			redirect('index');
		}

	}
	public function tambah()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'customer';
			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$data['status']='tambah';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('customer/V_customer',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	function get_data_customer()
    {
        $list = $this->M_customer->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('customer/ubah/').urlencode($field->kode_customer).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('customer/hapus/').urlencode($field->kode_customer).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_customer;
            $row[] = $field->nama_customer;
            $row[] = $field->alamat;
            $row[] = $field->telpon;
            $row[] = $field->keterangan; 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_customer->count_all(),
            "recordsFiltered" => $this->M_customer->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }
}
