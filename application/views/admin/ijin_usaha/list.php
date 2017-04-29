<div class="clearfix">
    <div class="row">
        <div class="col-lg-12">

            <div class="navbar navbar-inverse">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Ijin Usaha <?php echo $sub_title; ?></a>
                    </div>
                    <div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
                        <ul class="nav navbar-nav">
                            <li><a href="<?php echo site_url("ijin_usaha/".$path."/add"); ?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Data</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <form class="navbar-form navbar-left" method="post" action="<?php echo base_URL(); ?>index.php/ijin_usaha/<?php echo $path; ?>/cari">
                                <input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
                                <button type="submit" class="btn btn-danger"><i class="icon-search icon-white"> </i> Cari</button>
                            </form>
                        </ul>
                    </div><!-- /.nav-collapse -->
                </div><!-- /.container -->
            </div><!-- /.navbar -->

        </div>
    </div>

    <?php echo $this->session->flashdata("message"); ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Nama Perusahaan</th>
                <th width="40%">Tanggal Berlaku</th>
                <th width="20%">Tanggal Berakhir</th>
                <th>Status</th>
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
                <td><?php echo $b->nama_perusahaan; ?></td>
                <td><?php echo $b->tanggal_berlaku; ?></td>
                 <td><?php echo $b->tanggal_berakhir; ?></td>
                 <td><?php echo $b->verifikasi; ?></td>
                <td class="ctr">
                    <div class="btn-group">
                        <a href="<?php echo base_URL() ?>index.php/ijin_usaha/<?php echo $path ?>/edt/<?php echo $b->id_ijin; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>		
                        <a href="<?php echo base_URL() ?>index.php/ijin_usaha/<?php echo $path ?>/del/<?php echo $b->id_ijin; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>	
                        <a href="<?php echo base_URL() ?>index.php/ijin_usaha/cetak_surat_ijin/<?php echo $b->id_ijin; ?>" class="btn btn-info btn-sm" target="_blank" title="Cetak Disposisi"><i class="icon-print icon-white"> </i> Ctk</a>
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
