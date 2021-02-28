<?php 
class M_login extends CI_Model {
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function login($username,$password)
        {
                $sql = "select * from akun where user_name='$username' and pass_word=md5('$password')";
				
				$query = $this->db->query($sql);
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}

   	public function getUserDetail($username,$password)
        {
                $sql = "select * from akun where user_name='$username' and pass_word=md5('$password')";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

   	public function updatePassword($kode_petugas,$password)
        {
                $sql = "update akun set pass_word=md5('$password') where kode_petugas='$kode_petugas'";
				
				$query = $this->db->query($sql);
        }
	
	public function simpanloglogin($datalogin) {
		$this->db->insert('history_login',$datalogin);	
	}

	
	
}