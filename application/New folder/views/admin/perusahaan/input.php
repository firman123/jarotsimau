

<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id = $datpil['id'];
    $no_surat_ijin = $datpil['no_surat_ijin'];
    $nama_perusahaan = $datpil['nama_perusahaan'];
    $alamat_perusahaan = $datpil['alamat_perusahaan'];
    $npwp = $datpil['npwp'];
    $nama_pimpinan = $datpil['nama_pimpinan'];
    $alamat = $datpil['alamat'];
    $no_ktp = $datpil['no_ktp'];
    $no_telpon = $datpil['no_telpon'];
    $masa_berlaku = $datpil['masa_berlaku'];
    $value_jenis = $datpil['jenis'];
} else {
    $act = "act_add";
    $id = "";
    $no_surat_ijin = "";
    $nama_perusahaan = "";
    $alamat_perusahaan = "";
    $npwp = "";
    $nama_pimpinan = "";
    $alamat = "";
    $no_ktp = "";
    $no_telpon = "";
    $masa_berlaku = "";
    $value_jenis = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Data Perusahaan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo site_url("master_data/perusahaan/" . $act); ?>" method="post" accept-charset="utf-8">

    <input type="hidden" name="id" value="<?php echo $id; ?>">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td width="20%">NO. Surat Ijin</td><td><b><input type="text" name="no_surat_ijin" required value="<?php echo $no_surat_ijin; ?>" style="width: 200px" class="form-control"></b></td></tr>    
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" name="nama_perusahaan" required value="<?php echo $nama_perusahaan; ?>" style="width: 200px" class="form-control"></b></td></tr>             
                <tr><td>Jenis Angkutan</td><td><b>

                            <select name="jenis" class="form-control" required>
                                <option></option>
                                <?php
                                foreach ($jenis_perusahaan as $value) {
                                    ?>
                                    <option value="<?php echo trim($value); ?>" <?php if (trim($value) == trim($value_jenis)) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
                                ?>
                            </select>
                        </b></td></tr>
                <tr><td width="20%">Alamat Perusahaan</td><td><b><textarea name="alamat_perusahaan" required style="width: 400px; height: 90px" class="form-control"><?php echo $alamat_perusahaan; ?></textarea></b></td></tr>	
                <tr><td width="20%">NPWP</td><td><b><input type="text" name="npwp" required value="<?php echo $npwp; ?>" id="dari" style="width: 400px" class="form-control"></b></td></tr>		
                <tr><td width="20%">Tanggal Berlaku</td><td><b><input type="text" name="masa_berlaku" required value="<?php echo $masa_berlaku; ?>" style="width: 300px" class="form-control" id="tanggal_berlaku"/></td></tr>
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_url(); ?>index.php/master_data/perusahaan" class="btn btn-primary">Kembali</a>
                    </td></tr>

            </table>
        </div>

        <div class="col-lg-6">	
            <table  class="table-form">
                <tr><td>Nama Pimpinan</td><td><b><input type="text" name="nama_pimpinan" required value="<?php echo $nama_pimpinan; ?>" style="width: 300px" class="form-control"></b></td></tr>
                <tr><td width="20%">Alamat</td><td><b><textarea name="alamat" required style="width: 400px; height: 90px" class="form-control"><?php echo $alamat; ?></textarea></b></td></tr>	
                <tr><td width="20%">Nomor KTP</td><td><b><input type="text" name="no_ktp" id="kode_surat" required value="<?php echo $no_ktp; ?>" style="width: 300px" class="form-control"></b></td></tr>
                <tr><td width="20%">Nomor Telpon</td><td><b><input type="text" name="no_telpon" id="kode_surat" required value="<?php echo $no_telpon; ?>" style="width: 300px" class="form-control"></b></td></tr>

            </table>	
        </div>

    </div>

</form>
