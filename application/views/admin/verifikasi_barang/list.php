<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Verifikasi Peremajaan</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
                           
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
                        <th width="10%">Nomor KP</th>
			<th width="10%">Nomor Kendaraan Lama</th>
                        <th width="10%">Nomor Kendaraan Baru</th>
                        <th width="10%"></th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
		if (empty($peremajaan)) {
			echo "<tr><td colspan='9'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($peremajaan as $b) {
			

		?>
		
			<tr style="background-color: #fff;">
			<td><center><?php echo $no; ?></center></td>
			<td><?php echo $b->kp_ijin_trayek; ?></td>
                        <td><?php echo $b->no_kendaraan_lama; ?></td>
                        <td><?php echo $b->no_kendaraan_baru; ?></td>
			<td class="ctr">
				<div class="btn-group">
                                    <a href="<?php echo base_URL()?>index.php/verifikasi_barang/detail_verifikasi/<?php echo $b->id_peremajaan; ?>" class="btn btn-success btn-sm" title="Verifikasi"><i class="icon-trash icon-edit">  </i> Verfikasi</a>
                                    <!--<a href="<?php echo base_URL()?>index.php/verifikasi_barang/act_delete/<?php echo $b->id_peremajaan; ?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="icon-trash icon-remove">  </i> Del</a>-->	
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
</div>
