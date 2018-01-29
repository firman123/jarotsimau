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
                    <?php include 'footer.php';?>
                </td>            
            </tr>
        </table>

    </body>
</html>