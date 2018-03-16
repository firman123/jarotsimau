<?php
if (!empty($kendaraan)) {
    if (strlen(trim($kendaraan['kp_ijin_trayek'])) == 0) {
        echo "<script>alert('Kendaraan belum diinputkan di menu ijin trayek!');window.location='" . site_url('ijin_isidentil/input') . "';</script>";
    }
} else {
    echo "<script>alert('Kendaraan belum terdaftar!');window.location='" . site_url('ijin_isidentil/input') . "';</script>";
}
?>

<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Daftar Ijin Isidentil</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
            <form action="<?php echo site_url("ijin_isidentil/cari_kendaraan"); ?>" method="post" accept-charset="utf-8">
                    
                <tr><td width="20%">No. Uji</td><td><b><input type="text" name="no_kendaraan" required id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td><td><button type=submit class="btn btn-danger" id="search_kendaraan_button"><i class="icon-search icon-white"> </i> Cari</button></td></tr>		
            </form>
            <form action="<?php echo site_url("ijin_isidentil/act_add"); ?>" method="post" accept-charset="utf-8">
                <input type="hidden" name="id_kendaraan" value="<?php echo $kendaraan['id_kendaraan']?>" />
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo $kendaraan['kp_ijin_trayek']; ?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Nomor Kendaraan</td><td><b><input type="text" name="no_kendaraan" required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Kota Tujuan</td><td><b><input type="text" name="kota" required id="masa_berlaku" style="width: 300px" class="form-control" /></td></tr>
                <tr><td width="20%">No. Trayek</td><td><b><input type="text" required value="<?php echo $kendaraan['kd_trayek']; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['alamat']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
                 <tr><td width="20%">Masa Berlaku</td><td><b><input type="text" name="masa_berlaku" required id="tanggal_berlaku" style="width: 300px" class="form-control"/></td></tr>	  
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success" <?php if (empty($kendaraan['no_uji'])) { ?> disabled="" <?php } ?>>Simpan</button>
                        <a href="<?php echo base_url(); ?>index.php/ijin_isidentil/index" class="btn btn-primary">Kembali</a>
                    </td></tr>
        </table>
    </div>

</div>

</form>
