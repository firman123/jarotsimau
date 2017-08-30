<htm>
    <head>
        <style type="text/css" media="print">
            @page
            {
                size: 11cm 11cm;
                margin-left: -0.2cm;
                margin-top: -0.2cm;
                margin-right: 0cm;
                margin-bottom: 0cm;
            }

            #kotak {
                width:9.5cm;
                height:9.5cm;
            }  

            table, tr, td {
            }

            .text_terbalik {
                -webkit-transform: rotate(180deg);
                -moz-transform: rotate(180deg);
                writing-mode: lr-tb;

            }

            .font_setting {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-style: normal;
                font-weight: bold; 
            }

            .font_header {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-style: normal;
                text-align: center;
                width: 100%; 
                text-transform: uppercase;
            }

            .text_padding {
                padding: 10px;
            }

            .text_bold {
                font-weight: bold
            }
        </style>

<!--        <style type="text/css" media="screen">
    #kotak {
        width:378px;
        height:766px;
    }  

    table, tr, td {
        width: 100%;
        border: 1px solid black;
        border-spacing: 0px;
    }

    .text_terbalik {
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg);
        writing-mode: lr-tb;

    }

    .font_setting {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        font-weight: bold; 
    }

    .font_header {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        font-style: normal;
        text-align: center;
        width: 100%; 
        text-transform: uppercase;
    }

    .text_padding {
        padding: 10px;
    }

    .text_bold {
        font-weight: bold
    }
