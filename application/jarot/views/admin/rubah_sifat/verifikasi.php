<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Rubah Sifat Kendaraan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<?php echo $this->session->flashdata("message"); ?>

<div class="row-fluid well" style="overflow: hidden">

    <div class="col-lg-12">
        <table  class="table-form">
            <!--<tr><td width="20%">No. Ijin Operasi</td><td><b>-->
            <form action="<?php echo site_url("rubahsifat/verifikasi_act"); ?>" method="post" accept-charset="utf-8">
                <!--</b></td></tr>-->

                <tr><td width="20%">Id. Kendaraan</td><td><b><input type="text" name="id_kendaraan" required value="<?php echo $kendaraan['no_uji']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text"  required value="<?php echo $kendaraan['no_kendaraan']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">No. Mesin</td><td><b><input type="text"  required value="<?php echo $kendaraan['no_mesin']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">No. Rangka</td><td><b><input type="text" required value="<?php echo $kendaraan['no_chasis']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">Nama Pemilik</td><td><b><input type="text" required value="<?php echo $kendaraan['nama_pemilik']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">Nama Perusahaan</td><td><b><input type="text"  required value="<?php echo $kendaraan['nama_perusahaan']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">Sifat</td><td><b><input type="text"  required value="<?php echo $kendaraan['sifat']; ?>" id="kendaraan" style="width: 300px" class="form-control" readonly=""></b>
                    </td></tr>	
                <tr><td width="20%">Verifikasi</td><td><b>
                            <select name="verifikasi" class="form-control" required style="width: 40%">
                                <option></option>
                                <?php
                                foreach ($value_validasi as $value) {
                                    ?>
                                <option value="<?php echo $value; ?>"><?php if($value==2) echo 'Setuju'; else echo 'Tidak Setuju';?></option>
                                    <!--echo '<option value='.$value.' if('.$value.'=='.$sifat_select.'){selected="selected">}'.$value.'</option>';-->
                                    <?php
                                }
                                ?>
                            </select>
                        </b></td></tr>
                <tr>
                    <td colspan="2">
                        <div id="nama_perusahaan"> 
                    </td>
                </tr>


                <tr><td width="20%"></td><td style="width: 400px"><b></b></td></tr>
                <tr><td width="20%"></td><td style="width: 400px"><b></b></td></tr>

                <tr><td colspan="2">
                        <br><button type="submit" class="btn btn-success">Simpan</button>
                        <a href="<?php echo base_URL(); ?>index.php/rubahsifat" class="btn btn-primary">Kembali</a>
                    </td></tr>
        </table>
    </div>

</form> 

</div>


