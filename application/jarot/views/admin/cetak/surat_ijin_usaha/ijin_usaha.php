<?php

$pimpinan = $datpil->nama_pimpinan;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Report Table</title>
        <style type="text/css">
            #outtable{
                border:1px solid #000;
                width:100%;
                border-radius: 0px;
            }



            table{
                border: 0px;
                font-family: arial;
                color:#000;
            }




            table, td, th {
                border:0px;
            }

            table, tr {
                padding: 5px;
            }

            u {
                text-decoration: underline;
                padding-bottom: 0px;
                margin-bottom: 0px;
            }


        </style>
    </head>
    <body>
        <table align="center">
            <tr>
                <td style="border-left: 1px solid black; border-right: 1px solid black; border-top: 1px solid black;">
                    <?php include 'header.php' ?>
                </td>
            </tr>
            <tr>
                <td style="border-left: 1px solid black; border-right: 1px solid black;">
                    <?php include 'body.php' ?>
                </td>
            </tr>
            <tr>
                <td style="border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">

                </td>            
            </tr>
        </table>








<!--        <table>
      <tr>
          <td colspan="3">
              sdfdsfsdf
          </td>
      </tr>



      <tr>
          <td style="width: 20%;">
              hhh
          </td>

          <td style="width: 60%; text-align:center;">
              <h4><b>WALIKOTA BALIKPAPAN</b></h4>
          </td>

          <td style="width: 20%;">
              Kode Pos 76100
          </td>
      </tr>
  </table>-->
    </body>
</html>

<!--<!DOCTYPE html>
<html>
    <head>
        <title>Report Table</title>
        <style type="text/css">
            #outtable{
                padding: 20px;
                border:1px solid #e3e3e3;
                width:100%;
                border-radius: 5px;
            }

            .short{
                width: 10%;
            }

            .normal{
                width: 20%;
            }

            table{
                border-collapse: collapse;
                font-family: arial;
                color:#5E5B5C;
                border:1px solid #e3e3e3;
            }

            thead th{
                border:1px solid #e3e3e3;
                text-align: left;
                padding: 10px;
            }

            tbody td{
                border-top: 1px solid #e3e3e3;
                padding: 10px;
            }

            tbody tr:nth-child(even){
                background: #F6F5FA;
            }

            tbody tr:hover{
                background: #EAE9F5
            }

            table, td, th, tr {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div id="outtable">
            <table>
                <thead>
                    <tr>
                        <th colspan="4">
                <table>
                    <tr>
                        <td colspan="3" style="width: 100%;">
                            sdfdsfsdf
                        </td>
                    </tr>



                    <tr>
                        <td style="width: 20%;">
                            hhh
                        </td>

                        <td style="width: 60%;">
                            <h3><b>WALIKOTA BALIKPAPAN</b></h3>
                        </td>

                        <td style="width: 20%;">
                            Kode Pos 76100
                        </td>
                    </tr>
                </table>
                </th>
                </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>hhj</td>
                        <td>iuhihuihui</td>
                        <td>hohoioih</td>
                        <td>hiuhuihuihi</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </body>
</html>-->