</style>-->

    </head>
    <body onload="window.print()">
        <table style="width: 10.5cm; height: 10.5cm; margin-left: 0cm; margin-right: 0cm; margin-top: 0cm; margin-bottom: 0cm;">
            <tr>
                <td colspan="2">
                    <div style="height: 1.5cm;">
                        <!--                            <div style="width: 15%; height: 100%;float: left;text-align: center;">
                                                        <img src="<?php echo base_url(); ?>aset/img/logo_dishub.png" style="width: 40px; padding-top: 5px;" />
                                                    </div>
                                                    <div style="width: 70%; height: 100%; float: left;">     
                                                        <table style="height: 100%; border: 0px;">
                                                            <tr style="border: 0px;">
                                                                <td class=" font_header" style="height: 50%; border: 0px; vertical-align: top;">Kartu Pengewasan Izin Trayek</td>
                                                            </tr>
                                                            <tr style="border: 0px;">
                                                                <td class="font_header" style="heigh: 50%; font-weight: bold; border: 0px; vertical-align: bottom;">Dinas Perhubungan Kota Balikpapan</td>
                                                            </tr>
                                                        </table>
                        
                                                    </div>
                                                    <div style="width: 15%; height: 100%; float: right; text-align: center;">
                                                        <img src="<?php echo base_url(); ?>aset/img/logo_balikpapan.png" style="width: 40px; padding-top:  5px;" />
                                                    </div>-->
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="height: 1.5cm;">
                    <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%; padding-top: 0.1cm;"><br><?php echo $datpil->kp_ijin_operasi; ?></div>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%; padding-top: 0.1cm;"><br><?php echo $date_manipulation->get_full_date($datpil->masa_berlaku_kp); ?></div>
                </td>
            </tr>

            <tr>
                <td  style="width: 60%;">
                    <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%; padding-top: 0.1cm;"><br><?php echo $datpil->no_kendaraan; ?></div>
                </td>
                <td rowspan="3" style="width: 40%; float: right;">
                    <img src="<?php echo base_url(); ?>qr.png" style="width: 150px;" />
                </td>
            </tr>


            <tr style="border-left: 0px; border-right: 0px;">
                <td rowspan="2"  style="width: 60%; vertical-align: top; padding-top: 0.1cm;">
                    <div class="font_setting text_padding"><br><?php echo $datpil->no_uji; ?></div>
                </td>
            </tr>
            <tr></tr>


        </table>
        <!--        <div id="kotak">
                    <table style="height: 50%;">
                        <tr style="border-left: 0px; border-right: 0px;">
                            <td rowspan="3" style="width: 40%; border-spacing: 0px;" class="text_terbalik">
                                <img src="<?php echo base_url(); ?>qr.png" style="width: 150px; margin: auto;" />
                            </td>
                            <td rowspan="2" style="width: 60%; vertical-align: bottom;">
                                <div class="text_terbalik font_setting text_padding">Kode Trayek :</div>
                            </td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                            <td>
                                <div class="text_terbalik font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Nomor Kendaraan : <?php echo $datpil->no_kendaraan; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="text_terbalik font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Masa Berlaku : <?php echo $date_manipulation->get_full_date($datpil->masa_berlaku_kp); ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="text_terbalik font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Nomor Kartu Pengawasan : <?php echo $datpil->kp_ijin_operasi; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div style="width: 100%; height: 70%; vertical-align: bottom;">
                                    <div class="text_terbalik" style="width: 15%; height: 100%;float: left;text-align: center;">
                                        <img src="<?php echo base_url(); ?>aset/img/logo_dishub.png" style="width: 40px; padding-top: 5px;" />
                                    </div>
                                    <div style="width: 70%; height: 100%; float: left;">     
                                        <table style="height: 100%; border: 0px;">
                                            <tr style="border: 0px;">
                                                <td class=" font_header text_terbalik" style="height: 50%; border: 0px; vertical-align: top;">Kartu Pengewasan Izin Operasi</td>
                                            </tr>
                                            <tr style="border: 0px;">
                                                <td class="font_header text_terbalik" style="heigh: 50%; font-weight: bold; border: 0px; vertical-align: bottom;">Dinas Perhubungan Kota Balikpapan</td>
                                            </tr>
                                        </table>
        
                                    </div>
                                    <div class="text_terbalik" style="width: 15%; height: 100%; float: right; text-align: center;">
                                        <img src="<?php echo base_url(); ?>aset/img/logo_balikpapan.png" style="width: 40px; padding-top:  5px;" />
                                    </div>
                                </div>
                            </td>
                        </tr>
        
                    </table>
        
                    <table style="height: 50%; margin-top: 20px;">
                        <tr>
                            <td colspan="2">
                                <div style="width: 100%; height: 70%; vertical-align: bottom;">
                                    <div style="width: 15%; height: 100%;float: left;text-align: center;">
                                        <img src="<?php echo base_url(); ?>aset/img/logo_dishub.png" style="width: 40px; padding-top: 5px;" />
                                    </div>
                                    <div style="width: 70%; height: 100%; float: left;">     
                                        <table style="height: 100%; border: 0px;">
                                            <tr style="border: 0px;">
                                                <td class=" font_header" style="height: 50%; border: 0px; vertical-align: top;">Kartu Pengewasan Izin Operasi</td>
                                            </tr>
                                            <tr style="border: 0px;">
                                                <td class="font_header" style="heigh: 50%; font-weight: bold; border: 0px; vertical-align: bottom;">Dinas Perhubungan Kota Balikpapan</td>
                                            </tr>
                                        </table>
        
                                    </div>
                                    <div style="width: 15%; height: 100%; float: right; text-align: center;">
                                        <img src="<?php echo base_url(); ?>aset/img/logo_balikpapan.png" style="width: 40px; padding-top:  5px;" />
                                    </div>
                                </div>
                            </td>
                        </tr>
        
                        <tr>
                            <td colspan="2">
                                <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Nomor Kartu Pengawasan : <?php echo $datpil->kp_ijin_operasi; ?></div>
                            </td>
                        </tr>
        
                        <tr>
                            <td colspan="2">
                                <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Masa Berlaku : <?php echo $date_manipulation->get_full_date($datpil->masa_berlaku_kp); ?></div>
                            </td>
                        </tr>
        
                        <tr>
                            <td  style="width: 60%;">
                                <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%;">Nomor Kendaraan : <?php echo $datpil->no_kendaraan; ?></div>
                            </td>
                            <td rowspan="3" style="width: 40%;">
                                <img src="<?php echo base_url(); ?>qr.png" style="width: 150px; margin: auto;" />
                            </td>
                        </tr>
        
        
                        <tr style="border-left: 0px; border-right: 0px;">
                            <td rowspan="2"  style="width: 60%; vertical-align: top;">
                                <div class="font_setting text_padding">Kode Trayek :</div>
                            </td>
        
        
                        </tr>
                        <tr></tr>
        
        
                    </table>
                </div>-->
    </body>
</htm>