

<?php
$mode = $this->uri->segment(2);


if ($mode == "edit" || $mode == "act_edit") {
    $act = "act_edt";
    $id_kwitansi = $datpil['id_kwitansi'];
    $jenis = $datpil['jenis'];
    $harga = $datpil['harga'];
    $keterangan = $datpil['keterangan'];
} 
?>
<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Setting Kwitansi</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<?php echo $this->session->flashdata("message"); ?>

    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-12">
            <table  class="table-form">
                <!--<tr><td width="20%">No. Ijin Operasi</td><td><b>-->
  
                <form action="<?php echo site_url("kuitansi/" . $act); ?>" method="post" accept-charset="utf-8">


                <input type="hidden" name="id_kwitansi" required value="<?php echo $id_kwitansi; ?>" style="width: 200px" class="form-control" readonly>
                <!--</b></td></tr>-->

                <tr><td width="20%">Jenis</td><td><b><input type="text" name="jenis" required value="<?php echo $jenis; ?>" id="kendaraan" style="width: 300px" class="form-control" ></b>
                    </td></tr>	
                <tr><td width="20%">Harga</td><td><b><input type="text" name="harga" required value="<?php echo $harga; ?>" id="biaya_kwitansi" style="width: 300px" class="form-control" ></b>
                    </td></tr>
                 <tr><td width="20%">Terbilang</td><td><b><input type="text" name="keterangan" required value="<?php echo $keterangan; ?>" id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td></tr>
                   <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>index.php/kuitansi" class="btn btn-primary">Kembali</a>
                    </td></tr>
            </table>
        </div>
</form> 

</div>


