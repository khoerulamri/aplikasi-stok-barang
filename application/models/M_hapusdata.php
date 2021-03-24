<?php 
class M_hapusdata extends CI_Model {
	
	public function __construct()
        {
                $this->load->database();
				$this->load->library('encrypt');
        }


   	public function hapusPenjualan($dari,$sampai)
        {
                  $sql ="INSERT INTO penjualan_detail_hapus SELECT *,now() as tgl_hapus FROM penjualan_detail where id_transaksi_penjualan in (select id_transaksi_penjualan FROM penjualan where tgl_transaksi between '$dari' and '$sampai')
                  ";
                  $query = $this->db->query($sql);

                  $sql ="INSERT INTO penjualan_hapus SELECT *,now() as tgl_hapus FROM penjualan where tgl_transaksi between '$dari' and '$sampai'";
                  $query = $this->db->query($sql);
                  $sql = "delete from penjualan_detail where id_transaksi_penjualan in (select id_transaksi_penjualan FROM penjualan where tgl_transaksi between '$dari' and '$sampai')";
                  $query = $this->db->query($sql);
                  $sql = "delete from penjualan where tgl_transaksi between '$dari' and '$sampai'";
                  $query = $this->db->query($sql);
		}


    public function hapusGudang($dari,$sampai)
        {
                 $sql ="INSERT INTO gudang_hapus SELECT *,now() as tgl_hapus FROM gudang where tgl_serahkan between '$dari' and '$sampai'";
                 $query = $this->db->query($sql);
                 $sql = "delete from gudang where tgl_serahkan between '$dari' and '$sampai'";
                 $query = $this->db->query($sql);
        }

    public function hapusProduksi($dari,$sampai)
            {
                $sql ="INSERT INTO produksi_hapus SELECT *,now() as tgl_hapus FROM produksi where tgl_produksi between '$dari' and '$sampai'";
                $query = $this->db->query($sql);
                $sql = "delete from produksi where tgl_produksi between '$dari' and '$sampai'";
                $query = $this->db->query($sql);  
            }


}