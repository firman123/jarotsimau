

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_perusahaan = $datpil['id_perusahaan'];
    $id_ijin_operasi = $datpil['id_ijin_operasi'];
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
    $id_ijin_operasi = $kode_ijin_operasi;
    $masa_berlaku = "";
    $masa_berakhir = "";
    $verifikasi = 0;
    $nama_perusahaan = "";
    $alamat_perusahaan = "";
    $kp_operasi = $kode;
}
?>
<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Ijin Operasi</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<?php echo $this->session->flashdata("message"); ?>

    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-12">
            <table  class="table-form">
                <!--<tr><td width="20%">No. Ijin Operasi</td><td><b>-->
               <form action="<?php echo site_url("ijin_trayek_operasi/ijin_operasi/cari_nomer_kendaraan"); ?>" method="post" accept-charset="utf-8">

                <tr><td width="20%">No. Uji Kendaraan</td><td><b><input type="text" name="no_kendaraan" required value="<?php echo $id_kendaraan; ?>"  style="width: 300px" class="form-control"></b>
                    </td><td><button type=submit class="btn btn-danger" id="search_kendaraan_button"><i class="icon-search icon-white"> </i> Cari</button></td></tr>		
                </form>
                <form action="<?php echo site_url("ijin_trayek_operasi/ijin_operasi/" . $act); ?>" method="post" accept-charset="utf-8">


                <input type="hidden" name="id_ijin_operasi" required value="<?php echo $id_ijin_operasi; ?>" style="width: 200px" class="form-control" readonly>
                <!--</b></td></tr>-->

                <tr><td width="20%">Id. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $id_kendaraan; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">Id. Perusahaan</td><td><b>
                            <select name="id_perusahaan" class="form-control" id="id_perusahaan" required style="width: 40%">
                                <option></option>
                                <?php
                                foreach ($list_perusahaan as $value) {
                                    ?>
                                    <option value="<?php echo $value->id; ?>" <?php if ($value->id == $id_perusahaan) { ?> selected="selected" <?php } ?>><?php echo $value->no_surat_ijin . "-" . $value->nama_perusahaan; ?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
                                ?>
                            </select>
                        </b></td></tr>
                <tr>
                    <td colspan="2">
                        <div id="nama_perusahaan"> 
                    </td>
                </tr>


                <tr><td width="20%"></td><td style="width: 400px"><b></b></td></tr>
                <tr><td width="20%"></td><td style="width: 400px"><b></b></td></tr>
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />
                <tr><td colspan="2">
                        <!--<br><button type="submit" class="btn btn-success">Simpan</button>-->
                        <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_operasi" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>
        <input type="hidden" value="<?php echo $kp_operasi; ?>" name="kp_ijin_operasi" />
</form> 

</div>


