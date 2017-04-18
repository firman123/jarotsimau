

<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $no_uji = $datpil['no_uji'];
    $no_kendaraan = $datpil['no_kendaraan'];
    $nama_pemilik = $datpil['nama_pemilik'];
    $alamat = $datpil['alamat'];
    $no_mesin = $datpil['no_mesin'];
    $no_chasis = $datpil['no_chasis'];
    $jenis = $datpil['sifat'];
} else {
    $act = "act_add";
    $no_uji = $kode;
    $no_kendaraan = "";
    $nama_pemilik = "";
    $alamat = "";
    $no_mesin = "";
    $no_chasis = "";
    $jenis = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Input Kendaraan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo site_url("master_data/kendaraan/" . $act); ?>" method="post" accept-charset="utf-8">

    <input type="hidden" name="no_uji" value="<?php echo $no_uji; ?>">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td width="20%">No. Uji</td><td><b><input type="text" name="no_uji" required value="<?php echo $no_uji; ?>" style="width: 200px" class="form-control" disabled></b></td></tr>
                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="no_kendaraan" required value="<?php echo $no_kendaraan; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>		
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="nama_pemilik" required value="<?php echo $nama_pemilik; ?>" style="width: 300px" class="form-control"></td></tr>	
                            <tr><td width="20%">Alamat</td><td><b><textarea name="alamat" required style="width: 400px; height: 90px" class="form-control"><?php echo $alamat; ?></textarea></b></td></tr>	

                            <tr><td colspan="2">
                                    <br><button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-primary">Kembali</a>
                                </td></tr>
            </table>
        </div>

        <div class="col-lg-6">	
            <table  class="table-form">
                <tr><td>No. Rangka</td><td><b><input type="text" name="no_chasis" required value="<?php echo $no_chasis; ?>" style="width: 300px" class="form-control"></b></td></tr>
                <tr><td width="20%">Nomor Mesin</td><td><b><input type="text" name="no_mesin" id="kode_surat" required value="<?php echo $no_mesin; ?>" style="width: 300px" class="form-control"></b></td></tr>
                <tr><td>Sifat</td><td><b>                                
                            <select name="sifat" class="form-control" required>
                                <option></option>
                                //<?php
                                foreach ($data_jenis as $value) {
                                    ?>
                                    <option value="<?php echo $value; ?>" <?php if ($value == $jenis) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$jenis_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
//                                
                                ?>
                                <!--                                <option value="Umum">Umum</option>
                                                                <option value="Tidak Umum">Tidak Umum</option>
                                                                <option value="Coba Jalan">Coba Jalan</option>-->
                            </select>
                        </b></td></tr>
            </table>	
        </div>

    </div>

</form>
