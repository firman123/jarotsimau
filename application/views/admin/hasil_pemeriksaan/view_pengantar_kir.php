<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Verifikasi Pengantar KIR</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
           
            <form action="<?php echo site_url("hasil_pemeriksaan/konfirmasi_pengantar_kir"); ?>" method="post" accept-charset="utf-8">
               <input type="hidden" name="id_pengantar" value="<?php echo $kendaraan['id_pengantar']?>" />
                <tr><td style="width: 50%;">Nomor Kerangka</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo $kendaraan['no_chasis']; ?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Nomor Mesin</td><td><b><input type="text" name="no_kendaraan" required value="<?php echo $kendaraan['no_mesin']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Nomor Kendaraan </td><td><b><input type="text" required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="no_trayek" style="width: 300px" class="form-control" readonly /></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['alamat']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="nama_perusahaan" style="width: 300px" class="form-control" readonly/></td></tr>	
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
