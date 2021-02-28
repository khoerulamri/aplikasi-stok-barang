<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_laporan extends CI_Controller {

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
		  ini_set('memory_limit', "-1");
		  ini_set('max_execution_time', "0");
		  $this->load->model('M_pemesanan');
		  $this->load->model('M_instansi');
		  $this->load->model('M_pembayaran');

    }

	public function index()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporanpemesanan';
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan/V_laporan_pemesanan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function createPDF($title,$html,$action){
			//load mPDF library
			$this->load->library('Pdf');
			//actually, you can pass mPDF parameter on this load() function
			$pdf = $this->pdf->load();
			//$this->mpdf = new mPDF();
			$pdf = new mPDF('utf-8','Legal-P', 0, '', 9, 9, 9, 9); 
			//generate the PDF!
			$pdf->WriteHTML($html);
			//offer it to user via browser download! (The PDF won't be saved on your server HDD)
			$pdf->Output($title, $action);
	
		}

	public function laporanPemesanan()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporanpemesanan';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan/V_laporan_pemesanan',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function laporanPembayaran()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporanpembayaran';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan/V_laporan_pembayaran',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function laporanKinerjaPJ()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporankinerjaperpj';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan/V_laporan_kinerja_pj',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function laporanPemesananPerPJ()
	{
		if($this->session->is_logged){
			$user_id = $this->session->userid;
			$data['menu_active'] = 'laporanpemesananperpj';

			
			$var = $this->session->userdata;
			$data['nama_petugas']=$var['nama_petugas'];
			$data['kode_hak_akses']=$var['kode_hak_akses'];
			
			$this->load->view('V_header',$data);
			$this->load->view('V_menu',$data);
			$this->load->view('laporan/V_laporan_pemesanan_per_pj',$data);
			$this->load->view('V_footer',$data);

		}else{
			redirect('index');
		}

	}

	public function laporanPemesananPerPJPDF()
	{
		if($this->session->is_logged){
			
			$tgldari = $this->input->post('tgldari');
			$tglsampai = $this->input->post('tglsampai');

			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = date('Y-m-d',strtotime($tglsampai));
			

			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['pemesanan']=$this->M_pemesanan->getPesananAllPJ($tgldari,$tglsampai);

			$data['tgldari']=$tgldari;
			$data['tglsampai']=$tglsampai;

			$this->load->view('laporan/V_laporan_pemesanan_per_pj_pdf',$data);


		}else{
			redirect('index');
		}

	}

	public function laporanHutangCustomer()
	{
		if($this->session->is_logged){
			
			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['hutangcustomer']=$this->M_pemesanan->getHutangCustomerAll();

			$this->load->view('laporan/V_laporan_hutang_customer_pdf',$data);

			$html=$this->load->view('laporan/V_laporan_hutang_customer_pdf',$data,true);
		
			//Call PDF function
			$this->createPDF('LapHutangCustomer.pdf',$html,"I");


		}else{
			redirect('index');
		}

	}

	public function laporanKinerjaPJHTML()
	{
		if($this->session->is_logged){

			$tgldari = $this->input->post('tgldari');
			$tglsampai = $this->input->post('tglsampai');

			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = date('Y-m-d',strtotime($tglsampai));
			
			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['kinerjaPJ']=$this->M_pemesanan->lapkinerjapj($tgldari,$tglsampai);
			$data['tgldari']=$tgldari;
			$data['tglsampai']=$tglsampai;


			$this->load->view('laporan/V_laporan_kinerja_pj_pdf',$data);

			$html=$this->load->view('laporan/V_laporan_kinerja_pj_pdf',$data,true); 
		
			//Call PDF function
			$this->createPDF('LapKinerjaPJ.pdf',$html,"I");
			
		}else{
			redirect('index');
		}

	}

	/*public function laporanPemesananPDF(){



			$tgldari = $this->input->post('tgldari');
			$tglsampai = $this->input->post('tglsampai');

			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = date('Y-m-d',strtotime($tglsampai));

			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['pemesanan']=$this->M_pemesanan->getPesananAllAsc($tgldari,$tglsampai);

			$this->load->view('laporan/V_laporan_pemesanan_pdf',$data);

			$html=$this->load->view('laporan/V_laporan_pemesanan_pdf', $data, true); 
		
			//Call PDF function
			$this->createPDF('test.pdf',$html);

		}*/

	public function laporanPemesananHTML(){

			$tgldari = $this->input->post('tgldari');
			$tglsampai = $this->input->post('tglsampai');

			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = date('Y-m-d',strtotime($tglsampai));

			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['pemesanan']=$this->M_pemesanan->getPesananAllAsc($tgldari,$tglsampai);
			$data['tgldari']=$tgldari;
			$data['tglsampai']=$tglsampai;

			$this->load->view('laporan/V_laporan_pemesanan_pdf',$data);

		}

	public function laporanPembayaranHTML(){

			$tgldari = $this->input->post('tgldari');
			$tglsampai = $this->input->post('tglsampai');

			$tgldari = date('Y-m-d',strtotime($tgldari));
			$tglsampai = date('Y-m-d',strtotime($tglsampai));

			$data['nama_instansi']=$this->M_instansi->getKonfig('nama_instansi');
			$data['alamat']=$this->M_instansi->getKonfig('alamat');
			$data['telepon']=$this->M_instansi->getKonfig('telepon');
			$data['slogan']=$this->M_instansi->getKonfig('slogan');
			$data['website']=$this->M_instansi->getKonfig('website');
			$data['pembayaran']=$this->M_pembayaran->getPembayaranAllAsc($tgldari,$tglsampai);
			$data['tgldari']=$tgldari;
			$data['tglsampai']=$tglsampai;

			$this->load->view('laporan/V_laporan_pembayaran_pdf',$data);

		}




}
