<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Daftar Ijin Operasi Perusahaan</a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                       <ul class="nav navbar-nav">
                            
			</ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>


    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%">Nomor</th>
                 <th width="10%">Nama</th>
                 <th width="10%">NPWP</th>
                <th width="10%">Nama Badan Usaha</th>
                <th width="17%">Alamat</th>
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
                        <td><?php echo $b->nama_pimpinan; ?></td>
                        <td><?php echo $b->npwp; ?></td>
                        <td><?php echo $b->nama_perusahaan ?></td>
                        <td><?php echo $b->alamat_perusahaan; ?></td>
    
                         
                <td class="ctr">
                    <div class="btn-group">
                        <a target="_blank" href="<?php echo base_URL() ?>index.php/ijin_trayek_operasi/cetak_ijin_operasi/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-print icon-white"> </i> Print</a>		
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
