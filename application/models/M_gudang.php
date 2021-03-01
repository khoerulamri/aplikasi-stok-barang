<?php 
class M_gudang extends CI_Model {
	
	var $table = "(
                SELECT g.id_transaksi_gudang
              ,p.id_transaksi_produksi
              ,p.tgl_input AS tgl_input_produksi
              ,p.tgl_produksi
              ,p.kode_petugas
              ,a.nama_petugas
              ,p.kode_barang
              ,b.nama_barang
              ,DATE_FORMAT(g.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil
              ,DATE_FORMAT(g.tgl_serahkan,_utf8'%d %b %y') AS tgl_serahkan_tampil
               ,pe.nama_pelipat
              ,g.tgl_input
              ,g.tgl_serahkan
              ,g.kode_pelipat
              ,g.qty
              ,g.keterangan
               FROM  gudang g
              LEFT JOIN produksi p ON g.id_transaksi_produksi=p.id_transaksi_produksi
              LEFT JOIN pelipat pe ON pe.kode_pelipat=g.kode_pelipat
              LEFT JOIN barang b ON p.kode_barang=b.kode_barang
              LEFT JOIN akun a ON a.kode_petugas=g.kode_petugas
              ) tabel"; //nama tabel dari database

    var $column_order = array(null,null,'tgl_input_tampil','tgl_serahkan_tampil','nama_pelipat','nama_barang','qty','keterangan'); //field yang ada di table 
    var $column_search = array('tgl_input_tampil','tgl_serahkan_tampil','nama_pelipat','nama_barang','qty','keterangan');  //field yang diizin untuk pencarian 
    var $order = array('tgl_input' => 'desc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkGudang($id_transaksi_gudang)
        {
                $sql = "select * from gudang where id_transaksi_gudang='$id_transaksi_gudang'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function saveGudang($tgl_input,$tgl_serahkan,$kode_petugas,$kode_pelipat,$qty,$keterangan,$id_transaksi_produksi)
        {
          $sql = "insert into gudang (tgl_input,tgl_serahkan,kode_petugas,kode_pelipat,qty,keterangan,id_transaksi_produksi) values (now(),'$tgl_serahkan','$kode_petugas','$kode_pelipat','$qty','$keterangan','$id_transaksi_produksi')"; 
          $query = $this->db->query($sql);
		}

   	public function updateGudang($kodelama,$kodebaru,$tgl_input,$tgl_serahkan,$kode_petugas,$kode_pelipat,$qty,$keterangan,$id_transaksi_produksi)
        {
                $sql = "update gudang set tgl_serahkan='$tgl_serahkan',kode_petugas='$kode_petugas', kode_pelipat='$kode_pelipat', qty='$qty', keterangan='$keterangan', id_transaksi_produksi='$id_transaksi_produksi' where id_transaksi_gudang='$kodelama'";
				$query = $this->db->query($sql);

			
		}

   	public function deleteGudang($kode)
      {
          $sql ="INSERT INTO gudang_hapus SELECT *,now() as tgl_hapus FROM gudang where id_transaksi_gudang='$kode'";
          $query = $this->db->query($sql);
          $sql = "delete from gudang where id_transaksi_gudang='$kode'";
  				$query = $this->db->query($sql);
		}

   	public function getGudangAll()
        {
                $sql = "SELECT g.id_transaksi_gudang
              ,p.id_transaksi_produksi
              ,p.tgl_input AS tgl_input_produksi
              ,p.tgl_produksi
              ,p.kode_petugas
              ,a.nama_petugas
              ,p.kode_barang
              ,b.nama_barang
              ,DATE_FORMAT(g.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil
              ,DATE_FORMAT(g.tgl_serahkan,_utf8'%d %b %y') AS tgl_serahkan_tampil
               ,pe.nama_pelipat
              ,g.tgl_serahkan
              ,g.kode_pelipat
              ,g.qty
              ,g.keterangan
               FROM  gudang g
              LEFT JOIN produksi p ON g.id_transaksi_produksi=p.id_transaksi_produksi
              LEFT JOIN pelipat pe ON pe.kode_pelipat=g.kode_pelipat
              LEFT JOIN barang b ON p.kode_barang=b.kode_barang
              LEFT JOIN akun a ON a.kode_petugas=g.kode_petugas ORDER BY tgl_input desc";
                
                $query = $this->db->query($sql);

                return $query->result();
        }


	public function getGudangByKode($id_transaksi_gudang)
        {
                $sql = "SELECT g.id_transaksi_gudang
              ,p.id_transaksi_produksi
              ,p.tgl_input AS tgl_input_produksi
              ,p.tgl_produksi
              ,p.kode_petugas
              ,a.nama_petugas
              ,p.kode_barang
              ,b.nama_barang
              ,DATE_FORMAT(g.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil
              ,DATE_FORMAT(g.tgl_serahkan,_utf8'%d %b %y') AS tgl_serahkan_tampil
               ,pe.nama_pelipat
              ,g.tgl_serahkan
              ,g.kode_pelipat
              ,g.qty
              ,g.keterangan
               FROM  gudang g
              LEFT JOIN produksi p ON g.id_transaksi_produksi=p.id_transaksi_produksi
              LEFT JOIN pelipat pe ON pe.kode_pelipat=g.kode_pelipat
              LEFT JOIN barang b ON p.kode_barang=b.kode_barang
              LEFT JOIN akun a ON a.kode_petugas=g.kode_petugas where id_transaksi_gudang='$id_transaksi_gudang'";
				
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
    

   public function get_data_pelipat_select($searchTerm=""){

      $sql = "select * from pelipat where kode_pelipat like '%".$searchTerm."%' or nama_pelipat like '%".$searchTerm."%' limit 10;";
        
      $query = $this->db->query($sql);

      $hasil= $query->result_array();

      // Initialize Array with fetched data
        $data = array();
        foreach($hasil as $h){
            $data[] = array("id"=>$h['kode_pelipat'], "text"=>$h['nama_pelipat']);
        }
        return $data;

  }

  public function get_data_produksi_select($searchTerm=""){

      $sql = "SELECT id_transaksi_produksi,tgl_input,tgl_produksi,p.kode_petugas,a.nama_petugas, nama_sumber_transaksi,
                  p.kode_barang,b.nama_barang, p.qty,p.keterangan,
                  DATE_FORMAT(p.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil,
                  DATE_FORMAT(p.tgl_produksi,_utf8'%d %b %y') AS tgl_produksi_tampil
                  ,concat((DATE_FORMAT(p.tgl_produksi,_utf8'%d %b %y')),' ',nama_sumber_transaksi,' ',nama_barang) as gabung
                   FROM produksi p
                  LEFT JOIN akun a ON p.kode_petugas=a.kode_petugas 
                  LEFT JOIN sumber_transaksi st ON st.kode_sumber_transaksi=p.kode_sumber_transaksi
                  LEFT JOIN barang b ON b.kode_barang=p.kode_barang where nama_barang like '%".$searchTerm."%' or nama_sumber_transaksi like '%".$searchTerm."%' or DATE_FORMAT(p.tgl_produksi,_utf8'%d %b %y') like '%".$searchTerm."%' limit 10;";
        
      $query = $this->db->query($sql);

      $hasil= $query->result_array();

      // Initialize Array with fetched data
        $data = array();
        foreach($hasil as $h){
            $data[] = array("id"=>$h['id_transaksi_produksi'], "text"=>$h['gabung']);
        }
        return $data;

  }
	
}