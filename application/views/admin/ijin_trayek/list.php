<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Ijin Trayek</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo site_url("ijin_trayek_operasi/ijin_trayek/add"); ?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/master_data/kendaraan/cari">
                                <input type="text" class="form-control" name="q" style="width: 200px" placeholder="Masukan nama pemilik ..." required>
                                <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
                            </form>
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
                <th width="10%">Nomor</th>
                 <th width="15%">Kode Kendaraan</th>
                <th width="20%">Nama Pemilik</th>
                <th width="20%">Nama Perusahaan</th>
                <th>Lintasan Trayek</th>
                <th width="15%"></th>
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
                <td><?php echo $b->no_uji;
            "<br><i>" . "</i>"; ?></td>
                <td><?php echo $b->nama_pemilik; ?></td>
                <td><?php echo $b->nama_perusahaan; ?></td>
                <td><?php echo $b->lintasan_trayek; ?></td>

                <td class="ctr">
                    <div class="btn-group">
                        <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/edt/<?php echo $b->id_ijin_trayek; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>		
                        <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/del/<?php echo $b->id_ijin_trayek; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>	
                        <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/cetak_ijin_trayek/<?php echo $b->id_ijin_trayek; ?>" class="btn btn-info btn-sm" target="_blank" title="Cetak Disposisi"><i class="icon-print icon-white"> </i> Ctk</a>	
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
