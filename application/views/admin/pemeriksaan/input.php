<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Daftar Pemeriksaan</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

 <?php echo $this->session->flashdata("message"); ?>


    <div class="row-fluid well" style="overflow: hidden">

        <div class="col-lg-6">
            <table  class="table-form">
                 <form action="<?php echo site_url("pemeriksaan/cari_kendaraan"); ?>" method="post" accept-charset="utf-8">

                <tr><td width="20%">No. Kendaraan</td><td><b><input type="text" name="no_kendaraan" required id="kendaraan" style="width: 300px" class="form-control"></b>
                    </td><td><button type=submit class="btn btn-danger" id="search_kendaraan_button"><i class="icon-search icon-white"> </i> Cari</button></td></tr>		
                </form>
                
            </table>
        </div>

        

    </div>
