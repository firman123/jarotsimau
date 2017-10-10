<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Rubah Sifat Kendaraan</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo site_url("rubahsifat/add"); ?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <a class="navbar-brand" href="#">Cari Kendaraan</a>
                            <form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/rubahsifat/cari_kendaraan">
                                <select name="id_perusahaan" class="form-control" id="id_perusahaan" required style="width: 70%">
                                    <option></option>
                                    <?php
                                    foreach ($list_perusahaan as $value) {
                                        ?>
                                        <option value="<?php echo $value->id; ?>"><?php echo $value->nama_perusahaan; ?></option>
                                        <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                        <?php
                                    }
                                    ?>
                                </select>
                                <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
                            </form>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>


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
                <th width="3%">No.</th>
                <th width="7%">No. Uji</th>
                <th width="10%">No. Kendaraan</th>
                <th width="10%">No. Rangka</th>
                <th width="10%">No. Mesin</th>
                <th width="17%">Nama Pemilik</th>

                <th width="5%">Sifat</th>
                <th width="8%"> Verifikasi</th>
                <th width="24%"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (empty($data)) {
                echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
            } else {
                $no = ($this->uri->segment(4) + 1);
                foreach ($data as $b) {
                    ?>

                    <tr style="background-color: #fff;">
                        <td><center><?php echo $no; ?></center></td>
                <td><?php echo $b->no_uji; ?></td>
                <td><?php echo $b->no_kendaraan; ?></td>
                <td><?php echo $b->no_chasis; ?></td>
                <td><?php echo $b->no_mesin; ?></td>
                <td><?php echo $b->nama_pemilik; ?></td>
                <td><?php echo $b->sifat; ?></td>
                <td><?php
                    if ($b->verifikasi_rubah_sifat == 1) {
                        echo 'Belum Dibaca';
                    } else if ($b->verifikasi_rubah_sifat == 2) {
                        echo 'Disetujui';
                    } else {
                        echo 'Ditolak';
                    }
                    ?></td>
                <td class="ctr">
                    <div class="btn-group">	
                        <a href="<?php echo base_URL() ?>index.php/rubahsifat/print_kwitansi/<?php echo $b->no_uji; ?>" class="btn btn-info btn-sm" title="Print Kwitansi" target="_blank"><i class="icon-print icon-white" target="_blank"> </i> Kwitansi</a>
                        <a href="<?php echo base_URL() ?>index.php/rubahsifat/view/<?php echo $b->no_uji; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> View</a>
                        <a href="<?php echo base_url() ?>index.php/rubahsifat/print_rubah_sifat/<?php echo $b->no_uji; ?>" title="Print SK" class="btn btn-warning btn-sm" target="_blank"><i class="icon-print icon-white"></i>Print SK</a>
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
