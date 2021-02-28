<?php 
class M_perusahaan extends CI_Model {
	
	var $table = 'perusahaan'; //nama tabel dari database
    var $column_order = array(null,null,  'kode_perusahaan','nama_perusahaan','alamat','telpon','keterangan'); //field yang ada di table user
    var $column_search = array('kode_perusahaan','nama_perusahaan','alamat','telpon','keterangan');  //field yang diizin untuk pencarian 
    var $order = array('nama_perusahaan' => 'asc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkPerusahaan($kodeperusahaan)
        {
                $sql = "select * from perusahaan where kode_perusahaan='$kodeperusahaan'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function savePerusahaan($kode,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "insert into perusahaan values ('$kode','$nama','$alamat','$telepon','$keterangan')";
				
				$query = $this->db->query($sql);
		}

   	public function updatePerusahaan($kodelama,$kodebaru,$nama,$telepon,$alamat,$keterangan)
        {
                $sql = "update perusahaan set nama_perusahaan='$nama',telpon='$telepon',alamat='$alamat',keterangan='$keterangan', kode_perusahaan='$kodebaru' where kode_perusahaan='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deletePerusahaan($kode)
        {
                $sql = "delete from perusahaan where kode_perusahaan='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getPerusahaanAll()
        {
                $sql = "select * from perusahaan order by nama_perusahaan";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getPerusahaanByKode($kodeperusahaan)
        {
                $sql = "select * from perusahaan where kode_perusahaan='$kodeperusahaan'";
				
				$query = $this->db->query($sql);

                return $query->result();
        }
	
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // looping awal
        {
            if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {
                 
                if($i===0) // looping awal
                {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order'])) 
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 

}