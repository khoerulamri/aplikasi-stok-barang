<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {

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

          $this->load->library('User_agent');
 		  $data['browser'] = $this->agent->browser();
 		  $data['version'] = $this->agent->version();	
		  
		  $this->load->model('M_login');

    }
	
	public function index()
	{
		$this->load->view('V_login');
	}

	public function login()
	{
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$log = $this->M_login->login($username,$password);
		


		if($log){
			$user = $this->M_login->getUserDetail($username,$password);
			
			foreach($user as $user_item){
				$kode_petugas = $user_item->kode_petugas;
				$user_name = $user_item->user_name;
				$kode_hak_akses = $user_item->kode_hak_akses;
				$nama_petugas = $user_item->nama_petugas;
			}
			$ses = array(
							'is_logged' => 1,
							'kode_petugas' 	=> $kode_petugas,
							'user_name' 	=> $user_name,
							'kode_hak_akses' 	=> $kode_hak_akses,
							'nama_petugas' 	=> $nama_petugas
						);
			$this->session->set_userdata($ses);
			
			$userlogin = $this->session->userdata('kode_petugas');
			$sumber=$this->agent->agent_string();
			$ip= $this->input->ip_address();
			$os=$this->agent->platform();
			$this->simpanloglogin($userlogin,$sumber,$ip,$os);

			redirect('dashboard');

		}else{
			$ses = array(
							'gagal' => 1,
						);
			$this->session->set_userdata($ses);
			$data['pesan']='<div class="alert alert-danger text-center">
                Username dan Password Anda Salah. <br>Silahkan coba kembali dengan Username dan Password yang sesuai.
            </div>';
            $this->load->view('V_login',$data);

		}
	}

	public function simpanloglogin($kode_petugas,$sumber,$ip,$os)
	{
        	$datalogin = array( 
				'kode_petugas' 			=> $kode_petugas,
				'browser'				=> $sumber,
				'ip_address'			=> $ip,
				'os'			=> $os,
				'waktu_login'			=> date('Y-m-d H:i:s')
		);
			
		$save = $this->M_login->simpanloglogin($datalogin);
	}

	public function changePassword()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
						
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('V_changepassword',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}
	}

	public function changePasswordSimpan()
	{
		
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$password_baru_lagi = $this->input->post('password_baru_lagi');

		$var = $this->session->userdata;	
		$username=$var['user_name'];
		$kode_petugas=$var['kode_petugas'];

		//check password lama sesuai tidak
		$log = $this->M_login->login($username,$password_lama);

		if($log==true)
		{
			//check password baru apakah sama
				if($password_baru==$password_baru_lagi)
				{
					$this->M_login->updatePassword($kode_petugas,$password_baru);
					$this->load->view('V_password_berhasil');
				}
				else
				{
					$this->load->view('V_password_baru_tidak_sama',$data);
				}
		}
		else
		{
			$this->load->view('V_password_lama_salah',$data);
		}
		
	}

	public function logout(){
		$this->session->unset_userdata('is_logged');
		if($this->session->gagal){
			$this->session->unset_userdata('gagal');
		}
		redirect('index');
	}
}
