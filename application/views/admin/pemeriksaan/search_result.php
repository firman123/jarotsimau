<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Daftar Uji Kendaraan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>


<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
            <form action="<?php echo site_url("pemeriksaan/cari_kendaraan/$path"); ?>" method="post" accept-charset="utf-8">

                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="no_kendaraan" required id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td><td><button type=submit class="btn btn-danger" id="search_kendaraan_button"><i class="icon-search icon-white"> </i> Cari</button></td></tr>		
            </form>
            <form action="<?php echo site_url("pemeriksaan/act_add"); ?>" method="post" accept-charset="utf-8">
                 <input type="hidden" name="jenis" value="<?php if($path=='trayek') echo 'Trayek'; else echo 'Operasi'; ?>" />
                 <input type="hidden" name="no_uji" value="<?php echo $kendaraan['no_uji']; ?>" id="no_uji" />
                <input type="hidden" name="no_ktp_lama" value="<?php echo $kendaraan['no_ktp']; ?>" id="no_uji" />
                <input type="hidden" name="no_kendaraan"  required value="<?php echo $kendaraan['no_kendaraan']; ?>" style="width: 400px" id="no_kendaraan" class="form-control"  />
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php if($path=='trayek') echo $kendaraan['kp_ijin_trayek']; else echo $kendaraan['kp_ijin_operasi'];?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Masa Belaku KP</td><td><b><input type="text" name="masa_berlaku" required value="<?php echo $tanggal_pemeriksaan['masa_berlaku_kp']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
                <input type="hidden" name="no_trayek" required value="<?php echo $kendaraan['id_trayek']; ?>"
                <tr><td width="20%">No. Trayek</td><td><b><input type="text" required value="<?php echo $kendaraan['kd_trayek']; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['alamat']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Masa Berlaku Ijin Trayek</td><td><b><input type="text" name="masa_berlaku_ijin_trayek" required value="<?php echo $tanggal_pemeriksaan['masa_berlaku_ijin_trayek']; ?>" style="width: 300px" id="masa_berlaku_ijin_trayek" class="form-control" readonly /></td></tr>	

                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success" <?php if(empty($kendaraan['no_uji'])) {?> disabled="" <?php }?>>Simpan</button>
                        <a href="<?php echo base_url(); ?>index.php/pemeriksaan/index_<?php echo $path; ?>" class="btn btn-primary">Kembali</a>
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
