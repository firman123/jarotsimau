<?php
	include("koneksi.php");
	$no_uji=$_GET['no_uji'];
	$sql="select a.*,b.*,c.lulus,d.ptgs_prauji,d.ptgs_smoke,d.ptgs_pitlift,d.ptgs_lampu,d.ptgs_break,d.ptgs_speedo from tbl_hasil_uji a left join v_kendaraan b on a.id_kendaraan=b.id_kendaraan 
	left join v_print_hasil c on a.id_hasil_uji=c.id_hasil_uji left join tbl_proses d on (a.id_daftar=d.id_daftar)
	where b.no_uji='$no_uji' order by a.id_hasil_uji desc limit 1";
	$query=pg_query($konek,$sql);
	$line_qa = pg_fetch_array($query);
	$id_kendaraan=$line_qa['no_uji'];
	$id_kend=$line_qa['id_kendaraan'];
	$skrg=date('Y-m-d');
	$expired=$line_qa['tgl_mati_uji'];
	//echo $skrg."<br>".$expired;
        
        $sql2 = "select a.*, b.* from tbl_trayek a JOIN tbl_kendaraan b ON a.id_trayek=b.id_trayek WHERE b.no_uji='$no_uji'";
        $query2 = pg_query($konek, $sql2);
        $data_trayek = pg_fetch_array($query2);
        
        $sql2 = "select * from tbl_kartu_pengawasan where id_kendaraan='$no_uji' LIMIT 1";
        $query2 = pg_query($konek, $sql2);
        $data_masa_kp = pg_fetch_array($query2);
?>
<style type="text/css">
<!--
.style3 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 18px;
}
.style6 {font-size: 24px}
.style7 {
	color: #666666;
	font-size: 14px;
	font-weight: bold;
}
.style11 {font-weight: bold}
.style12 {
	color: #FFFFFF;
	font-weight: bold;
}
body {
	background-image: url();
	background-repeat: no-repeat;
}
-->
</style>
<link rel="stylesheet" href="popup.css">
<body>
<div id="InfoPKB" style="padding-top:5px">
   <div class="style6" style="height:30px"><span style="position: relative; left:10px; top:5px; color:#009; font-weight:bold">INFORMASI HASIL SCAN STIKER</span></div>
   <div>
       <!-- DATA INDENTITAS KENDARAAN -->
      <div id="dtkendaraan" align="left" style="padding:10px;">
         <div></div>
         <div>
            <table width="100%" style="font-size:12px">
                <tr>
                  <td colspan="6" bgcolor="#66CCFF"><div align="left"><span class="style3">-- IDENTITAS KENDARAAN</span></div></td>
                </tr>
                <?php 

if(empty($hasil['foto'])) {
?>
<img src="http://integratesystem.id/simau/upload/nopoto.jpg" style="width: 200px;"/>
<?php
}

if(!empty($hasil['foto'])) { ?>
<img src="http://integratesystem.id/simau/upload/kartu_pengawas/<?php echo $hasil['foto']; ?>" style="width: 200px;"/>

<?php } ?>
</td>
                <tr>
                                  <td width="30%">Foto </td>
                                  <td width="5%">:  </td>
                                  <td width="65%">
                                      <img src="<?php echo base_url(); ?>aset/img/logo_balikpapan.png" />
                                      <img src="<?php echo getcwd(); ?>/upload/kartu_pengawas/<?php echo $hasil['foto']; ?>" />
                                      <img src="<?php echo $poto2; ?>" width="50%" height="50%" style="width: 300px;" />
