<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Hasil Pemeriksaan Kendaraan</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <!--<li><a href="<?php echo site_url("pemeriksaan/input_checklist/$path"); ?>" class="btn-info"><i class="icon-backward icon-white"> </i> Kembali</a></li>-->

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
                <th width="10%">No. KP Trayek</th>
                <th width="10%">No. KP Operasi</th>
                <th width="10%">No. Kendaraan</th>
                <th width="5%">No. Trayek</th>
                <th  width="15%">No.Chasis</th>
                <th  width="15%">No.Mesin</th>
                <th>Verifikasi</th>
                <th width="20%"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (empty($data)) {
                echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
            } else {
                $no = ($this->uri->segment(4) + 1);
                foreach ($data as $b) {
                    if ($b->status_verifikasi != 1) {
                        ?>

                        <tr style="background-color: #fff;">
                            <td><center><?php echo $no; ?></center></td>
                    <td><?php echo $b->kp_ijin_trayek; ?></td>
                    <td><?php echo $b->kp_ijin_operasi; ?></td>
                    <td><?php echo $b->no_kendaraan; ?></td>
                    <?php if ($path == 'trayek') echo '<td>' . $b->kd_trayek . '</td>'; ?>

                    <td><?php echo $b->no_chasis; ?></td>
                    <td><?php echo $b->no_mesin; ?></td>
                    <th><?php if ($b->status_verifikasi == 1) echo 'Setuju'; else if ($b->status_verifikasi == 2) echo 'Tidak Setuju';
            else echo 'Belum Diverifikasi'; ?></th>
                    <td class="ctr">
                        <div class="btn-group">
                            <!--<a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/view_print_<?php echo $path; ?>/<?php echo $b->id_checklist; ?>" class="btn btn-info btn-sm"><i class="icon-print icon-white">  </i> Print</a>-->	
                            <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/view_<?php echo $path; ?>/<?php echo $b->id_checklist; ?>" class="btn btn-success btn-sm" title="View"><i class="icon-edit icon-white"> </i> View</a>		
                            <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/del_<?php echo $path; ?>/<?php echo $b->id_checklist; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>	
                        </div>	

                    </td>

                    </tr>
                    <?php
                    $no++;
                }
            }
        }
        ?>
        </tbody>
    </table>
    <center><ul class="pagination"><?php echo $pagi; ?></ul></center>
</div>
