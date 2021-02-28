<meta http-equiv="refresh" content="0; url=<?php 
if($status=='tambah'){
echo base_url('penjualan/tambah');
}
else
{
echo base_url('penjualan/ubah/'.$id_transaksi_penjualan);	
}
 ?>" />
<script>
alert('Tanggal Tempo Harus Terisi Jika Status Pemesanan TEMPO!');
</script>