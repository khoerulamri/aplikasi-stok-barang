<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_index extends CI_Controller {

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
          
		  $this->load->model('M_dashboard');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['Menu'] = 'dashboard';
			
			$data['menu_active'] = 'dashboard';

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			//$data['order_hari_ini']=$this->M_dashboard->orderHariIni();
			//$data['bayar_hari_ini']=$this->M_dashboard->bayarHariIni();
			//$data['lewat_batas_tempo']=$this->M_dashboard->monitoringOrderTempoRed();
			//$data['lewat_batas_tempo2']=$this->M_dashboard->monitoringOrderTempoYellow();
			//$data['lewat_batas_tempo34']=$this->M_dashboard->monitoringOrderTempoBlue();
			//$data['lewat_batas_tempo5']=$this->M_dashboard->monitoringOrderTempoGreen();

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('V_index',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function monitoringTempo($source)
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'dashboard';

			$data['sumber']=$source;

			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];

			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('pemesanan/V_data_monitoring_tempo',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	
	function get_data_red()
    {
        $list = $this->M_dashboard->get_datatables('notif_tempo < "0"');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pemesanan/ubah/').urlencode($field->kode_order).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pemesanan/hapus/').urlencode($field->kode_order).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_order;
            $row[] = $field->tgl_order_tampil;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_pj;
            $row[] = $field->total_harga;
            $row[] = $field->kekurangan;
            $row[] = $field->nama_status;
            $row[] = $field->tgl_tempo_tampil;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard->count_all('notif_tempo < "0"'),
            "recordsFiltered" => $this->M_dashboard->count_filtered('notif_tempo < "0"'),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_data_yellow()
    {
        $list = $this->M_dashboard->get_datatables('notif_tempo between  "0" and "2"');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pemesanan/ubah/').urlencode($field->kode_order).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pemesanan/hapus/').urlencode($field->kode_order).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_order;
            $row[] = $field->tgl_order_tampil;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_pj;
            $row[] = $field->total_harga;
            $row[] = $field->kekurangan;
            $row[] = $field->nama_status;
            $row[] = $field->tgl_tempo_tampil;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard->count_all('notif_tempo between  "0" and "2"'),
            "recordsFiltered" => $this->M_dashboard->count_filtered('notif_tempo between  "0" and "2"'),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_data_blue()
    {
        $list = $this->M_dashboard->get_datatables('notif_tempo between "3" and "4"');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pemesanan/ubah/').urlencode($field->kode_order).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pemesanan/hapus/').urlencode($field->kode_order).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_order;
            $row[] = $field->tgl_order_tampil;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_pj;
            $row[] = $field->total_harga;
            $row[] = $field->kekurangan;
            $row[] = $field->nama_status;
            $row[] = $field->tgl_tempo_tampil;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard->count_all('notif_tempo between "3" and "4"'),
            "recordsFiltered" => $this->M_dashboard->count_filtered('notif_tempo between "3" and "4"'),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    function get_data_green()
    {
        $list = $this->M_dashboard->get_datatables('notif_tempo >= "5"');
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a href="'.base_url('pemesanan/ubah/').urlencode($field->kode_order).'" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i></a>
            		  <a href="'.base_url('pemesanan/hapus/').urlencode($field->kode_order).'" onclick="return confirm(\'Apakah Anda yakin untuk menghapus Data ini ?\')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i></a>
            		  ';
            $row[] = $field->kode_order;
            $row[] = $field->tgl_order_tampil;
            $row[] = $field->nama_customer;
            $row[] = $field->nama_pj;
            $row[] = $field->total_harga;
            $row[] = $field->kekurangan;
            $row[] = $field->nama_status;
            $row[] = $field->tgl_tempo_tampil;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_dashboard->count_all('notif_tempo >= "5"'),
            "recordsFiltered" => $this->M_dashboard->count_filtered('notif_tempo >= "5"'),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }


}
