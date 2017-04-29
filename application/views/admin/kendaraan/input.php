

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
    $sifat = $datpil['sifat'];
    $value_jenis = $datpil['jenis_angkutan'];
    $value_trayek = $datpil['id_trayek'];
    $perusahaan = $datpil['id_perusahaan'];
} else {
    $act = "act_add";
    $no_uji = $kode;
    $no_kendaraan = "";
    $nama_pemilik = "";
    $alamat = "";
    $no_mesin = "";
    $no_chasis = "";
    $sifat = "";
    $value_jenis = "";
    $value_trayek = "";
    $perusahaan = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Data Kendaraan</span>
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
                                    <a href="<?php echo base_URL(); ?>index.php/master_data/kendaraan" class="btn btn-primary">Kembali</a>
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
                                foreach ($data_sifat as $value) {
                                    ?>
                                    <option value="<?php echo $value; ?>" <?php if ($value == $sifat) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
//                                
                                ?>
                            </select>
                        </b></td></tr>
             
                <tr><td>Jenis Angkutan</td><td><b>
                         
                            <select name="jenis_angkutan" class="form-control" required>
                                <option></option>
                                <?php
                           
                                  foreach ($jenis_kendaraan as $value) {
                                    ?>
                                <option value="<?php echo trim($value); ?>" <?php if (trim($value) == trim($value_jenis)) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }           
                                ?>
                            </select>
                        </b></td></tr>
                
                <tr><td>Perusahaan</td><td><b>                                
                            <input type="text" placeholder="Nama Perusahaan" name="perusahaan" id="perusahaan" class="form-control" required value="<?php echo $perusahaan;?>"/>

                        </b></td></tr>
                
                <tr><td>Trayek</td><td><b>                                
                            <select name="trayek" class="form-control" required>
                                <option></option>
                                <?php
                                
                                                                print_r(trayek);
                                foreach ($trayek as $value) {
                                    ?>
                                    <option value="<?php echo $value['id_trayek']; ?>" <?php if ($value['id_trayek'] == $value_trayek) { ?> selected="selected" <?php } ?>><?php echo $value['lintasan_trayek']; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$jenis_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }           
                                ?>
                            </select>
                        </b></td></tr>
            </table>	
        </div>

    </div>

</form>
