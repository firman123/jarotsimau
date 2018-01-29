

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $no_kendaraan = $data_kendaraan['no_kendaraan'];
    $nama_pengemudi = $datpil['nama_pengemudi'];
    $no_ktp = $datpil['no_ktp'];
    $no_ktp_lama = $datpil['no_ktp'];
    $id_kp = $datpil['id_kp'];
    $id = $datpil['id'];
    $nama_pemilik = $data_kendaraan['nama_pemilik'];
    $masa_berlaku = $data_kendaraan['masa_berlaku'];
    $masa_berlaku_ijin_trayek = $data_kendaraan['masa_berlaku_ijin'];
    $no_trayek = $data_kendaraan['id_trayek'];
    $nama_perusahaan = $data_kendaraan['nama_perusahaan'];
    $alamat_pemilik = $data_kendaraan['alamat_pemilik'];
    $alamat_pengemudi = $datpil['alamat'];
    $catatan = $data_kendaraan['catatan'];
    $last_update = $data_kendaraan['last_update'];
    $post_by = $data_kendaraan['post_by'];
    $no_uji = $datpil['id_kendaraan'];
    $no_kp = $datpil['id_kp'];
} else {
    $act = "act_add";
    $no_kendaraan = "";
    $nama_pengemudi = "";
    $no_ktp = "";
    $no_ktp_lama = "";
    $masa_berlaku = "";
    $masa_berlaku_ijin_trayek = "";
    $no_trayek = "";
    $nama_perusahaan ="";
    $nama_pemilik = "";
    $alamat_pemilik = "";
    $alamat_pengemudi = "";
    $id = "";
    $catatan = "";
    $last_update = "";
    $post_by = "";
    $no_uji = "";
    $no_kp = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Kartu Pengawasan <?php echo $label; ?></span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

 <?php echo $this->session->flashdata("message"); ?>
<form action="<?php echo site_url("kartu_pengawasan/" .$path . "/" . $act); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $id; ?>">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <input type="hidden" name="no_uji" value="<?php echo $no_uji; ?>" id="no_uji" />
                <input type="hidden" name="no_ktp_lama" value="<?php echo $no_ktp_lama; ?>" id="no_uji" />
                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="no_kendaraan"  required value="<?php echo $no_kendaraan; ?>" style="width: 400px" id="no_kendaraan" class="form-control" readonly=""/></b></td></tr>	
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo $no_kp; ?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>
                	
                <tr><td width="20%">Masa Belaku KP</td><td><b><input type="text" name="masa_berlaku" required value="<?php echo $masa_berlaku; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">No. Trayek</td><td><b><input type="text" name="no_trayek" required value="<?php echo $no_trayek; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $nama_pemilik; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $alamat_pemilik; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $nama_perusahaan; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Masa Berlaku Ijin Trayek</td><td><b><input type="text" name="masa_berlaku_ijin_trayek" required value="<?php echo $masa_berlaku_ijin_trayek; ?>" style="width: 300px" id="masa_berlaku_ijin_trayek" class="form-control" readonly /></td></tr>	

                            <tr><td colspan="2">
                                    <a href="<?php echo base_URL(); ?>index.php/kartu_pengawasan/<?php echo $path; ?>" class="btn btn-primary">Kembali</a>
                                </td></tr>
            </table>
        </div>

        <div class="col-lg-6">	
            <table  class="table-form">
                <tr><td>Nama Pengemudi</td><td><b><input type="text" name="nama_pengemudi" required value="<?php echo $nama_pengemudi; ?>" style="width: 300px" class="form-control" readonly=""></b></td></tr>
                <tr><td width="20%">Nomor KTP</td><td><b><input type="text" name="no_ktp" id="kode_surat" required value="<?php echo $no_ktp; ?>" style="width: 300px" class="form-control" readonly=""></b></td></tr>
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat" required value="<?php echo $alamat_pengemudi; ?>" style="width: 300px" class="form-control" readonly=""></b></td></tr>
                <tr><td width="20%">Foto</td><td><b> <img src="<?php echo base_url()?>upload/kartu_pengawas/<?php echo $datpil['foto']; ?>" style="height: 400px;"></b></td></tr>
                <tr><td colspan="2"><hr style="border-width: 1px; border-style: inset; display: block; margin-bottom: -10px;"></td></tr>
                <tr><td colspan="2"><b>Catatan Pelanggaran</td></tr>
                <tr><td width="20%">Catatan</td><td><b><input type="text" name="catatan" id="catatan" required value="<?php echo $catatan; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
                <tr><td width="20%">Pelapor</td><td><b><input type="text" name="last_update" id="last_update" required value="<?php echo $last_update; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
                <tr><td width="20%">Tanggal</td><td><b><input type="text" name="post_by" id="post_by" required value="<?php echo $post_by; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
            </table>	
        </div>

    </div>

</form>
