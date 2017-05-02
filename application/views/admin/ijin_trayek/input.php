

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_perusahaan = $datpil['id_perusahaan'];
    $id_ijin_trayek = $datpil['id_ijin_trayek'];
    $id_kendaraan = $datpil['id_kendaraan'];
    $value_trayek = $datpil['id_trayek'];
    $masa_berlaku = $datpil['masa_berlaku'];
    $masa_berakhir = $datpil['masa_berakhir'];
    $verifikasi = $datpil['verifikasi'];
    $nama_perusahaan = $datpil['nama_perusahaan'];
    $alamat_perusahaan = $datpil['alamat_perusahaan'];
} else {
    $act = "act_add";
    $id_kendaraan = "";
    $id_perusahaan = "";
    $id_ijin_trayek = $kode;
    $id_trayek = "";
    $value_trayek = "";
    $masa_berlaku = "";
    $masa_berakhir = "";
    $verifikasi = 0;
    $nama_perusahaan = "";
    $alamat_perusahaan = "";
}
?>
<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Ijin Trayek</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo site_url("ijin_trayek_operasi/ijin_trayek/" . $act); ?>" method="post" accept-charset="utf-8">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td width="20%">No. Ijin Trayek</td><td><b><input type="text" name="id_ijin_trayek" required value="<?php echo $id_ijin_trayek; ?>" style="width: 200px" class="form-control" readonly=""></b></td></tr>
                <tr><td width="20%">Id. Perusahaan</td><td><b><input type="search" name="id_perusahaan" required value="<?php echo $id_perusahaan;?>" style="width: 400px" class="form-control" id="perusahaan" placeholder="Ketik Nama Perusahaan"></b></td></tr>
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="search" value="<?php echo $nama_perusahaan; ?>" id="nama_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <tr><td width="20%">Alamat Perusahaan</td><td><b><input type="search"  value="<?php echo $alamat_perusahaan; ?>"   id="alamat_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_trayek" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td width="20%">Id. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $id_kendaraan; ?>" id="kendaraan" style="width: 300px" class="form-control" placeholder="Ketikan simau"></b></td></tr>		

                <tr><td width="100px">Kode Trayek</td><td><b>

                            <select name="id_trayek" class="form-control" required style="width: 40%">
                                <option></option>
                                <?php
                                foreach ($kode_trayek as $value) {
                                    ?>
                                    <option value="<?php echo $value->id_trayek; ?>" <?php if ($value->id_trayek == $value_trayek) { ?> selected="selected" <?php } ?>><?php echo $value->kd_trayek; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
                                ?>
                            </select>
                        </b></td></tr>
            </table>
        </div>


    </div>

</form>
