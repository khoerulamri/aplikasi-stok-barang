<?php 
class M_dashboard extends CI_Model {

		var $table = "(SELECT
  `a`.`kode_order`       AS `kode_order`,
  `a`.`tgl_order`        AS `tgl_order`,
  `a`.`kode_customer`    AS `kode_customer`,
  `a`.`penanggung_jawab` AS `penanggung_jawab`,
  `a`.`kode_status`      AS `kode_status`,
  `a`.`tgl_tempo`        AS `tgl_tempo`,
  `a`.`total_harga`      AS `total_harga`,
  `b`.`nama_customer`    AS `nama_customer`,
  `c`.`nama_pj`          AS `nama_pj`,
  `d`.`nama_status`      AS `nama_status`,
  DATE_FORMAT(`a`.`tgl_order`,_utf8'%d %M %Y') AS `tgl_order_tampil`,
  IFNULL(DATE_FORMAT(`a`.`tgl_tempo`,_utf8'%d %M %Y'),_utf8'') AS `tgl_tempo_tampil`,
  (`a`.`total_harga` - (SELECT IFNULL(SUM(`z`.`jumlah_bayar`),_utf8'0') AS `IFNULL(SUM(jumlah_bayar),\"0\")` FROM `pembayaran` `z` WHERE (`z`.`kode_order` = `a`.`kode_order`))) AS `kekurangan`,
  (TO_DAYS(`a`.`tgl_tempo`) - TO_DAYS(NOW())) AS `notif_tempo`
FROM (((`pesan` `a`
     LEFT JOIN `customer` `b`
       ON ((`a`.`kode_customer` = `b`.`kode_customer`)))
    LEFT JOIN `pj_pesanan` `c`
      ON ((`a`.`penanggung_jawab` = `c`.`kode_pj`)))
   LEFT JOIN `status` `d`
     ON ((`a`.`kode_status` = `d`.`kode_status`)))
WHERE (`a`.`kode_status` = _latin1'tempo')
ORDER BY `a`.`tgl_order`) tabel "; //nama tabel dari database
	    var $column_order = array(null,null,  'kode_order','tgl_order','tgl_order_tampil','nama_customer','nama_pj','total_harga','kekurangan','nama_status','tgl_tempo_tampil'); //field yang ada di table 
	    var $column_search = array('kode_order','tgl_order','kode_customer','penanggung_jawab','nama_status','tgl_tempo','total_harga','nama_customer','nama_pj','kekurangan');  //field yang diizin untuk pencarian 
	    var $order = array('tgl_order' => 'desc'); // default order

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	
	public function pendapatanTahunIni()
        {
        $sql = "SELECT cout(*) as jumlah_transaksi, IFNULL(SUM(jumlah_bayar),0) AS jumlah_bayar 
              FROM penjualan WHERE YEAR(tgl_transaksi)=YEAR(CURRENT_DATE);";
				
				$query = $this->db->query($sql);

				 return $query->result();
				 
		}
  
  public function customerTahunIni()
        {
        $sql = "SELECT IFNULL(COUNT(kode_customer),0) AS jumlah_customer 
FROM penjualan WHERE YEAR(tgl_transaksi)=YEAR(CURRENT_DATE);";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }


  public function barangTahunIni()
        {
        $sql = "SELECT IFNULL(SUM(qty),0) AS qty_barang ,IFNULL(COUNT(kode_barang),0) AS jumlah_barang
FROM penjualan WHERE YEAR(tgl_transaksi)=YEAR(CURRENT_DATE);";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }

  public function grafikBulanTerakhir()
        {
        $sql = "SELECT tgl_transaksi,IFNULL(SUM(jumlah_bayar),0) AS jumlah_bayar 
              FROM penjualan WHERE tgl_transaksi>=(tgl_transaksi-30)
              GROUP BY tgl_transaksi 
              ORDER BY tgl_transaksi DESC;";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }

  public function grafikBulanTerakhirGudang()
        {
        $sql = "SELECT tgl_serahkan,IFNULL(SUM(qty),0) AS jumlah_datang 
          FROM gudang WHERE tgl_serahkan>=(tgl_serahkan-30)
          GROUP BY tgl_serahkan 
          ORDER BY tgl_serahkan DESC;";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }


  public function jumlahBarangTahunIni()
        {
        $sql = "SELECT COUNT(*) AS jumlah_transaksi,IFNULL(SUM(qty),0) AS jumlah_datang 
          FROM gudang WHERE tgl_serahkan>=(tgl_serahkan-30)
          ORDER BY tgl_serahkan DESC;";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }
 
  public function jumlahPelipatTahunIni()
        {
        $sql = "SELECT COUNT(DISTINCT(kode_pelipat)) AS jumlah_pelipat
        FROM gudang WHERE tgl_serahkan>=(tgl_serahkan-30)
        ORDER BY tgl_serahkan DESC;";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }

  public function barangStokKosong()
        {
        $sql = "SELECT COUNT(kode_barang) FROM
                (
                SELECT 
                        p.kode_perusahaan,
                        pe.nama_perusahaan,
                        p.kode_barang,
                        p.nama_barang,
                        IFNULL((SELECT SUM(qty) FROM produksi xx WHERE xx.kode_barang=p.kode_barang),0) AS qty_produksi,
                        IFNULL((SELECT SUM(qty) FROM produksi xx WHERE xx.kode_barang=p.kode_barang),0)-
                        IFNULL((SELECT SUM(qty) FROM gudang g WHERE g.id_transaksi_produksi IN 
                        (SELECT DISTINCT id_transaksi_produksi FROM produksi xx WHERE xx.kode_barang=p.kode_barang)
                        ),0) AS qty_produksi_belum_kembali,
                        IFNULL((SELECT SUM(qty) FROM gudang g WHERE g.id_transaksi_produksi IN 
                        (SELECT DISTINCT id_transaksi_produksi FROM produksi xx WHERE xx.kode_barang=p.kode_barang)
                        ),0)-IFNULL((SELECT SUM(qty) FROM penjualan pj WHERE pj.kode_barang=p.kode_barang),0) AS qty_gudang_saat_ini,
                        IFNULL((SELECT SUM(qty) FROM penjualan pj WHERE pj.kode_barang=p.kode_barang),0) AS qty_penjualan
                        FROM barang p
                        LEFT JOIN perusahaan pe ON pe.kode_perusahaan=p.kode_perusahaan
                ) tabel WHERE qty_gudang_saat_ini=0";
        
        $query = $this->db->query($sql);

         return $query->result();
         
    }

  


    private function _get_datatables_query($where)
   		{
         
        $this->db->where($where);

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
 
    function get_datatables($where)
    {
        $this->_get_datatables_query($where);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($where)
    {
        $this->_get_datatables_query($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($where)
    {
    	$this->db->where($where);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
	
	
}