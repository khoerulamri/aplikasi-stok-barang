<?php 
class M_password extends CI_Model {
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function updatePassword($kode_petugas,$pass_word)
        {
                $sql = "update akun set pass_word='$pass_word' where kode_petugas='$kode_petugas'";
				
				$query = $this->db->query($sql);

                return $query->result();
		}

   	public function checkPassword($user_name,$pass_word)
        {
                $sql = "select * from akun  a left join petugas b on a.kode_petugas=b.kode_petugas left join hak_akses c on a.kode_hak_akses=c.kode_hak_akses where a.user_name='$user_name' and pass_word='$pass_word'";
				
				$query = $this->db->query($sql);
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
        }
	
}