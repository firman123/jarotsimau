

<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_trayek = $datpil['id_trayek'];
    $kd_trayek = $datpil['kd_trayek'];
    $lintasan_trayek = $datpil['lintasan_trayek'];
} else {
    $act = "act_add";
    $id_trayek = "";
    $kd_trayek = "";
    $lintasan_trayek = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Data Trayek</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo site_url("master_data/trayek/" . $act); ?>" method="post" accept-charset="utf-8">

    <input type="hidden" name="id_trayek" value="<?php echo $id_trayek; ?>">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td width="20%">Kode Trayek</td><td><b><input type="text" name="kd_trayek" required value="<?php echo $kd_trayek; ?>" style="width: 200px" class="form-control"></b></td></tr>
                <tr><td width="20%">Lintasan Trayek</td><td><b><textarea name="lintasan_trayek" required style="width: 400px; height: 90px" class="form-control"><?php echo $lintasan_trayek; ?></textarea></b></td></tr>	

                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>admin/surat_masuk" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>

    </div>

</form>
