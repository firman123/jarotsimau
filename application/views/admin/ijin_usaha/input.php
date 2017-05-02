

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_ijin = $datpil['id_ijin'];
    $id_perusahaan = $datpil['id_perusahaan'];
    $verifikasi = $datpil['verifikasi'];
    $jns = trim($jenis_angkutan);
} else {
    $act = "act_add";
    $id_ijin = "";
    $id_perusahaan = "";
    $verifikasi = 0;
    
    $jns = trim($jenis_angkutan);
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
                <tr><td width="20%">Id. Perusahaan</td><td><b><input type="text" name="id_perusahaan" placeholder="Ketik Nama Perusahaan" required value="<?php echo $id_perusahaan; ?>" id="<?php echo $jns; ?>" style="width: 400px" class="form-control"/></b></td></tr>		
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
