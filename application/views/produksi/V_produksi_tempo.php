<meta http-equiv="refresh" content="0; url=<?php 
if($status=='tambah'){
echo base_url('produksi/tambah');
}
else
{
echo base_url('produksi/ubah/'.$id_transaksi_produksi);	
}
 ?>" />
<script>
alert('Tanggal Tempo Harus Terisi Jika Status Pemesanan TEMPO!');
</script>