</td>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width="15%">NO. UJI</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['no_uji']; ?></td>
				  
                  <td width="18%">DA ORANG</td>
                  <td width="1%">:</td>
                  <td width="35%"><?php echo $line_qa['karoseri_duduk']; ?> Orang</td>
		</tr>
                <tr>
                  <td width="15%">NO. KENDARAAN</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['no_kendaraan']; ?></td>
                  <td width="18%">DA BARANG</td>
                  <td width="1%">:</td>
                  <td width="35%"><?php echo $line_qa['kembarang']; ?> Kg</td>
                </tr>
                <tr>
                  <td width="15%">NAMA PEMILIK</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['nama_pemilik']; ?></td>
                  <td width="18%">J B I</td>
                  <td width="1%">:</td>
                  <td width="35%"><?php echo $line_qa['jbi']; ?> Kg</td>
                </tr>
                <tr>
                  <td width="15%">ALAMAT</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['alamat']; ?></td>
                  <td width="18%">M S T</td>
                  <td width="1%">:</td>
                  <td width="35%"><?php echo $line_qa['mst']; ?> Kg</td>
                </tr>
                <tr>
                  <td width="15%">NOMOR RANGKA</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['no_chasis']; ?></td>
                  <td width="18%">BERLAKU UJI</td>
                  <td width="1%">:</td>
                  <td align="center"  width="35%"> <STRONG>
				  <?php $tgl_mati_uji=substr($line_qa['tgl_mati_uji'],8,2)."-".substr($line_qa['tgl_mati_uji'],5,2)."-".substr($line_qa['tgl_mati_uji'],0,4); ?>
                  <label style="font-size:27px; color:#000080" id="berlakuuji"> <?PHP echo $tgl_mati_uji; ?></label></STRONG></td>
                </tr>
                
                 <tr>
                  <td width="15%">NOMOR MESIN</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['no_mesin']; ?></td>
                  <td width="18%">BERLAKU KP</td>
                  <td width="1%">:</td>
                  <td align="center"  width="35%"> <STRONG>
				  <?php 
if($data_masa_kp['create_date']!=null) {
	$tahun = (substr($data_masa_kp['create_date'],0,4) + 5);
}
$tgl_mati_kp=substr($data_masa_kp['create_date'],8,2)."-".substr($data_masa_kp['create_date'],5,2)."-".$tahun; ?>
                  <label style="font-size:27px; color:#000080" id="berlakuuji"> <?PHP echo $tgl_mati_kp; ?></label></STRONG></td>
                </tr>
                
                <tr>
                            <td width="15%">NOMOR TRAYEK</td>
                            <td width="1%">:</td>
                            <td width="30%"><h3><?php echo $data_trayek['kd_trayek']; ?></h3></td>
                            <td width="18%">LINTASAN</td>
                            <td width="1%">:</td>
                            <td width="35%"><?php echo $data_trayek['lintasan_trayek']; ?></td>
                        </tr>
                        
                        <tr>
                            <td width="15%">NAMA PENGEMUDI</td>
                            <td width="1%"></td>
                            <td width="30%">

<?php
include("koneksi.php");
$no_uji = $_GET['no_uji'];
$sql = "select * from tbl_kartu_pengawasan where id_kendaraan='$no_uji'";
$query = pg_query($konek, $sql);
while($hasil = pg_fetch_array($query))
{
    echo $hasil['nama_pengemudi']; 
    echo '<br>';
}

//echo $skrg."<br>".$expired;
?>

                            </td>
                            <td width="18%"> <MARQUEE loop="3" align="center" direction="left" height="20" scrollamount="2" width="100%"> <strong> Ujilah kendaraan sebelum masa berlaku uji habis </strong></marquee> </td>
                        </tr>
