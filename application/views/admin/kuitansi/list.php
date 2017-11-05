<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Setting Kwitansi</a>
			</div>
		<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
		</div>
		</div>
	</div>
  </div>
</div>

<?php echo $this->session->flashdata("message");?>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th width="5%">No</th>
			<th>Jenis Kuitansi</th>
                        <th>harga</th>
                        <th>Keterangan</th>
                        <th width="20%"></th>
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
                        <td><?php echo $b->jenis; ?></td>
                        <td><?php echo $b->harga;?></td>
                        <td><?php echo $b->keterangan; ?></td>
			<td class="ctr">
				<div class="btn-group">
                                     <a href="<?php echo base_URL() ?>index.php/kuitansi/edit/<?php echo $b->id_kwitansi; ?>" class="btn btn-success btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i> Edt</a>		

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
<center><ul class="pagination"></ul></center>
</div>
