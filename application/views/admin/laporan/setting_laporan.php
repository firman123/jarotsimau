<div class="navbar navbar-inverse" style="position: static;">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Cetak Laporan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->


<?php echo $this->session->flashdata("message"); ?>

<?php echo $this->session->flashdata("message_cari"); ?>
<div class="row-fluid well" style="overflow: hidden">
    
     <div class="col-lg-12">
         <div class="row">
             <div class="col-lg-6">
                 <table  class="table-form">
<!--                <tr><td width="20%">No. Ijin Trayek</td><td><b>-->
            <h5><b>Rekap Harian</b> </h5>
            <form action="<?php echo site_url("laporan/cetak_laporan_harian"); ?>" method="post" accept-charset="utf-8">

                <tr style="width: 100%;">
                    <td style="width: 10%">Pilih Tanggal</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_report" required value="" id="tanggal_report" style="width: 200px;" class="form-control"></b></td>
                   
                    <td style="width: 10%"><button type=submit class="btn btn-success" id="search_kendaraan_button" style="margin-left: -50px;"><i class="icon-print icon-white"> </i> Print</button></td>
                </tr>		
            </form>


        </table>
             </div>
         </div>
        
    </div>

    <div class="col-lg-12"  style="margin-top: 40px">
        <table  class="table-form">
<!--                <tr><td width="20%">No. Ijin Trayek</td><td><b>-->
            <h5><b>Laporan Kegiatan</b> </h5>
            <form action="<?php echo site_url("laporan/cetak_laporan_layanan"); ?>" method="post" accept-charset="utf-8">

                <tr style="width: 100%;">
                    <td style="width: 10%">Tanggal Awal</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_awal" required value="" id="tanggal_awal" style="width: 200px;" class="form-control"></b></td>
                    <td style="width: 10%">Tanggal Akhir</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_akhir" required value="" id="tanggal_akhir" style="width: 200px" class="form-control"></b></td>

                    <td style="width: 10%"><button type=submit class="btn btn-success" id="search_kendaraan_button" style="margin-left: -50px;"><i class="icon-print icon-white"> </i> Print</button></td>
                </tr>		
            </form>


        </table>
    </div>

    <div class="col-lg-12" style="margin-top: 40px">
        <table  class="table-form">
<!--                <tr><td width="20%">No. Ijin Trayek</td><td><b>-->
            <h5><b>Laporan Jumlah Angkot Yang Melakukan Perpanjangan KP Trayek</b> </h5>
            <form action="<?php echo site_url("laporan/cetak_laporan_angkutan"); ?>" method="post" accept-charset="utf-8">

                <tr style="width: 100%;">
                    <td style="width: 10%">Tanggal Awal</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_awal" required value="" id="angkot_tanggal_awal" style="width: 200px;" class="form-control"></b></td>
                    <td style="width: 10%">Tanggal Akhir</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_akhir" required value="" id="angkot_tanggal_akhir" style="width: 200px" class="form-control"></b></td>

                    <td style="width: 10%"><button type=submit class="btn btn-success" id="search_kendaraan_button" style="margin-left: -50px;"><i class="icon-print icon-white"> </i> Print</button></td>
                </tr>		
            </form>


        </table>
    </div>

    <div class="col-lg-12" style="margin-top: 40px">
        <table  class="table-form">
<!--                <tr><td width="20%">No. Ijin Trayek</td><td><b>-->
            <h5><b>Laporan Jumlah Perusahaan Yang Melakukan Perpanjangan KP Trayek </b> </h5>
            <form action="<?php echo site_url("laporan/cetak_laporan_perpanjangan_kp"); ?>" method="post" accept-charset="utf-8">

                <tr style="width: 100%;">
                    <td style="width: 10%">Tanggal Awal</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_awal" required value="" id="perusahaan_tanggal_awal" style="width: 200px;" class="form-control"></b></td>
                    <td style="width: 10%">Tanggal Akhir</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_akhir" required value="" id="perusahaan_tanggal_akhir" style="width: 200px" class="form-control"></b></td>

                    <td style="width: 10%"><button type=submit class="btn btn-success" id="search_kendaraan_button" style="margin-left: -50px;"><i class="icon-print icon-white"> </i> Print</button></td>
                </tr>		
            </form>


        </table>
    </div>

    <div class="col-lg-12" style="margin-top: 40px">
        <table  class="table-form">
<!--                <tr><td width="20%">No. Ijin Trayek</td><td><b>-->
            <h5><b>Laporan PAD</b> </h5>
            <form action="<?php echo site_url("laporan/cetak_laporan_pad"); ?>" method="post" accept-charset="utf-8">

                <tr style="width: 100%;">
                    <td style="width: 10%">Tanggal Awal</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_awal" required value="" id="pad_tanggal_awal" style="width: 200px;" class="form-control"></b></td>
                    <td style="width: 10%">Tanggal Akhir</td>
                    <td style="width: 20%"><b><input type="text" name="tanggal_akhir" required value="" id="pad_tanggal_akhir" style="width: 200px" class="form-control"></b></td>

                    <td style="width: 10%"><button type=submit class="btn btn-success" id="search_kendaraan_button" style="margin-left: -50px;"><i class="icon-print icon-white"> </i> Print</button></td>
                </tr>		
            </form>


        </table>
    </div>

    <div class="col-lg-6">
        <table  class="table-form">

        </table>
    </div>


</div>

</form>