<!--                <tr>
                  <td width="15%">NOMOR MESIN</td>
                  <td width="1%">:</td>
                  <td width="30%"><?php echo $line_qa['no_mesin']; ?></td>
		  <td width="18%"> <MARQUEE loop="3" align="center" direction="left" height="20" scrollamount="2" width="100%"> <strong> Ujilah kendaraan sebelum masa berlaku uji habis </strong></marquee> </td>
                </tr>-->
            </table>
            <table width="100%" border="0">
              <tr>
                <td colspan="3">
				<?php if($skrg >= $expired) { ?>
					<div id="close">
						<div class="container-popup">
							<form action="#" method="post" class="popup-form">
								<img src="expired.png" alt="" width="100%">
							</form>
							<a class="close" href="#close">close</a>
						</div>
					</div>
				<?php } ?>
				</td>
              </tr>
              <tr>
                <td width="49%"><table width="100%" border="0">
                  <tr>
                    <td colspan="2" bgcolor="#66CCFF"><span class="style3"><strong>-- HASIL PENGUJIAN </strong></span></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td width="51%" bgcolor="#FFFFFF"><div align="center" class="style7">PRAUJI</div></td>
                    <td width="49%" bgcolor="#FFFFFF"><div align="center" class="style7">HASIL UJI AXLE PLAY</div></td>
                  </tr>
				  <?php
					if($line_qa['lulus_prauji'] == "t") { $prauji_hasil="LULUS"; } else { $prauji_hasil="TIDAK LULUS"; }
					if($line_qa['lulus_pitlift'] == "t") { $pitlift_hasil="LULUS"; } else { $pitlift_hasil="TIDAK LULUS"; }
				  ?>
                  <tr>
                    <td><div align="center"><?php echo $prauji_hasil; ?></div></td>
                    <td><div align="center"><?php echo $pitlift_hasil; ?></div></td>
                  </tr>
                  <tr>
                    <td><div align="center">(<?php echo $line_qa['ptgs_prauji']; ?>)</div></td>
                    <td><div align="center">(<?php echo $line_qa['ptgs_pitlift']; ?>)</div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="left" class="style7">&gt; HASIL UJI EMISI GAS BUANG</div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_smoke']; ?></td>
                  </tr>
                  <tr>
                    <td>Opacity</td>
                    <td><?php echo " : ".$line_qa['ems_diesel']." %"; ?></td>
                  </tr>
                  <tr>
                    <td>Kadar HC</td>
                    <td><?php echo " : ".$line_qa['ems_mesin_hc']; ?></td>
                  </tr>
                  <tr>
                    <td>Kadar CO</td>
                    <td><?php echo " : ".$line_qa['ems_mesin_co']. " % "; ?></td>
                  </tr>
				  <tr>
                    <td>Opacity</td>
                    <td><?php echo " : ".$line_qa['ems_diesel']. " % "; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="left"><span class="style7"><strong>&gt; HASIL UJI LAMPU</strong></span></div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_lampu']; ?></td>
                  </tr>
                  <tr>
                    <td>Kuat Pancar Lampu Kanan</td>
                    <td><?php echo " : ".$line_qa['ktlamp_kanan']. " cd "; ?></td>
                  </tr>
                  <tr>
                    <td>Kuat Pancar Lampu K i r i</td>
                    <td><?php echo " : ".$line_qa['ktlamp_kiri']. " cd "; ?></td>
                  </tr>
                  <tr>
                    <td>Deviasi  Kanan</td>
                    <td><?php echo " : ".$line_qa['dev_kanan']. " derajat "; ?></td>
                  </tr>
                  <tr>
                    <td>Deviasi  K i r i</td>
                    <td><?php echo " : ".$line_qa['dev_kiri']. " derajat "; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  
				  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="left"><span class="style7"><strong>&gt; HASIL UJI SIDE SLIP</strong></span></div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_break']; ?></td>
                  </tr>
                  <tr>
                    <td>Hasil Uji</td>
                    <td><?php if($line_qa['kincuproda'] == "t") { $sideslip_hasil="LULUS"; } else { $sideslip_hasil="TIDAK LULUS"; }
					$sideslip_hasilp=$line_qa['axle_load']." mm/m"; echo " : ".$sideslip_hasil. " / ".$sideslip_hasilp; ?></td>
                  </tr>
				  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  
				  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="left"><span class="style7"><strong>&gt; HASIL UJI SPEEDOMETER</strong></span></div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_speedo']; ?></td>
                  </tr>
                  <tr>
                    <td>Hasil Uji</td>
                    <td><?php if($line_qa['spedmeter'] == "t") { $spedometer_hasil="LULUS"; } else { $spedometer_hasil="TIDAK LULUS"; }
					$spedometer_hasilp=$line_qa['spedo_load']." km/jam"; echo " : ".$spedometer_hasil. " / ".$spedometer_hasilp; ?></td>
                  </tr>
				  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  
				  <tr>
                    <td colspan="2" bgcolor="#FFFFFF"><div align="left"><span class="style7"><strong>&gt; HASIL UJI SUARA KLAKSON</strong></span></div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_speedo']; ?></td>
                  </tr>
                  <tr>
                    <td>Hasil Uji</td>
                    <td><?php if($line_qa['spedmeter'] == "t") { $klakson_hasil="LULUS"; } else { $klakson_hasil="TIDAK LULUS"; }
					$klakson_hasilp=$line_qa['sound_load']." Db"; echo " : ".$klakson_hasil. " / ".$klakson_hasilp; ?></td>
                  </tr>
				  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  
                  <tr>
                    <td colspan="2" ><div align="left" class="style7">
                      <div align="left">&gt; HASIL UJI REM</div>
                    </div></td>
                  </tr>
                  <tr>
                    <td>Penguji</td>
                    <td><?php echo " : ".$line_qa['ptgs_break']; ?></td>
                  </tr>
                  <tr>
                    <td>Gaya Rem Sumbu 1</td>
                    <td><?php echo " : ".$line_qa['selrem_sb1']. " kg "; ?></td>
                  </tr>
                  <tr>
                    <td>Gaya Rem Sumbu 2</td>
                    <td><?php echo " : ".$line_qa['selrem_sb2']. " kg "; ?></td>
                  </tr>
                  <tr>
                    <td>Gaya Rem Sumbu 3 </td>
                    <td><?php echo " : ".$line_qa['selrem_sb3']. " kg "; ?></td>
                  </tr>
                  <tr>
                    <td>Gaya Rem Sumbu 4 </td>
                    <td><?php echo " : ".$line_qa['selrem_sb4']. " kg "; ?></td>
                  </tr>
                  <tr>
                    <td>Selisih Gaya Rem Sumbu 1</td>
                    <td><?php echo " : ".$line_qa['selgaya']. " % "; ?></td>
                  </tr>
                  <tr>
                    <td>Selisih Gaya Rem Sumbu 2 </td>
                    <td><?php echo " : ".$line_qa['selkirikanan']. " % "; ?></td>
                  </tr>
                  <tr>
                    <td>Selisih Gaya Rem Sumbu 3 </td>
                    <td><?php echo " : ".$line_qa['selgaya3']. " % "; ?></td>
                  </tr>
                  <tr>
                    <td>Selisih Gaya Rem Sumbu 4 </td>
                    <td><?php echo " : ".$line_qa['selgaya4']. " % "; ?></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                      <td ><div align="center" class="style7"><strong>DATA PENGEMUDI</strong></div></td>
                    <td ><div align="center" class="style7"><strong></strong></div></td>
                  </tr>
                  <tr>
                      <?php
                      include("koneksi.php");
                        $no_uji = $_GET['no_uji'];
                        $sql = "select * from tbl_kartu_pengawasan where id_kendaraan='$no_uji'";
                        $query = pg_query($konek, $sql);
                        while($hasil = pg_fetch_array($query))
                        {
                        


                      ?>
                      <td>
                          <table width="100%" border="0">
                              <tr>
                                  <td width="30%">Nama </td>
                                  <td width="5%">:  </td>
                                  <td width="65%"><?php echo $hasil['nama_pengemudi']; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="30%">No Identitas </td>
                                  <td width="5%">:  </td>
                                  <td width="65%"><?php echo $hasil['id_kp']; ?></td>
                              </tr>
                              
                              <tr>
                                  <td width="30%">Foto </td>
                                  <td width="5%">:  </td>
                                  <td width="65%"><?php  base_url() . "upload/kartu_pengawas/" . $hasil['foto'] ?></td>
                              </tr>
                          </table>
                      </td>
                      
                      <?php 
                        }
                      ?>
                  </tr>
                  <tr>
                    <td ><div align="center" class="style7"><strong>HASIL</strong></div></td>
                    <td ><div align="center" class="style7"><strong>PENGESAHAN HASIL UJI</strong></div></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
				  <?php
					if($line_qa['lulus'] == "t") { $data_hasil="LULUS"; } else { $data_hasil="TIDAK LULUS"; }
				  ?>
                  <tr>
                    <td><div align="center"><?php echo $data_hasil; ?></div></td>
                    <td><div align="center"><?php echo $line_qa['nm_penguji']; ?></div></td>
                  </tr>
                </table></td>
                <td width="6%" align="left" valign="top">&nbsp;</td>
                <td width="45%" align="left" valign="top"><table width="100%" border="0">
					<?php
					$query2 = "select id_hasil_uji from tbl_hasil_uji where id_kendaraan=$id_kend order by id_hasil_uji asc limit 1";
					//echo $query2;
					$result2 = pg_query($konek,$query2);
					$row2=pg_fetch_array($result2);
					if($row2 == "") {$poto2="nopoto.jpg";}else{$poto2='http://36.67.16.161/cis/capture/'.$line_qa['id_hasil_uji'].'.jpg';}
					?>
                  <tr>
                    <td bgcolor="#66CCFF"><span class="style3"><strong>-- FOTO PEMERIKSAAN </strong></span></td>
                  </tr>
                  <tr>
                    <td><div align="center"><img src="<?php echo $poto2; ?>" width="50%" height="50%" /></div></td>
                  </tr>
                  <tr>
                    <td><table width="101%" border="0" align="center" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
                      <tr>
                        <td colspan="2" bgcolor="#66CCFF"><span class="style3">-- LAPORAN WASDAL </span></td>
                      </tr>
					  <?php
						//catatan penguji
						if($id_kendaraan != "")
						{
							$no=1;
							$data_wasdal=pg_query($konek,"select id_data,id_kendaraan,foto,post_by,catatan,last_update from tb_note_kendaraan where 
							id_kendaraan='$id_kendaraan' order by id_data desc");
							$line_wasdal=pg_fetch_array($data_wasdal);
							if($line_wasdal == "")
							{
								$img_wasdal="nopoto.jpg";
							}
							else{
								$img_wasdal="http://36.67.16.161/wasdal/attachment/medium_".$line_wasdal['foto'];
							}
							$tgl=$line_wasdal['last_update'];
							$tgledit=substr($tgl,8,2).'-'.substr($tgl,5,2).'-'.substr($tgl,0,4);
						}
						else{
							$img_wasdal="nopoto.jpg";
							$tgledit="";
						}
					  ?>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
                            <tr>
                              <td><div align="center"><img src="<?php echo $img_wasdal; ?>" width="50%" height="50%" /></div></td>
                            </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td width="23%" valign="top"><span class="style11">Pelanggaran</span></td>
                        <td width="77%" valign="top"><span class="style11">: <?php echo $line_wasdal['catatan']; ?></span></td>
                      </tr>
                      <tr>
                        <td><span class="style11">Tanggal</span></td>
                        <td><span class="style11">: <?php echo $tgledit; ?></span></td>
                      </tr>
                      <tr>
                        <td><span class="style11">Pelapor</span></td>
                        <td><span class="style11">: <?php echo $line_wasdal['post_by']; ?></span></td>
                      </tr>
                      <br />
                      <tr>
                        <td colspan="2"><span class="style11"><a href='infopkb_all.php?iddata=<?php echo $id_kendaraan; ?>' target='_blank'>Lihat Riwayat Data</a></span><span class="style11"></span></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table>
        </div>
      </div>  
      <!-- END DATA INDENTITAS KENDARAAN -->
      <div>
      <!-- DATA HASIL UJI -->
      <!-- END DATA HASIL UJI -->
</div>
   </div>
</div>
</body>