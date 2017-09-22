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

    </head>
    <body onload="window.print()">

        <table style="width: 10.5cm; height:10.5cm; margin-left: 0cm; margin-right: 0cm; margin-top: 0cm; margin-bottom: 0cm;">
            <tr>
                <td colspan="2">
                    <div style="height: 3cm;">
                    </div>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="height: 1.5cm;">
                    <div class="font_setting text_padding" style=" vertical-align: bottom; height: 100%; padding-top: 0.1cm;"><br><?php echo $datpil->kp_ijin_trayek; ?></div>
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
                    <div class="font_setting text_padding"><br><?php echo $datpil->kd_trayek; ?></div>
                </td>


            </tr>
            <tr></tr>


        </table>
    </body>
</htm>