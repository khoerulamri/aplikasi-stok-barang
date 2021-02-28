<?php 
class M_barang extends CI_Model {
	
	var $table = 'barang'; //nama tabel dari database
    var $column_order = array(null,null,  'kode_barang','nama_barang'); //field yang ada di table user
    var $column_search = array('kode_barang','nama_barang');  //field yang diizin untuk pencarian 
    var $order = array('nama_barang' => 'asc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkBarang($kodebarang)
        {
                $sql = "select * from barang where kode_barang='$kodebarang'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function saveBarang($kode,$nama)
        {
                $sql = "insert into barang values ('$kode','$nama')";
				
				$query = $this->db->query($sql);
		}

   	public function updateBarang($kodelama,$kodebaru,$nama)
        {
                $sql = "update barang set nama_barang='$nama', kode_barang='$kodebaru' where kode_barang='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deleteBarang($kode)
        {
                $sql = "delete from barang where kode_barang='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getBarangAll()
        {
                $sql = "select * from barang order by nama_barang";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getBarangByKode($kodebarang)
        {
                $sql = "select * from barang where kode_barang='$kodebarang'";
				
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