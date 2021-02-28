<?php 
class M_penjualan extends CI_Model {
	
	var $table = "(SELECT id_transaksi_penjualan,tgl_input,tgl_penjualan,p.kode_petugas,a.nama_petugas, nama_sumber_transaksi,
p.kode_barang,b.nama_barang, p.qty,p.keterangan,
DATE_FORMAT(p.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil,
DATE_FORMAT(p.tgl_penjualan,_utf8'%d %b %y') AS tgl_penjualan_tampil
 FROM penjualan p
LEFT JOIN akun a ON p.kode_petugas=a.kode_petugas 
LEFT JOIN sumber_transaksi st ON st.kode_sumber_transaksi=p.kode_sumber_transaksi
LEFT JOIN barang b ON b.kode_barang=p.kode_barang
) tabel"; //nama tabel dari database

    var $column_order = array(null,null,'tgl_input_tampil','tgl_penjualan_tampil','nama_petugas','nama_barang','qty','nama_sumber_transaksi','keterangan'); //field yang ada di table 
    var $column_search = array('tgl_input_tampil','tgl_penjualan_tampil','nama_petugas','nama_barang','qty','nama_sumber_transaksi','keterangan');  //field yang diizin untuk pencarian 
    var $order = array('tgl_input' => 'desc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function checkPenjualan($id_transaksi_penjualan)
        {
                $sql = "select * from penjualan where id_transaksi_penjualan='$id_transaksi_penjualan'";
				
				$query = $this->db->query($sql);
		        
		        $row = $query->num_rows();
				if($row == 1){
					  return true;
				}else{
					  return false;
				}
		}


   	public function savePenjualan($tgl_input,$tgl_penjualan,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan)
        {
                
          $sql = "insert into penjualan (tgl_input,kode_petugas,kode_barang,qty,tgl_penjualan,kode_sumber_transaksi,keterangan) values (now(),'$kode_petugas','$kode_barang','$qty','$tgl_penjualan','$kode_sumber_transaksi','$keterangan')"; 
          $query = $this->db->query($sql);
		}

   	public function updatePenjualan($kodelama,$kodebaru,$tgl_input,$tgl_penjualan,$kode_petugas,$kode_barang,$qty,$kode_sumber_transaksi,$keterangan)
        {
                $sql = "update penjualan set tgl_penjualan='$tgl_penjualan',kode_petugas='$kode_petugas', kode_barang='$kode_barang', qty='$qty', kode_sumber_transaksi='$kode_sumber_transaksi', keterangan='$keterangan' where id_transaksi_penjualan='$kodelama'";
				$query = $this->db->query($sql);

			
		}

   	public function deletePenjualan($kode)
      {
          $sql ="INSERT INTO penjualan_hapus SELECT *,now() as tgl_hapus FROM penjualan where id_transaksi_penjualan='$kode'";
          $query = $this->db->query($sql);
          $sql = "delete from penjualan where id_transaksi_penjualan='$kode'";
  				$query = $this->db->query($sql);
		}

   	public function getPenjualanAll()
        {
                $sql = "SELECT id_transaksi_penjualan,tgl_input,tgl_penjualan,p.kode_petugas,a.nama_petugas, nama_sumber_transaksi,
                  p.kode_barang,b.nama_barang, p.qty,p.keterangan,
                  DATE_FORMAT(p.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil,
                  DATE_FORMAT(p.tgl_penjualan,_utf8'%d %b %y') AS tgl_penjualan_tampil
                   FROM penjualan p
                  LEFT JOIN akun a ON p.kode_petugas=a.kode_petugas 
                  LEFT JOIN sumber_transaksi st ON st.kode_sumber_transaksi=p.kode_sumber_transaksi
                  LEFT JOIN barang b ON b.kode_barang=p.kode_barang ORDER BY tgl_input desc";
                
                $query = $this->db->query($sql);

                return $query->result();
        }


	public function getPenjualanByKode($id_transaksi_penjualan)
        {
                $sql = "SELECT id_transaksi_penjualan,tgl_input,tgl_penjualan,p.kode_petugas,a.nama_petugas, p.kode_sumber_transaksi,nama_sumber_transaksi,
                  p.kode_barang,b.nama_barang, p.qty,p.keterangan,
                  DATE_FORMAT(p.tgl_input,_utf8'%d %b %y') AS tgl_input_tampil,
                  DATE_FORMAT(p.tgl_penjualan,_utf8'%d %b %y') AS tgl_penjualan_tampil
                   FROM penjualan p
                  LEFT JOIN akun a ON p.kode_petugas=a.kode_petugas 
                  LEFT JOIN sumber_transaksi st ON st.kode_sumber_transaksi=p.kode_sumber_transaksi
                  LEFT JOIN barang b ON b.kode_barang=p.kode_barang where id_transaksi_penjualan='$id_transaksi_penjualan'";
				
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
    

   public function get_data_barang_select($searchTerm=""){

      $sql = "select * from barang where kode_barang like '%".$searchTerm."%' or nama_barang like '%".$searchTerm."%' limit 10;";
        
      $query = $this->db->query($sql);

      $hasil= $query->result_array();

      // Initialize Array with fetched data
        $data = array();
        foreach($hasil as $h){
            $data[] = array("id"=>$h['kode_barang'], "text"=>$h['nama_barang']);
        }
        return $data;

  }

  public function get_data_sumber_transaksi_select($searchTerm=""){

      $sql = "select * from sumber_transaksi where kode_sumber_transaksi like '%".$searchTerm."%' or nama_sumber_transaksi like '%".$searchTerm."%' limit 10;";
        
      $query = $this->db->query($sql);

      $hasil= $query->result_array();

      // Initialize Array with fetched data
        $data = array();
        foreach($hasil as $h){
            $data[] = array("id"=>$h['kode_sumber_transaksi'], "text"=>$h['nama_sumber_transaksi']);
        }
        return $data;

  }
	
}