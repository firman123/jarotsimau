<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Daftar Peremajaan Kendaraan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
            <form action="<?php echo site_url("peremajaan/cari_kendaraan"); ?>" method="post" accept-charset="utf-8">

                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="no_kendaraan" required id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td><td><button type=submit class="btn btn-danger" id="search_kendaraan_button"><i class="icon-search icon-white"> </i> Cari</button></td></tr>		
            </form>
            <form action="<?php echo site_url("peremajaan/act_add"); ?>" method="post" accept-charset="utf-8">
                 
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo $kendaraan['kp_ijin_trayek'];?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Nomor Kendaraan Lama</td><td><b><input type="text" name="no_kendaraan_lama" required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Nomor Kendaraan Baru</td><td><b><input type="text" name="no_kendaraan_baru" required id="masa_berlaku" style="width: 300px" class="form-control" /></td></tr>	
                <input type="hidden" name="id_kendaraan" value="<?php echo $kendaraan['kendaraan_id'];  ?>" />
                <tr><td width="20%">No. Trayek</td><td><b><input type="text" required value="<?php echo $kendaraan['kd_trayek']; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['alamat']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
               
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success" <?php if(empty($kendaraan['no_uji'])) {?> disabled="" <?php }?>>Simpan</button>
                        <a href="<?php echo base_url(); ?>index.php/peremajaan/index" class="btn btn-primary">Kembali</a>
                    </td></tr>
        </table>
    </div>

    <div class="col-lg-6">	
        <table  class="table-form">
            <tr><td colspan="2"><b>Catatan Pelanggaran</td></tr>
            <tr><td width="20%">Catatan</td><td><b><input type="text" name="catatan" id="catatan" required value="<?php echo $kendaraan['catatan']; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
            <tr><td width="20%">Pelapor</td><td><b><input type="text" name="last_update" id="last_update" required value="<?php echo $kendaraan['post_by']; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
            <tr><td width="20%">Tanggal</td><td><b><input type="text" name="post_by" id="post_by" required value="<?php echo $kendaraan['last_update']; ?>" style="width: 300px" class="form-control" readonly></b></td></tr>
            <tr><td width="20%">Gambar</td><td><img src="<?php if (empty($kendaraan['foto'])) {
    echo base_url(); ?>upload/nopoto.jpg<?php } else {
    echo 'http://integratesystem.id/wasdal/attachment/medium_' . $kendaraan['foto'];
} ?>" style="width: 250px;" /></td></tr>
        </table>	
    </div>

</div>

</form>
