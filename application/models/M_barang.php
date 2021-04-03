<?php 
class M_barang extends CI_Model {
	
	var $table = "(SELECT b.kode_barang,b.nama_barang,b.ukuran_barang,b.bahan_barang,b.kode_perusahaan,p.nama_perusahaan ,b.minimum_stok
                    FROM barang b 
                    LEFT JOIN perusahaan p ON b.kode_perusahaan=p.kode_perusahaan
                    ) tabel"; //nama tabel dari database
    var $column_order = array(null,null,  'kode_barang','nama_barang','ukuran_barang','bahan_barang','nama_perusahaan','minimum_stok'); //field yang ada di table user
    var $column_search = array('kode_barang','nama_barang','ukuran_barang','bahan_barang','nama_perusahaan','minimum_stok');  //field yang diizin untuk pencarian 
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


   	public function saveBarang($kode,$nama,$ukuran_barang,$bahan_barang,$kode_perusahaan,$minimum_stok)
        {
                $sql = "insert into barang values ('$kode','$nama','$ukuran_barang','$bahan_barang','$kode_perusahaan','$minimum_stok')";
				
				$query = $this->db->query($sql);
		}

   	public function updateBarang($kodelama,$kodebaru,$nama,$ukuran_barang,$bahan_barang,$kode_perusahaan,$minimum_stok)
        {
                $sql = "update barang set nama_barang='$nama',ukuran_barang='$ukuran_barang',bahan_barang='$bahan_barang', kode_barang='$kodebaru', kode_perusahaan='$kode_perusahaan', minimum_stok='$minimum_stok' where kode_barang='$kodelama'";
				$query = $this->db->query($sql);
		}

   	public function deleteBarang($kode)
        {
                $sql = "delete from barang where kode_barang='$kode'";
				
				$query = $this->db->query($sql);
		}

   	public function getBarangAll()
        {
                $sql = "SELECT b.kode_barang,b.nama_barang,b.ukuran_barang,b.bahan_barang,b.kode_perusahaan,p.nama_perusahaan ,b.minimum_stok
                    FROM barang b 
                    LEFT JOIN perusahaan p ON b.kode_perusahaan=p.kode_perusahaan";
				
				$query = $this->db->query($sql);

                return $query->result();
        }

	public function getBarangByKode($kodebarang)
        {
                $sql = "SELECT b.kode_barang,b.nama_barang,b.ukuran_barang,b.bahan_barang,b.kode_perusahaan,p.nama_perusahaan ,b.minimum_stok
                    FROM barang b 
                    LEFT JOIN perusahaan p ON b.kode_perusahaan=p.kode_perusahaan where kode_barang='$kodebarang'";
				
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
 
  public function get_data_perusahaan_select($searchTerm=""){

      $sql = "select * from perusahaan where kode_perusahaan like '%".$searchTerm."%' or nama_perusahaan like '%".$searchTerm."%' limit 10;";
        
      $query = $this->db->query($sql);

      $hasil= $query->result_array();

      // Initialize Array with fetched data
        $data = array();
        foreach($hasil as $h){
            $data[] = array("id"=>$h['kode_perusahaan'], "text"=>$h['nama_perusahaan']);
        }
        return $data;

  }

}