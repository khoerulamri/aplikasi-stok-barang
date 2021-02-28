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
alert('Kode Produksi Sudah Digunakan!');
</script>