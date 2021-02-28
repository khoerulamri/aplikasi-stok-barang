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
        <th colspan="8"> LAPORAN HUTANG CUSTOMER </th>
    </tr>
</thead>
<thead>
    <tr>
       <th>No</th>
        <th>Nama Customer</th>
        <th>Sudah Dibayar</th>
        <th>Belum Dibayar</th>
        <th>Total Pesanan</th>
    </tr>
</thead>
<?php 
$no=1;
foreach($hutangcustomer as $c){
                            $kode_customer=$c->kode_customer;
                            $nama_customer=$c->nama_customer;
                            $sudah_dibayar=$c->sudah_dibayar;
                            $belum_dibayar=$c->belum_dibayar;
                            $total=$c->total;
?>
<tbody>
	<tr>
		<td align="center" ><?php echo $no;?></td>
        <td><?php echo $nama_customer;?></td>
        <td align="right"><?php echo $sudah_dibayar;?></td>
        <td align="right"><?php if(0==$belum_dibayar)
        { echo "$belum_dibayar"; }
        else
        { echo "<font color=\"red\">$belum_dibayar</font>"; }?></td>        
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
