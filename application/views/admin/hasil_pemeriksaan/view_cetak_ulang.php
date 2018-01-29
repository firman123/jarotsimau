
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Daftar Hilang / Rusak</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message_cari"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-6">
        <table  class="table-form">
            <form action="<?php echo site_url("cetak_ulang/cari_kendaraan"); ?>" method="post" accept-charset="utf-8">

                <tr><td width="20%">No. Uji</td><td><b><input type="text" name="no_kendaraan" value="<?php echo $kendaraan['no_uji'] ?>" readonly="" id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td><td></td></tr>		
            </form>
            <form action="<?php echo site_url("hasil_pemeriksaan/update_cetak_ulang"); ?>" method="post" accept-charset="utf-8">
                <input type="hidden" name="id_cetak_ulang" value="<?php echo $kendaraan['id_cetak_ulang']; ?>" />
                <tr><td style="width: 50%;">NO. KP</td><td style="width: 50%;"><b><input type="text" name="no_kp" required value="<?php echo strlen(trim($kendaraan['kp_ijin_trayek'])) == 0 ? $kendaraan['kp_ijin_operasi'] : $kendaraan['kp_ijin_trayek'] ?>" id="kartu_pengawasan" style="width: 300px" class="form-control" readonly=""/></b></td></tr>

                <tr><td width="20%">Nomor Kendaraan</td><td><b><input type="text" name="no_kendaraan" required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="masa_berlaku" style="width: 300px" class="form-control" readonly /></td></tr>	
              
                <!--<input type="hidden" name="id_kendaraan" value="<?php echo $kendaraan['id_kendaraan']; ?>" />-->
      
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="nama_pemilik" style="width: 300px" class="form-control" readonly /></td></tr>	
                <tr><td width="20%">Alamat</td><td><b><input type="text" name="alamat_pemilik" required value="<?php echo $kendaraan['alamat']; ?>" id="alamat_pemilik" style="width: 300px" class="form-control" readonly/></td></tr>	
               
                <tr><td colspan="2">
                             <button type="submit" name="verifikasi" value="1" class="btn btn-primary btn-success">Setuju</button>
                             <button type="submit" name="verifikasi" value="2" class="btn btn-primary">Tidak Setuju</button>
                    </td></tr>
        </table>
    </div>

</div>

</form>
