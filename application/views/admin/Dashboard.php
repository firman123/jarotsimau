<!DOCTYPE html>
<!-- saved from url=(0029)http://bootswatch.com/amelia/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
        <title>SIMAU BALIKPAPAN</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/bootstrap.css">
          
        <link rel="stylesheet" href="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>aset/css/jquery.autocomplete.css"/>

        <script src="<?php echo base_url(); ?>aset/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>aset/js/bootswatch.js"></script>
        <script src="<?php echo base_url(); ?>aset/js/jquery/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>aset/js/jquery.autocomplete.js"></script>
        <script type="text/javascript">
            // <![CDATA[
            $(document).ready(function() {
                $(function() {
                    $("#perusahaan").autocomplete({
                        source: function(request, response) {
                            $.ajax({
                                url: "<?php echo site_url('master_data/get_perusahaan'); ?>",
                                data: {nama_perusahaan: $("#perusahaan").val()}, //nama_object bebass
                                dataType: "json",
                                type: "POST",
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                    });
                });
                

                var site = "<?php echo site_url(); ?>";
                $(function() {
                    $('#kendaraan').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_kendaraan",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#kendaraan').val('' + suggestion.no_uji);
                        }
                    });
                });

                $(function() {
                    $('#kendaraan_advance').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_kendaraan_advance",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#kendaraan_advance').val('' + suggestion.no_kendaraan);
                            $('#id_kp').val('' + suggestion.id_kp);
                            $('#no_kendaraan').val('' + suggestion.no_kendaraan);
                            $('#masa_berlaku').val('' + suggestion.masa_berlaku); // membuat id 'v_nim' untuk ditampilkan
                            $('#no_trayek').val('' + suggestion.no_trayek); // membuat id 'v_jurusan' untuk ditampilkan
                            $('#nama_pemilik').val('' + suggestion.nama_pemilik);
                            $('#alamat_pemilik').val('' + suggestion.alamat_pemilik);
                            $('#nama_perusahaan').val('' + suggestion.nama_perusahaan);
                            $('#masa_berlaku').val('' + suggestion.masa_berlaku);
                            $('#catatan').val('' + suggestion.catatan == null ? "" : suggestion.catatan);
                            $('#last_update').val('' + suggestion.last_update == null ? "" : suggestion.catatan);
                            $('#post_by').val('' + suggestion.post_by == null ? "" : suggestion.catatan);
                            $('#no_uji').val('' + suggestion.no_uji);
                        }
                    });
                });
                
                $(function() {
                    $('#kendaraan_operasi_advance').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_kendaraan_operasi",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#kendaraan_advance').val('' + suggestion.no_kendaraan);
                            $('#id_kp').val('' + suggestion.id_kp);
                            $('#no_kendaraan').val('' + suggestion.no_kendaraan);
                            $('#masa_berlaku').val('' + suggestion.masa_berlaku); // membuat id 'v_nim' untuk ditampilkan
                           
                            $('#nama_pemilik').val('' + suggestion.nama_pemilik);
                            $('#alamat_pemilik').val('' + suggestion.alamat_pemilik);
                            $('#nama_perusahaan').val('' + suggestion.nama_perusahaan);
                            $('#masa_berlaku').val('' + suggestion.masa_berlaku);
                            $('#catatan').val('' + suggestion.catatan == null ? "" : suggestion.catatan);
                            $('#last_update').val('' + suggestion.last_update == null ? "" : suggestion.catatan);
                            $('#post_by').val('' + suggestion.post_by == null ? "" : suggestion.catatan);
                            $('#no_uji').val('' + suggestion.no_uji);
                        }
                    });
                });

                var site = "<?php echo site_url(); ?>";
                $(function() {
                    $('#perusahaan').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_perusahaan2",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#perusahaan').val('' + suggestion.id);
                            $('#nama_perusahaan').val('' + suggestion.nama_perusahaan); // membuat id 'v_nim' untuk ditampilkan
                            $('#alamat_perusahaan').val('' + suggestion.alamat_perusahaan); // membuat id 'v_jurusan' untuk ditampilkan
                        }
                    });
                });
                
                 var site = "<?php echo site_url(); ?>";
                $(function() {
                    $('#barang').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_perusahaan/Barang",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#barang').val('' + suggestion.id);
                            $('#nama_perusahaan').val('' + suggestion.nama_perusahaan); // membuat id 'v_nim' untuk ditampilkan
                            $('#alamat_perusahaan').val('' + suggestion.alamat_perusahaan); // membuat id 'v_jurusan' untuk ditampilkan
                        }
                    });
                });
                
                var site = "<?php echo site_url(); ?>";
                $(function() {
                    $('#penumpang').autocomplete({
                        // serviceUrl berisi URL ke controller/fungsi yang menangani request kita
                        serviceUrl: site + "/ijin_trayek_operasi/cari_perusahaan/Penumpang",
                        // fungsi ini akan dijalankan ketika user memilih salah satu hasil request
                        onSelect: function(suggestion) {
                            $('#penumpang').val('' + suggestion.id);
                            $('#nama_perusahaan').val('' + suggestion.nama_perusahaan); // membuat id 'v_nim' untuk ditampilkan
                            $('#alamat_perusahaan').val('' + suggestion.alamat_perusahaan); // membuat id 'v_jurusan' untuk ditampilkan
                        }
                    });
                });


                $(function() {
                    $("#tanggal_berlaku").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd'
                    });
                });

                $(function() {
                    $("#tanggal_berakhir").datepicker({
                        changeMonth: true,
                        changeYear: true,
                        dateFormat: 'yy-mm-dd'
                    });
                });


            });
            // ]]>
        </script>


    </head>

    <body style="">
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand"><strong style="font-family: verdana;">SIMAU - BALIKPAPAN</strong></span>
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse" id="navbar-main">
                    <ul class="nav navbar-nav">	
                        <li><a href="<?php echo base_url(); ?>"><i class="icon-home icon-white"> </i> Beranda</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-th-list icon-white"> </i> Master Data <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
