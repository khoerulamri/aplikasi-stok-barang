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
$kelompoktglbayar='';
$total=count($pembayaran);
$loop=0;
$totalcash=0;
$totaltransfer=0;
$totalall=0;
foreach($pembayaran as $c){
                            $tgl_bayar=$c->tgl_bayar;
                            $pesanan=$c->pesanan;
                            $nama_cara_bayar=$c->nama_cara_bayar;
                            $jumlah_bayar=$c->jumlah_bayar;
                            $pengirim=$c->pengirim;
                            $rekening=$c->rekening;
                            $penerima=$c->nama_penerima;

if(1==$no)
{
    $kelompoktglbayar=$tgl_bayar;
        echo "
<thead>
    <tr>
        <th colspan=\"7\" align=\"center\" ><strong> LAPORAN PEMBAYARAN</strong><br>Periode : ".date('d-M-Y',strtotime($tgldari))." s/d ".date('d-M-Y',strtotime($tglsampai))."</th>
    </tr>
    <tr>
        <th colspan=\"7\" align=\"left\" bgcolor=\"#5f9afb\"> Tanggal Order : ".date('d M Y',strtotime($tgl_bayar))."</th>
    </tr>
</thead>
<thead>
    <tr>
        <th>No</th>
        <th>Pesanan</th>
        <th>Jumlah Bayar</th>
        <th>Cara Bayar</th>
        <th>Rekening</th>
        <th>Pengirim</th>
        <th>Penerima</th>
    </tr>
</thead>
    ";
    $totalpembayaran=0;
}


if ($kelompoktglbayar!=$tgl_bayar)
{
    echo "
<tfooter>
    <tr>
        <th colspan=\"7\" align=\"right\" bgcolor=\"#ded8d8\"> Total Pesanan : ".number_format($totalpembayaran)."</th>
    </tr>
</tfooter>
<thead>
    <tr>
        <th colspan=\"7\" align=\"left\" bgcolor=\"#5f9afb\"> Tanggal Pembayaran : ".date('d M Y',strtotime($tgl_bayar))."</th>
    </tr>
</thead>
<thead>
    <tr>
       <th>No</th>
        <th>Pesanan</th>
        <th>Jumlah Bayar</th>
        <th>Cara Bayar</th>
        <th>Rekening</th>
        <th>Pengirim</th>
        <th>Penerima</th>
    </tr>
</thead>
    ";
    $kelompoktglbayar=$tgl_bayar;
    $totalpembayaran=0;
    $no=1;
}
?>
<tbody>
	<tr>
		<td align="center" ><?php echo $no;?></td>
        <td><?php echo $pesanan;?></td>
        <td align="right"><?php echo $jumlah_bayar;?></td>
        <td align="center"><?php echo $nama_cara_bayar;?></td>
        <td><?php echo $rekening;?></td>
        <td><?php echo $pengirim;?></td>
        <td><?php echo $penerima;?></td>        
    </tr>
</tbody>
 <?php   
 $totalpembayaran=$totalpembayaran+str_replace(",", "", $jumlah_bayar);
 if("Cash"==$nama_cara_bayar)
    {
        $totalcash=$totalcash+str_replace(",", "", $jumlah_bayar);
    }
    else
    {
        $totaltransfer=$totaltransfer+str_replace(",", "", $jumlah_bayar);
    }

 
 $no++;  
 $loop++;
 
 if ($loop==$total) {
    echo "
<tfooter>
    <tr>
        <th colspan=\"7\" align=\"right\" bgcolor=\"#ded8d8\"> Total Pesanan : ".number_format($totalpembayaran)."</th>
    </tr>
</tfooter>
<tfooter>
    <tr>
        <th colspan=\"8\" align=\"center\" > Cash : ".number_format($totalcash)."  |  Transfer : ".number_format($totaltransfer)."  |  Total : ".number_format($totalcash+$totaltransfer)."</th>
    </tr>
</tfooter>
    ";
 }
}
 ?>
</table>

</body>
</html>
