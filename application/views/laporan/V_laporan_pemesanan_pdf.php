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

<?php 
$no=1;
$kelompoktglorder='';
$total=count($pemesanan);
$loop=0;
$totaldibayar=0;
$totalblmdibayar=0;
$totalall=0;
foreach($pemesanan as $c){
                            $kode_pemesanan=$c->kode_order;
                            $tgl_order=$c->tgl_order;
                            $tgl_tempo=$c->tgl_tempo;
                            $nama_status=$c->nama_status;
                            $kekurangan=$c->kekurangan;
                            $total_harga=$c->total_harga;
                            $nama_customer=$c->nama_customer;
                            $nama_pj=$c->nama_pj;
if(1==$no)
{
    $kelompoktglorder=$tgl_order;
        echo "
<thead>    
    <tr>
        <th colspan=\"8\" align=\"center\" ><strong> LAPORAN PEMESANAN</strong><br>Periode : ".date('d-M-Y',strtotime($tgldari))." s/d ".date('d-M-Y',strtotime($tglsampai))."</th>
    </tr>
    <tr>
        <th colspan=\"8\" align=\"left\" bgcolor=\"#5f9afb\"> Tanggal Order : ".date('d M Y',strtotime($tgl_order))."</th>
    </tr>
</thead>
<thead>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Customer</th>
        <th>Total Biaya</th>
        <th>Kekurangan</th>
        <th>PJ /Penerima</th>
        <th>Status</th>
        <th>Tgl Tempo</th>
    </tr>
</thead>
    ";
    $totalpesanan=0;
    $total_tempo=0;
}


if ($kelompoktglorder!=$tgl_order)
{
    echo "
<tfooter>
    <tr>
        <th colspan=\"4\" align=\"center\" bgcolor=\"#ded8d8\"> Total Pesanan : ".number_format($totalpesanan)."</th>
        <th colspan=\"4\" align=\"center\" bgcolor=\"#ded8d8\"> Belum Dibayar (Tempo) : <font color=\"red\"> ".number_format($total_tempo)."</font></th>
    </tr>
</tfooter>
<thead>
    <tr>
        <th colspan=\"8\" align=\"left\" bgcolor=\"#5f9afb\"> Tanggal Order : ".date('d M Y',strtotime($tgl_order))."</th>
    </tr>
</thead>
<thead>
    <tr>
        <th>No</th>
        <th>Kode</th>
        <th>Customer</th>
        <th>Total Biaya</th>
        <th>Kekurangan</th>
        <th>PJ /Penerima</th>
        <th>Status</th>
        <th>Tgl Tempo</th>
    </tr>
</thead>
    ";
    $kelompoktglorder=$tgl_order;
    $totalpesanan=0;
    $total_tempo=0;
    $no=1;
}
?>
<tbody>
	<tr>
		<td align="center" ><?php echo $no;?></td>
        <td><?php echo $kode_pemesanan;?></td>
        <td><?php echo $nama_customer;?></td>
        <td align="right"><?php echo $total_harga;?></td>
        <td><?php echo $kekurangan;?></td>
        <td><?php echo $nama_pj;?></td>
        <td align="center" <?php if($nama_status=="Tempo"){echo "bgcolor=\"#FF0000\"";}?>><?php echo $nama_status;?></td>
        <td align="center"><?php  if($nama_status=="Tempo"){echo date('d M Y',strtotime($tgl_tempo));}?></td>
    </tr>
</tbody>
 <?php   
 $totalpesanan=$totalpesanan+str_replace(",", "", $total_harga);
 $total_tempo=$total_tempo+str_replace(",", "",$kekurangan);
 $totaldibayar=$totaldibayar+str_replace(",", "", $total_harga);
 $totalblmdibayar=$totalblmdibayar+str_replace(",", "",$kekurangan);
 $no++;  
 $loop++;
 
 if ($loop==$total) {
    echo "
    <tfooter>
        <tr>
            <th colspan=\"4\" align=\"center\" bgcolor=\"#ded8d8\"> Total Pesanan : ".number_format($totalpesanan)."</th>
            <th colspan=\"4\" align=\"center\" bgcolor=\"#ded8d8\"> Belum Dibayar (Tempo) : <font color=\"red\"> ".number_format($total_tempo)." </font></th>
        </tr>
    </tfooter>
    <tfooter>
        <tr>
            <th colspan=\"8\" align=\"center\" > Sudah Dibayar : ".number_format($totaldibayar-$totalblmdibayar)."  |  Belum Dibayar (Tempo) : <font color=\"red\">".number_format($totalblmdibayar)."</font>  |  Total Pesanan : ".number_format($totaldibayar)."</th>
        </tr>
    </tfooter>


";
 }
}
 ?>
</table>

</body>
</html>