<!--<a href="<?php echo site_url('welcome/menu1') ?>">menu1</a>-->
                                <li><a tabindex="-1" href="<?php echo site_url('master_data/kendaraan') ?>">Kendaraan</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('master_data/perusahaan') ?>">Perusahaan</a></li>
                                
                                <li><a tabindex="-1" href="<?php echo site_url('master_data/trayek') ?>">Trayek</a></li>
                                
                            </ul>
                        </li> 
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-th-list icon-white"> </i>Perizinan<span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                                <li><a tabindex="-1" href="<?php echo site_url('ijin_usaha/angkutan_barang') ?>">Angkutan Barang</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('ijin_usaha/angkutan_penumpang') ?>">Angkutan Penumpang</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('ijin_trayek_operasi/ijin_trayek') ?>">Ijin Trayek</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('ijin_trayek_operasi/ijin_operasi') ?>">Ijin Operasi</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('kartu_pengawasan/trayek') ?>">Kartu Pengawasan Trayek</a></li>
                                <li><a tabindex="-1" href="<?php echo site_url('kartu_pengawasan/operasi') ?>">Kartu Pengawasan Operasi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-th-list icon-white"> </i>Verifikasi<span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                                <li><a href="<?php echo site_url('ijin_usaha/angkutan_barang') ?>">Ijin Angkutan Barang</a></li>

                                <li><a tabindex="-1" href="<?php echo site_url('ijin_usaha/angkutan_penumpang') ?>">Angkutan Penumpang</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">

                            <?php
                            if ($this->session->userdata('admin_level') == "Super Admin") {
                                ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-wrench icon-white"> </i> Pengaturan <span class="caret"></span></a>
                                <ul class="dropdown-menu" aria-labelledby="themes">
                                    <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/pengguna">Instansi Pengguna</a></li>
                                    <li><a tabindex="-1" href="<?php echo base_url(); ?>admin/manage_admin">Manajemen Admin</a></li>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes"><i class="icon-user icon-white"></i> Administrator <span class="caret"></span></a>
                            <ul class="dropdown-menu" aria-labelledby="themes">
                                <!--<li><a tabindex="-1" href="<?php echo base_url(); ?>admin/passwod">Rubah Password</a></li>-->
                                <li><a tabindex="-1" href="<?php echo base_url(); ?>index.php/admin/logout">Logout</a></li>

                            </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <?php
        $q_instansi = $this->db->query("SELECT * FROM tbl_instansi LIMIT 1")->row();
        echo $this->session->userdata('admin_level');
        ?>
        <div class="container">

            <div class="page-header" id="banner">
                <div class="row">
                    <div class="" style="padding: 15px 15px 0 15px;">
                        <div class="well well-sm">
                            <img src="<?php echo base_url(); ?>upload/<?php echo $q_instansi->logo; ?>" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 100px; height: 100px">
                            <h2 style="margin: 15px 0 10px 0; color: #000;"><?php echo $q_instansi->nama; ?></h2>
                            <div style="color: #000; font-size: 16px; font-family: Tahoma" class="clearfix"><b>Alamat : <?php echo $q_instansi->alamat; ?></b></div>
                        </div>
                    </div>
                </div>
            </div>

            <?php $this->load->view('admin/' . $page); ?>

            <div class="span12 well well-sm">
                <h4 style="font-weight: bold">SISTEM INFORMASI MANAJEMEN ANGKUTAN </a></h4>
                <h6>&copy;  2016. Waktu Eksekusi : {elapsed_time}, Penggunaan Memori : {memory_usage}</h6>
            </div>

        </div>


    </body></html>