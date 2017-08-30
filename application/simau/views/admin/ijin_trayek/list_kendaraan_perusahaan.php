<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Data Kendaraan Perusahaan Yang Dipilih</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">

                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <a class="navbar-brand" href="#">Cari Kendaraan</a>
                            <form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_trayek/cari_kendaraan">
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
                <th width="10%">Nomor Uji</th>
                <th width="10%">Nomor Kendaraan</th>
                <th width="10%">Nama Pemilik</th>
                <th>Alamat</th>
                <th>Nomor Rangka</th>
                <th>Nomor Mesin</th>
                <th width="15%">Sifat</th>
                <th width="10%"></th>
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
                <td><?php echo $b->no_kendaraan; ?></td>
                <td><?php echo $b->nama_pemilik; ?></td>
                <td><?php echo $b->alamat; ?></td>
                <td><?php echo $b->no_chasis; ?></td>
                <td><?php echo $b->no_mesin; ?></td>
                <td><?php echo $b->sifat; ?></td>
                <td class="ctr">
                    <div class="btn-group">
                        <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/del_kendaraan/<?php echo $b->no_uji; ?>/<?php echo trim($b->id_ijin_trayek); ?>/<?php echo $b->id_perusahaan; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Anda Yakin..?')" title="Del Data"><i class="icon-trash icon-remove"> </i> Del</a>		
                    </div>	

                </td>
                </tr>
        <?php
        $no++;
    }
}
?>
        <tr>
            <td colspan="8"></td>
            <td class="ctr">
                <div class="btn-group">
                    <a href="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_trayek" class="btn btn-primary">Kembali</a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>
