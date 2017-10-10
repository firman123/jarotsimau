<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Pengemudi</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo base_URL() ?>index.php/kartu_pengawasan/<?php echo $path; ?>/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Daftar Pengemudi</a></li>

                            <!--<li><a href="<?php echo base_URL() ?>index.php/pemeriksaan/index_<?php echo $path; ?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Daftar Kendaraan</a></li>-->
                        </ul>

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

    <?php echo $this->session->flashdata("message"); ?>

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
                <th width="7%">No Uji</th>
                <th width="10%">ID KP</th>
                <th width="10%">ID Kendaraan</th>
                <th width="10%">No Kendaraan</th>
                <th width="15%">Nomor KTP</th>
                <th width="15%">Nama Pengemudi</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (empty($data)) {
                echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
            } else {
                $no = ($this->uri->segment(4) + 1);
                foreach ($data as $b) {
                    ?>

                    <tr style="background-color: #fff;">
                        <td><center><?php echo $no; ?></center></td>
                <td><?php echo $b->no_uji; ?></td>
                <td><?php echo $b->id_kp; ?></td>
                <td><?php echo $b->id_kendaraan; ?></td>
                <td><?php echo $b->no_kendaraan; ?></td>
                <td><?php echo $b->no_ktp; ?></td>
                <td><?php echo $b->nama_pengemudi; ?></td>
                <td class="ctr">
                    <div class="btn-group">

                        <a href="<?php echo base_URL() ?>index.php/kartu_pengawasan/<?php echo $path; ?>/edt/<?php echo $b->id; ?>" class="btn btn-warning btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> View</a>
                        <a href="<?php echo base_URL() ?>index.php/kartu_pengawasan/cetak_kartu_pengemudi/<?php echo $b->id; ?>" target="_blank" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-print icon-white"> </i> Kartu pengemudi</a>	
                        <a href="<?php echo base_URL() ?>index.php/kartu_pengawasan/<?php echo $path; ?>/del/<?php echo $b->id; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>
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
    <center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
