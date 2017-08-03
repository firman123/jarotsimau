<html>
    <head>
        <style type="text/css" media="print">            
            #kotak {
                background: url(<?php echo base_url(); ?>aset/img/kp_trayek.jpg) no-repeat;
                width: 329px;
                border: solid 1px;
            }

            #title {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 8px;
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;
            }
        </style>

        <style type="text/css" media="screen">            
            #kotak {
                background: url(<?php echo base_url(); ?>aset/img/kp_trayek.jpg) no-repeat;
                width: 329px;
                border: solid 1px;
            }

            #title {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 8px;
                font-style: normal;
                font-weight: bold;
                text-transform: uppercase;
            }
        </style>


    </head>
    <body onload="window.print()">
        <div id="kotak">
            <table style="margin-top: 5px;">
                <tr>
                    <td style="padding-top: 60px; padding-left: 10px; width: 120px;">
                        <div id="title"><b>No Kendaraan</div>

                    </td>
                    <td style="padding-top: 60px;">
                        <div id="title"><b>:</div>
                    </td>
                    <td colspan="2" style="padding-top: 60px;">
                        <div id="title"><b>
                                <?php echo $datpil->no_kendaraan ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 2px; padding-left: 10px;">
                        <div id="title"><b>Nama Pemilik</div>
                    </td>
                    <td style="padding-top: 2px;">
                        <div id="title"><b>:</div>
                    </td>
                    <td colspan="2" style="padding-top: 2px; width: 130px;">
                        <div id="title"><b>
                                <?php echo $datpil->nama_pemilik; ?>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td style="padding-top: 2px; padding-left: 10px;">
                        <div id="title"><b>Nama Perusahaan</div>
                    </td>
                    <td style="padding-top: 2px;">
                        <div id="title"><b>:</div>
                    </td>
                    <td colspan="2" style="padding-top: 2px;">
                        <div id="title"><b>
                                <?php echo $datpil->nama_perusahaan ?>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td colspan="3">

                    </td>
                    <td style="padding-top: 2px; float: right; margin-right: 5px;">
                        <div id="title"><b>
                                <?php if ($path == 'trayek') echo $datpil->kp_ijin_trayek;
                                else echo $datpil->kp_ijin_operasi; ?>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <div id="title" style="font-size: 20px; float: right;"><?php echo $datpil->kd_trayek; ?></div>
                    </td>
                    <td style="padding-top: 2px; float: right;">
                        <div id="title" style="margin-left: 100px;"><b>
                                <img src="<?php echo base_url(); ?>qr.png" style="width: 60px;" />
                        </div>
                    </td>
                </tr>


            </table>
        </div>
    </body>

</html>