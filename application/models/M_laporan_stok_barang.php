<?php 
class M_laporan_stok_barang extends CI_Model {
	
	var $table = "(SELECT 
        p.kode_perusahaan,
        pe.nama_perusahaan,
        p.kode_barang,
        concat(p.nama_barang,' - ',IFNULL(p.ukuran_barang,''),' - ',IFNULL(p.bahan_barang,'')) as nama_barang,
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
        LEFT JOIN perusahaan pe ON pe.kode_perusahaan=p.kode_perusahaan) tabel"; //nama tabel dari database
    var $column_order = array(null,null,  'nama_perusahaan','nama_barang','qty_produksi','qty_produksi_belum_kembali','qty_gudang_saat_ini','qty_penjualan'); //field yang ada di table user
    var $column_search = array('nama_perusahaan','nama_barang','qty_produksi','qty_produksi_belum_kembali','qty_gudang_saat_ini','qty_penjualan');  //field yang diizin untuk pencarian 
    var $order = array('nama_perusahaan' => 'asc'); // default order 

	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }
	

   	public function getSumberTransaksiAll()
        {
                $sql = "SELECT 
                        p.kode_perusahaan,
                        pe.nama_perusahaan,
                        p.kode_barang,
                        concat(p.nama_barang,' - ',IFNULL(p.ukuran_barang,''),' - ',IFNULL(p.bahan_barang,'')) as nama_barang,
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
                        LEFT JOIN perusahaan pe ON pe.kode_perusahaan=p.kode_perusahaan";
				
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