<!DOCTYPE html>
<html>
<head>
<style>
#laporan {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#laporan td, #laporan th {
  border: 1px solid #ddd;
  padding: 5px;
}
#laporan th {
  padding-top: 5px;
  padding-bottom: 5px;
}
</style>
</head>
<body>

<table width="100%" id="laporan">
<thead>
    <tr>
        <th colspan="8" align="left">
        <h3><?php 
        foreach ($nama_instansi as $a) {
            echo $a->nilai;
        }
        ?></h3>
        <?php 
        foreach ($alamat as $a) {
            echo $a->nilai;
        }
        ?><?php 
        foreach ($telepon as $a) {
            echo " - ".$a->nilai;
        }
        ?><?php 
        foreach ($website as $a) {
            echo " - ".$a->nilai;
        }
        ?>      
        <br><?php 
        foreach ($slogan as $a) {
            echo $a->nilai;
        }
        ?>
              
        </th>
    </tr>
</thead>
<thead>
    <tr>
        <th colspan="8"> LAPORAN KINERJA PENANGGUNG JAWAB<br>Periode : <?php echo date('d-M-Y',strtotime($tgldari));?> s/d <?php echo date('d-M-Y',strtotime($tglsampai));?></th>
    </tr>
</thead>
<thead>
    <tr>
       <th>No</th>
        <th>Nama Penanggung Jawab</th>
        <th>Pesanan Lunas</th>
        <th>Total Biaya</th>
        <th>Pesanan Tempo</th>
        <th>Sudah dibayar</th>
        <th>Belum dibayar</th>
        <th>Total Biaya</th>
    </tr>
</thead>
<?php 
$no=1;
foreach($kinerjaPJ as $c){
                            $kode_pj=$c->kode_pj;
                            $nama_pj=$c->nama_pj;
                            $pesanan_lunas=$c->pesanan_lunas;
                            $total_pesanan=$c->total_pesanan;
                            $pesanan_tempo=$c->pesanan_tempo;
                            $sudah_dibayar=$c->sudah_dibayar;
                            $belum_dibayar=$c->belum_dibayar;
                            $total=$c->total;
?>
<tbody>
	<tr>
		<td align="center" ><?php echo $no;?></td>
        <td><?php echo $nama_pj;?></td>
        <td align="right"><?php echo $pesanan_lunas;?> Order</td>
        <td align="right"><?php echo $total_pesanan;?></td>
        <td align="right"><?php echo $pesanan_tempo;?> Order</td>
        <td align="right"><?php echo $sudah_dibayar;?></td>
        <td align="right"><?php echo $belum_dibayar;?></td>        
        <td align="right"><?php echo $total;?></td>        
    </tr>
</tbody>
 <?php   
 $no++;  
}
 ?>
</table>

</body>
</html>
