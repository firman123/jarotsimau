

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_ijin = $datpil['id_ijin'];
    $id_perusahaan = $datpil['id_perusahaan'];
    $tanggal_berlaku = $datpil['tanggal_berlaku'];
    $tanggal_berakhir = $datpil['tanggal_berakhir'];
    $verifikasi = $datpil['verifikasi'];
} else {
    $act = "act_add";
    $id_ijin = "";
    $id_perusahaan = "";
    $tanggal_berlaku = "";
    $tanggal_berakhir = "";
    $verifikasi = 0;
}
?>


<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Ijin Usaha <?php echo $sub_title; ?></span>
        </div>
    </div>
</div>

<!-- /.navbar -->

<form action="<?php echo site_url("ijin_usaha/".$path."/". $act); ?>" method="post" accept-charset="utf-8">

    <input type="hidden" name="id_ijin" value="<?php echo $id_ijin; ?>" />


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
            
                <tr><td width="20%">Id. Perusahaan</td><td><b><input type="text" name="id_perusahaan" placeholder="Ketik Nama Perusahaan" required value="<?php echo $id_perusahaan; ?>" id="perusahaan" style="width: 400px" class="form-control"/></b></td></tr>		
                <tr><td width="20%">Tanggal Berlaku</td><td><b><input type="text" name="tanggal_berlaku" required value="<?php echo $tanggal_berlaku; ?>" style="width: 300px" class="form-control" id="tanggal_berlaku"/></td></tr>	
                <tr><td width="20%">Tanggal Berakhir</td><td><b><input type="text" name="tanggal_berakhir" required value="<?php echo $tanggal_berakhir; ?>" style="width: 300px" class="form-control" id="tanggal_berakhir"/></td></tr>	
                <input type="hidden" name="jenis_angkutan" value="<?php echo $jenis_angkutan; ?>" />
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />            
                            
                           <tr><td colspan="2">
                                    <br/><button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="<?php echo base_URL(); ?>index.php/ijin_usaha/<?php $path ?>" class="btn btn-primary">Kembali</a>
                                </td></tr>
            </table>
        </div>



    </div>

</form>
