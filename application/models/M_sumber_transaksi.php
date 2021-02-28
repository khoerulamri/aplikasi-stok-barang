<?php 
class M_sumber_transaksi extends CI_Model {
	
	var $table = 'sumber_transaksi'; //nama tabel dari database
    var $column_order = array(null,null,  'kode_sumber_transaksi','nama_sumber_transaksi'); //field yang ada di table user
    var $column_search = array('kode_sumber_transaksi','nama_sumber_transaksi');  //field yang diizin untuk pencarian 
    var $order = array('nama_sumber_transaksi' => 'asc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkSumberTransaksi($kodesumber_transaksi)
        {
                $sql = "select * from sumber_transaksi where kode_sumber_transaksi='$kodesumber_transaksi'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function saveSumberTransaksi($kode,$nama)
        {
                $sql = "insert into sumber_transaksi values ('$kode','$nama')";
				
				$query = $this->db->query($sql);
		}

   	public function updateSumberTransaksi($kodelama,$kodebaru,$nama)
        {
                $sql = "update sumber_transaksi set nama_sumber_transaksi='$nama', kode_sumber_transaksi='$kodebaru' where kode_sumber_transaksi='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deleteSumberTransaksi($kode)
        {
                $sql = "delete from sumber_transaksi where kode_sumber_transaksi='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getSumberTransaksiAll()
        {
                $sql = "select * from sumber_transaksi order by nama_sumber_transaksi";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getSumberTransaksiByKode($kodesumber_transaksi)
        {
                $sql = "select * from sumber_transaksi where kode_sumber_transaksi='$kodesumber_transaksi'";
				
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