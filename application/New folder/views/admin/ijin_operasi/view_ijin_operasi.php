

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
    $kp_operasi = $datpil['kp_ijin_operasi'];
    $no_kendaraan = $datpil['no_kendaraan'];
    $nama_pemilik = $datpil['nama_pemilik'];
} else {
    $act = "act_add_kendaraan";
    $id_perusahaan = $datpil['id'];
    $id_ijin_operasi = $ijin_operasi['id_ijin_operasi'];
    $id_kendaraan = "";
    $id_trayek = "";
    $value_trayek = "";
    $masa_berlaku = "";
    $masa_berakhir = "";
    $verifikasi = 0;
    $nama_perusahaan = $datpil['nama_perusahaan'];
    $alamat_perusahaan = $datpil['alamat_perusahaan'];
    $kp_operasi = $kode;
}
?>
<?php echo $this->session->flashdata("message"); ?>
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
                
                
                <tr><td width="20%">No. Ijin Operasi</td><td><b><input type="text" name="id_ijin_operasi" required value="<?php echo $id_ijin_operasi; ?>" style="width: 200px" class="form-control" readonly=""></b></td></tr>
                <tr><td width="20%">Id. Perusahaan</td><td><b><input type="text" name="id_perusahaan" value="<?php echo $id_perusahaan; ?>" id="nama_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text" value="<?php echo $nama_perusahaan; ?>" id="nama_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <tr><td width="20%">Alamat Perusahaan</td><td><b><input type="search"  value="<?php echo $alamat_perusahaan; ?>"   id="alamat_perusahaan" style="width: 400px" class="form-control" readonly></b></td></tr>
                <input type="hidden" name="verifikasi" value="<?php echo $verifikasi; ?>" />
                <tr><td colspan="2">
                       
                        <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_operasi" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>

        <div class="col-lg-6">
            <table  class="table-form">
                <input type="hidden" value="<?php echo $kp_operasi; ?>" name="kp_ijin_operasi" />
               
                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $no_kendaraan; ?>" id="kendaraan" style="width: 300px" class="form-control" placeholder="Bersarkan no kendaraan (numeric)" readonly=""></b></td></tr>
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $nama_pemilik; ?>" id="kendaraan" style="width: 300px" class="form-control" placeholder="Bersarkan no kendaraan (numeric)" readonly=""></b></td></tr>		
            </table>
        </div>


    </div>

</form>
