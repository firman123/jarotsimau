<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Verifikasi Ijin Isidentil</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
           
            <form action="<?php echo site_url("hasil_pemeriksaan/konfirmasi_isidentil"); ?>" method="post" accept-charset="utf-8">
                <input type="hidden" name="id_ijin" value="<?php echo $kendaraan['id_ijin'];?>" />
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo $kendaraan['kp_ijin_trayek'];?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Nomor Kendaraan</td><td><b><input type="text" readonly="true" name="no_kendaraan_lama" required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
               
                <input type="hidden" name="id_kendaraan" value="<?php echo $kendaraan['kendaraan_id'];  ?>" />
                <tr><td width="20%">No. Trayek</td><td><b><input type="text" required value="<?php echo $kendaraan['kd_trayek']; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
                 <tr><td width="20%">Kota Tujuan</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['kota_tujuan']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	 
                <tr><td width="20%">Verifikasi</td><td><b>
                            <select name="submit" class="form-control" required style="width: 40%">
                                <option></option>
                                <option value="2">Tidak Setuju</option>
                                <option value="1">Setuju</option>
                            </select>
                        </b></td></tr>
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                      
                    </td></tr>
        </table>
    </div>

</div>

</form>
