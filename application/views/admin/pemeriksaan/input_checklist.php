<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Pemeriksaan Kelengkapan Angkutan Umum</span>
        </div>

        <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
            <ul class="nav navbar-nav">
                <!--<li><a href="<?php echo site_url("hasil_pemeriksaan/index_$path"); ?>" class="btn-info"><i class="icon-edit icon-white"> </i> Lihat Hasil Pemeriksaan</a></li>-->
            </ul>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<?php echo $this->session->flashdata("message"); ?>


<div class="row-fluid well" style="overflow: hidden">
    <form action="<?php echo site_url("pemeriksaan/act_add_checklist/$path"); ?>" method="post" accept-charset="utf-8">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">No. KP</th>
                            <th width="10%">No. Kendaraan</th>
                            <th width="10%">No. Uji</th>
                            <?php if ($path == 'trayek') echo '<th>No. Trayek</th>'; ?>
                            <th>No.Chasis</th>
                            <th>No.Mesin</th>
                            <th width="15%">Tanggal Diperiksa</th>
                            <th width="10%">Pilih</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (empty($data)) {
                            echo "<tr><td colspan='8'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
                        } else {
                            $no = ($this->uri->segment(4) + 1);
                            foreach ($data as $b) {
                                if (empty($b->tanggal_pemeriksaan)) {
                                    ?>

                                    <tr style="background-color: #fff;">
                                        <td><center><?php echo $no; ?></center></td>
                                <td><?php
                                    if ($path == 'trayek')
                                        echo $b->kp_ijin_trayek;
                                    else
                                        echo $b->kp_ijin_operasi;
                                    ?></td>
                                <td><?php echo $b->no_kendaraan; ?></td>
                                <td><?php echo $b->no_uji; ?></td>
            <?php if ($path == 'trayek') echo '<td>' . $b->kd_trayek . '</td>'; ?>

                                <td><?php echo $b->no_chasis; ?></td>
                                <td><?php echo $b->no_mesin; ?></td>
                                <td><input type="hidden" name="tanggal_periksa" value="<?php echo $b->tanggal_pemeriksaan; ?>"><?php
                                    if (empty($b->tanggal_pemeriksaan))
                                        echo 'Belum Diperiksa';
                                    else
                                        echo $date_manipulation->get_full_date($b->tanggal_pemeriksaan);
                                    ?></td>

                                <td class="ctr">
                                    <div class="btn-group">

                                        <input type="radio" name="id_pemeriksaan" value="<?php echo $b->id_tbl_pemeriksaan; ?>" required>
                                    </div>	

                                </td>
                                </tr>
                                <?php
                                $no++;
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
                <center><ul class="pagination"><?php echo $pagi; ?></ul></center>
            </div>
        </div>
        <h4> <b>Checklist perlengkapan yang masih kurang</h4>
        <div class="row" style="margin-top: 20px; margin: auto; ">


            <div class="col-lg-6">
                <table class="table-form">
                    <tr><td width="20%"><input type="checkbox" name="pakaian" value="1"></td><td><b>Pakaian seragam pengemudi</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="nm_perusahaan_kd_trayek" value="1"></td><td><b>Nama perusahaan dan kode trayek</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="jenis_layanan" value="1"></td><td><b>Tulisan jenis layanan</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="lambang_perusahaan" value="1"></td><td><b>Lambang perusahaan</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="papan_trayek" value="1"></td><td><b>Papan trayek</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="moto_kota" value="1"></td><td><b>Tulisan moto kota</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="warna_kendaraan" value="1"></td><td><b>Warna kendaraan</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="safetybelt" value="1"></td><td><b>Safety belt</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="segitiga_pengaman" value="1"></td><td><b>Segitiga pengaman</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="argometer" value="1"></td><td><b>Argometer</td></tr>
                    <tr><td colspan="2">
                            <br><button type="submit" class="btn btn-success">Simpan</button>
                            <a href="<?php echo base_url(); ?>index.php/pemeriksaan/index_<?php echo $path; ?>" class="btn btn-primary">Kembali</a>
                        </td></tr>
                </table>
            </div>
            <div class="col-lg-6">
                <table class="table-form">
                    <tr><td width="20%"><input type="checkbox" name="ban_serep" value="1"></td><td><b>Ban serep dan pembuka ban</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="lampu_angkot" value="1"></td><td><b>Lampu angkot</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="kotak_obat" value="1"></td><td><b>Kotak Obat</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="kotak_sampah" value="1"></td><td><b>Kotak Sampah</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="retribusi_parkir" value="1"></td><td><b>Retribusi Parkir</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="daftar_tarif" value="1"></td><td><b>Daftar Tarif</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="no_kendaraan" value="1"></td><td><b>Nomor Kendaraan</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="no_mesin" value="1"></td><td><b>Nomor Mesin</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="no_rangka" value="1"></td><td><b>Nomor Rangka</td></tr>
                    <tr><td width="20%"><input type="checkbox" name="kartu_identitas" value="1"></td><td><b>Kartu Identitas Pengemudi</td></tr>

                </table>
            </div>
    </form>
</div>
</div>


</form>
