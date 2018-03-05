<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Verifikasi Ijin Isidentil</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        

                        <ul class="nav navbar-nav navbar-right">
                      
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
                <th width="10%">Kota Tujuan</th>
                <th width="10%">No KP</th>
                <th width="17%">Nama Pemilik</th>
                <th width="10%">Keterangan</th>
                <th width="8%"> Verifikasi</th>
            </tr>
        </thead>

        <tbody>            <?php

            if (empty($data_isidentil)) {
                echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
            } else {
                $no = ($this->uri->segment(4) + 1);
                foreach ($data_isidentil as $b) {
                    
//                    print_r($b);
                    ?>

                    <tr style="background-color: #fff;">
                        <td><center><?php echo $no;  ?></center></td>
                <td><?php echo trim($b->no_uji); ?></td>
                <td><?php echo $b->no_kendaraan; ?></td>
                <td><?php echo $b->kota; ?></td>
                <td><?php echo $b->kp_ijin_trayek; ?></td>
                <td><?php echo $b->nama_pemilik; ?></td>
                <td><?php
                    if ($b->verifikasi == 0) {
                        echo 'Belum Dibaca';
                    } else if ($b->verifikasi == 1) {
                        echo 'Disetujui';
                    } else {
                        echo 'Ditolak';
                    }
                    ?></td>
                <td class="ctr">
                    <div class="btn-group">	
       
                        <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/view_isidentil/<?php echo $b->id_ijin; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Verifikasi</a>
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
    <center><ul class="pagination"><?php echo $pagi_isidentil; ?></ul></center>
</div>
