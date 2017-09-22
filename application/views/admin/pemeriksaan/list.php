<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Daftar Pemeriksaan Kendaraan</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
                            <li><a href="<?php echo site_url("pemeriksaan/input/$path"); ?>" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Daftar</a></li>
                            <li><a href="<?php echo site_url("hasil_pemeriksaan/index_$path"); ?>" class="btn-info"><i class="icon-print icon-white"> </i> Cetak</a></li>
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

<?php echo $this->session->flashdata("message");?>
	
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
                        <th>NO. KP</th>
			<th width="10%">Nama Pemilik</th>
			<th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
			<th width="15%">Sifat</th>
                        <th width="10%"></th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (empty($data)) {
			echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
			

		?>
		
			<tr style="background-color: #fff;">
			<td><center><?php echo $no; ?></center></td>
			<td><?php echo $b->no_uji; ?></td>
                        <td><?php echo $b->no_kendaraan; ?></td>
                        <td><?php if($path=='trayek') echo $b->kp_ijin_trayek; else echo $b->kp_ijin_operasi; ?></td>
			<td><?php echo $b->nama_pemilik;?></td>
                        
                        <td><?php echo $b->no_chasis; ?></td>
                        <td><?php echo $b->no_mesin;?></td>
                        <td><?php echo $b->sifat; ?></td>
			<td class="ctr">
				<div class="btn-group">
                                    <a href="<?php echo base_URL()?>index.php/pemeriksaan/act_delete_<?php echo $path; ?>/<?php echo $b->id_pemeriksaan; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>	
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
