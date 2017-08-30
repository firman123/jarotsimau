<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Print Pilihan</span>
        </div>

        <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo site_url("hasil_pemeriksaan/index_$path"); ?>" class="btn-info"><i class="icon-edit icon-white"> </i> Kembali</a></li>
            </ul>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<div class="row-fluid well" style="overflow: hidden">

    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <div class="btn-group">
                <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/print_kwitansi_<?php echo $path; ?>/<?php echo $id_pemeriksaan; ?>" target="_blank"class="btn btn-info btn-sm" ><i class="icon-print icon-white">  </i> Print Kwitansi</a>	
                <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/print_kp_<?php echo $path; ?>/<?php echo $id_pemeriksaan; ?>" target="_blank" class="btn btn-success btn-sm"><i class="icon-print icon-white"> </i>Print Kartu Pengawas</a>		
                <a href="<?php echo base_URL() ?>index.php/hasil_pemeriksaan/cetak_stiker_<?php echo $path; ?>/<?php echo $id_pemeriksaan; ?>"  target="_blank" class="btn btn-warning btn-sm"><i class="icon-print icon-white"></i>Print Stiker</a>
            </div>
        </div>
    </div>

</div>


