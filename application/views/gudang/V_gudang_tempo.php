<meta http-equiv="refresh" content="0; url=<?php 
if($status=='tambah'){
echo base_url('gudang/tambah');
}
else
{
echo base_url('gudang/ubah/'.$id_transaksi_gudang);	
}
 ?>" />
<script>
alert('Tanggal Tempo Harus Terisi Jika Status Pemesanan TEMPO!');
</script>