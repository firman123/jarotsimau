

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_ijin_trayek = $datpil['id_ijin_trayek'];
    $id_kendaraan = $datpil['id_kendaraan'];
    $id_trayek = $datpil['id_trayek'];
    $masa_berlaku = $datpil['masa_berlaku'];
    $masa_berakhir = $datpil['masa_berakhir'];
    $verifikasi = $datpil['verifikasi'];
} else {
    $act = "act_add";
    $id_ijin_trayek = $kode;
    $id_trayek = "";
    $id_kendaraan = "";
    $masa_berlaku = "";
    $masa_berakhir = "";
    $verifikasi = 0;
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
                <tr><td width="20%">No. Ijin Trayek</td><td><b><input type="text" name="id_ijin_trayek" required value="<?php echo $id_ijin_trayek; ?>" style="width: 200px" class="form-control"></b></td></tr>
                <tr><td width="20%">Id. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $id_kendaraan; ?>" id="kendaraan" style="width: 400px" class="form-control" placeholder="Ketik Kode Kendaraan"></b></td></tr>		
                <tr><td width="20%">Kode. Trayek</td><td><b><input type="text" name="id_trayek" required value="<?php echo $id_trayek; ?>" id="trayek" style="width: 400px" class="form-control" placeholder="Ketik Kode trayk"></b></td></tr>		


                <tr><td width="20%">Tanggal Berlaku</td><td><b><input type="text" name="masa_berlaku" required value="<?php echo $masa_berlaku; ?>" style="width: 300px" class="form-control" id="tanggal_berlaku"/></td></tr>	
                <tr><td width="20%">Tanggal Berakhir</td><td><b><input type="text" name="masa_berakhir" required value="<?php echo $masa_berakhir; ?>" style="width: 300px" class="form-control" id="tanggal_berakhir"/></td></tr>	
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_trayek" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>


    </div>

</form>
