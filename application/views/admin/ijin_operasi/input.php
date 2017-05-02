

<?php
$mode = $this->uri->segment(3);


if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_perusahaan = $datpil['id_perusahaan'];
    $id_ijin_operasi = $datpil['id_ijin_operasi'];
    $id_kendaraan = $datpil['id_kendaraan'];
    $masa_berlaku = $datpil['masa_berlaku'];
    $masa_berakhir = $datpil['masa_berakhir'];
    $verifikasi = $datpil['verifikasi'];
    $nama_perusahaan = $datpil['nama_perusahaan'];
    $alamat_perusahaan = $datpil['alamat_perusahaan'];
} else {
    $act = "act_add";
    $id_kendaraan = "";
    $id_perusahaan = "";
    $id_ijin_operasi = $kode;
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
            <span class="navbar-brand" href="#">Ijin Operasi</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<form action="<?php echo site_url("ijin_trayek_operasi/ijin_operasi/" . $act); ?>" method="post" accept-charset="utf-8">


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                <tr><td style="width: 50%">No. Ijin Operasi</td><td style="width: 50%;"><b><input type="text" name="id_ijin_operasi" required value="<?php echo $id_ijin_operasi; ?>" style="width: 200px" class="form-control" readonly=""></b></td></tr>
                <tr><td style="width: 50%">Id. Perusahaan</td><td><b><input type="search" name="id_perusahaan" required value="<?php echo $id_perusahaan;?>" style="width: 400px" class="form-control" id="perusahaan" placeholder="Ketik Nama Perusahaan"></b></td></tr>
                <tr><td style="width: 50%">Nama Perusahaan</td><td><b><input type="search" value="<?php echo $nama_perusahaan; ?>" id="nama_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <tr><td style="width: 50%">Alamat Perusahaan</td><td><b><input type="search"  value="<?php echo $alamat_perusahaan; ?>"   id="alamat_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />
                 <tr><td style="width: 30%">Id. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $id_kendaraan; ?>" id="kendaraan" style="width: 300px" class="form-control" placeholder="Ketikan simau"></b></td></tr>		               
                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_operasi" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>

       


    </div>

</form>
