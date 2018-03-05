<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Daftar Hilang / Rusak</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                       

                        <ul class="nav navbar-nav navbar-right">
<!--                            <form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/master_data/kendaraan/cari">
                                        <input type="text" class="form-control" name="q" style="width: 200px" placeholder="Masukan nama pemilik ..." required>
                                        <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
                                </form>-->
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>

    <?php echo $this->session->flashdata("message_cetak_ulang"); ?>

    <!--	
    <div class="alert alert-dismissable alert-success">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>Well done!</strong> You successfully read <a href="http://bootswatch.com/amelia/#" class="alert-link">this important alert message</a>.
    </div>
            
    <div class="alert alert-dismissable alert-danger">
      <button type="button" class="close" data-dismiss="alert">x</button>
      <strong>Oh snap!</strong> <a href="http://bootswatch.com/amelia/#" class="alert-link">Change a few things up</a> and try submitting again.
    </div>	
    -->

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Nomor KP</th>
                <th width="10%">Nomor Uji</th>
                <th width="10%">Nomor Kendaraan</th>
                <th width="10%"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (empty($data_cetak_ulang)) {
                echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
            } else {
                $no = ($this->uri->segment(4) + 1);
                foreach ($data_cetak_ulang as $b) {
                        $kp_trayek = strlen(trim($b->kp_ijin_trayek));
                        $kp_operasi = strlen(trim($b->kp_ijin_operasi));
                    ?>

                    <tr style="background-color: #fff;">
                        <td><center><?php echo $no; ?></center></td>
                <td><?php echo $kp_trayek!= 0 ? $b->kp_ijin_trayek : $b->kp_ijin_operasi; ?></td>
                <td><?php echo $b->no_uji; ?></td>
                <td><?php echo $b->no_kendaraan; ?></td>
                <td class="ctr">
                    <div class="btn-group">	
                        <?php 
                            if($b->verifikasi == 0) {
                        ?>
                         <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/verifikasi_cetak_ulang/<?php echo $b->no_uji; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Verifikasi</a>
                         <?php
                            } else if($b->verifikasi == 1) {
                         ?>
                         <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/print_ulang/<?php echo $b->no_uji; ?>" class="btn btn-warning btn-sm" title="Hapus Data"><i class="icon-trash icon-print">  </i> Print</a>
                         <?php 
                            } else {
                         ?>
                         <a href="#" class="btn btn-danger btn-sm" title="Hapus Data"><i class="">  </i> DITOLAK</a>
                         <?php 
                            }
                         ?>
                    </div>	

                </td>
                </tr>
        <?php
        $no++;
    }
}
?>
        </tbody>
    </table>
    <center><ul class="pagination"><?php echo $pagi_cetak_ulang; ?></ul></center>
</div>
