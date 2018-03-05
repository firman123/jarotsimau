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
                            <li><a href="<?php echo site_url("ijin_trayek_operasi/daftar_surat_ijin_trayek"); ?>" class="btn-info"><i class="icon-print icon-white"> </i>  Cetak</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <a class="navbar-brand" href="#">Cari Kendaraan</a>
                            <form class="nav navbar-form navbar-left"  method="post" action="<?php echo base_URL(); ?>index.php/ijin_trayek_operasi/ijin_trayek/cari_kendaraan">
                                 <div class="row">
                                    <div class="nav navbar-header navbar-form">
                        
                                        <input type="text" name="no_kendaraan" id="kendaraan" style="width: 150px; margin-right: -20px;" class="form-control" placeholder="No Uji">
                                    </div>
                                    <div class="navbar-header navbar-form">

                                        <select name="id_perusahaan" class="form-control" id="id_perusahaan" style="width: 70%">
                                            <option value="0">Nama Perusahaan</option>
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
                                    </div>
                                </div><!-- /.navbar -->
                            </form>
                        </ul>
                    </div>

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
                        <th width="5%">Nomor</th>
                        <th width="8%">No. KP</th>
                        <th width="15%">No. Kendaraan</th>
                        <th width="20%">Nama Pemilik</th>
                        <th>Nama Perusahaan</th>
                        <th>No. Trayek</th>
                        <th>No. Uji</th>
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
                        
                        <td><?php echo $b->kp_ijin_trayek; ?></td>
                        <td><?php echo $b->no_kendaraan; ?></td>
                        <td><?php echo $b->nama_pemilik; ?></td>
                        <td><?php echo $b->nama_perusahaan; ?></td>
                        <td><?php echo $b->kd_trayek; ?></td>
                        <td><?php echo $b->no_uji; ?></td>

                        <td class="ctr">
                            <div class="btn-group">
                                <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/edt/<?php echo $b->no_uji; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> View</a>		
                                <a href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/ijin_trayek/del/<?php echo $b->no_uji; ?>/<?php echo $b->id_ijin_trayek; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>	
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
