<html>
    <head>
        <style type="text/css" media="print">
            #kotak {
                background: url(<?php echo base_url(); ?>aset/img/kartu_pengemudi.jpg) no-repeat;
                width: 209px;
                border: solid 1px;
            }



            #poto {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
            }

            #title {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                font-style: normal;
                font-weight: bold;
                text-align: center;
                margin-top: 10px;
                margin-left: 10px;
                margin-right: 10px;
            }

            #title_kiri {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10px;
                font-style: normal;
                font-weight: bold;
                text-align: left;
                margin-top: 5px;
                margin-left: 10px;
                margin-right: 10px;
            }

            #qrcode {
                float: left;
                margin-left: 10px;
                margin-top: 5px;
            }

            #trayek {
               font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                font-style: normal;
                color: #fff;
                font-weight: bold;
                text-align: right;
                margin-right:5px;
                margin-bottom:5px;
            }



        </style>

        <style type="text/css" media="screen">
             #kotak {
                background: url(<?php echo base_url(); ?>aset/img/kartu_pengemudi.jpg) no-repeat;
                width: 209px;
                border: solid 1px;
            }



            #poto {
                text-align: center;
                margin-left: auto;
                margin-right: auto;
                margin-top: 50px;
            }

            #title {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 15px;
                font-style: normal;
                font-weight: bold;
                text-align: center;
                margin-top: 10px;
                margin-left: 10px;
                margin-right: 10px;
            }

            #title_kiri {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10px;
                font-style: normal;
                font-weight: bold;
                text-align: left;
                margin-top: 5px;
                margin-left: 10px;
                margin-right: 10px;
            }

            #qrcode {
                float: left;
                margin-left: 10px;
                margin-top: 5px;
            }

            #trayek {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 10px;
                font-style: normal;
                color: #fff;
                font-weight: bold;
                text-align: right;
                margin-right: 10px;
            }



        </style>
    </head>
    <body onload="window.print()">
        <div id="kotak">
            <div id="poto">
                <img src="<?php if(empty($datpil->foto)) { echo base_url();?>upload/nopoto.jpg; <?php } else { echo base_url(); ?>upload/kartu_pengawas/<?php echo $datpil->foto; }?>" style="height: 100px;" />
            </div>
            <div id="title">
                <?php echo $datpil->nama_pengemudi; ?>
            </div>
            <div id="title_kiri" style="margin-top: 10px;"><?php echo $datpil->no_kendaraan; ?></div>
            <div id="title_kiri"><?php echo $datpil->nama_perusahaan; ?></div>
            <div id="qrcode" style="width: 100%;">
                <img src="<?php echo base_url(); ?>qr.png" style="width: 60px; margin: auto;" />
            </div>
            <div id="trayek">
                
                <?php if(empty($datpil->kd_trayek)) { echo "0"; } else {echo $datpil->kd_trayek;}?>
            </div>
        </div>
    </body>
</html>