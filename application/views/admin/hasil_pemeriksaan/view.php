<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Pemeriksaan Kelengkapan Angkutan Umum</span>
        </div>

        <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
<!--            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url("hasil_pemeriksaan/index_$path"); ?>" class="btn-info"><i class="icon-edit icon-white"> </i> Lihat Hasil Pemeriksaan</a></li>
            </ul>-->
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message"); ?>


<div class="row-fluid well" style="overflow: hidden">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-12">
            <table  class="table-form">
                <tr><td width="20%">No. Uji</td><td><b><input type="text" name="no_uji" required value="<?php echo $pemeriksaan['no_uji']; ?>" style="width: 200px" class="form-control" disabled></b></td></tr>
                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" readonly="" name="no_kendaraan" required value="<?php echo $pemeriksaan['no_kendaraan']; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>		
                <tr><td width="20%">No. Rangka</td><td><b><input type="text" readonly=""  name="no_chasis" required value="<?php echo $pemeriksaan['no_chasis']; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>		
                <tr><td width="20%">No. Mesin</td><td><b><input type="text" readonly="" name="no_kendaraan" required value="<?php echo $pemeriksaan['no_mesin']; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" readonly="" name="nama_pemilik" required value="<?php echo $pemeriksaan['nama_pemilik']; ?>" style="width: 300px" class="form-control"></td></tr>	
                           
                            </table>
                            </div>
                            </div>
                            <div class="row" style="margin-top: 20px; margin: auto; ">

                                <h4> <b>Tanda Checklist menunjukkan perlengkapan yang masih kurang</h4>
                                <div class="col-lg-6">
                                    <table class="table-form">
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="pakaian" <?php if ($pemeriksaan['pakaian'] == 1) echo 'checked'; ?>></td><td><b>Pakaian seragam pengemudi</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="nm_perusahaan_kd_trayek" <?php if ($pemeriksaan['nm_perusahaan_kd_trayek'] == 1) echo 'checked'; ?>></td><td><b>Nama perusahaan dan kode trayek</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="jenis_layanan" <?php if ($pemeriksaan['jenis_layanan'] == 1) echo 'checked'; ?>></td><td><b>Tulisan jenis layanan</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="lambang_perusahaan" <?php if ($pemeriksaan['lambang_perusahaan'] == 1) echo 'checked'; ?>></td><td><b>Lambang perusahaan</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="papan_trayek" <?php if ($pemeriksaan['papan_trayek'] == 1) echo 'checked'; ?>></td><td><b>Papan trayek</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="moto_kota" <?php if ($pemeriksaan['moto_kota'] == 1) echo 'checked'; ?>></td><td><b>Tulisan moto kota</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="warna_kendaraan" <?php if ($pemeriksaan['warna_kendaraan'] == 1) echo 'checked'; ?>></td><td><b>Warna kendaraan</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="safetybelt" <?php if ($pemeriksaan['safetybelt'] == 1) echo 'checked'; ?>></td><td><b>Safety belt</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" readonly name="segitiga_pengaman"<?php if ($pemeriksaan['segitiga_pengaman'] == 1) echo 'checked'; ?>></td><td><b>Segitiga pengaman</td></tr>
                                        <tr><td width="20%"><input type="checkbox"  disabled="true" name="argometer" <?php if ($pemeriksaan['argometer'] == 1) echo 'checked'; ?>></td><td><b>Argometer</td></tr>
                                        <tr><td colspan="2">
                                                <form action="<?php echo site_url("hasil_pemeriksaan/update_verifikasi"); ?>" method="post" accept-charset="utf-8">
                                                    <input type="hidden" name="jenis" value="<?php echo $jenis; ?>" />
                                                    <input type="hidden" name="id_pemeriksaan" value="<?php echo $pemeriksaan['id_checklist']; ?>" />
                                                    <input type="hidden" name="id_update_pemeriksaan" value="<?php echo $pemeriksaan['id_pemeriksaan']; ?>" />
                                                    <input type="hidden" name="tgl_mati_uji" required value="<?php echo $pemeriksaan['tgl_mati_uji']; ?>" style="width: 300px" class="form-control">
                                                    <button type="submit" name="verifikasi" value="1" class="btn btn-primary btn-success">Setuju</button>
                                                    <button type="submit" name="verifikasi" value="2" class="btn btn-primary">Tidak Setuju</button>
                                                    <!--<a href="<?php echo base_url(); ?>index.php/hasil_pemeriksaan/index" class="btn btn-primary btn-warning">Kembali</a>-->
                                                </form>
                                            </td></tr>
                                    </table>
                                </div>
                                <div class="col-lg-6">
                                    <table class="table-form">
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="ban_serep"<?php if ($pemeriksaan['ban_serep'] == 1) echo 'checked'; ?>></td><td><b>Ban serep dan pembuka ban</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="lampu_angkot" <?php if ($pemeriksaan['lampu_angkot'] == 1) echo 'checked'; ?>></td><td><b>Lampu angkot</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="kotak_obat" <?php if ($pemeriksaan['kotak_obat'] == 1) echo 'checked'; ?>></td><td><b>Kotak Obat</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="kotak_sampah" <?php if ($pemeriksaan['kotak_sampah'] == 1) echo 'checked'; ?>></td><td><b>Kotak Sampah</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="retribusi_parkir" <?php if ($pemeriksaan['retribusi_parkir'] == 1) echo 'checked'; ?>></td><td><b>Retribusi Parkir</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="daftar_tarif" <?php if ($pemeriksaan['daftar_tarif'] == 1) echo 'checked'; ?>></td><td><b>Daftar Tarif</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="no_kendaraan" <?php if ($pemeriksaan['ck_no_kendaraan'] == 1) echo 'checked'; ?>></td><td><b>Nomor Kendaraan</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="no_mesin" <?php if ($pemeriksaan['ck_no_mesin'] == 1) echo 'checked'; ?>></td><td><b>Nomor Mesin</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="no_rangka" <?php if ($pemeriksaan['ck_no_rangka'] == 1) echo 'checked'; ?>></td><td><b>Nomor Rangka</td></tr>
                                        <tr><td width="20%"><input type="checkbox" disabled="true" name="kartu_identitas" <?php if ($pemeriksaan['kartu_identitas'] == 1) echo 'checked'; ?>></td><td><b>Kartu Identitas Pengemudi</td></tr>

                                    </table>
                                </div>
                            </div>
                            </div>


                            </form>
