
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Informasi Hasil Uji</title>
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="jqwidgets/styles/jqx.base.css" rel="stylesheet">
<!--<link href="jqwidgets/styles/jqx.bootstrap.css" rel="stylesheet"> -->
<link href="jqwidgets/styles/jqx.fresh.css" rel="stylesheet">
<link href="display.css" rel="stylesheet">
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>
<body onload="LoadPage()">
    <div id="wrap">
          <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
             <div><img src="image/logo.png" style="float:left;" height="65px"/></div>
             <div><label style="font-size:18px; color:white; font-weight:bold; margin:5px 20px 0px 20px">DINAS PERHUBUNGAN KOTA BALIKPAPAN</label></div>
             <div><label style="font-size:26px; color:white; font-weight:bold; margin:0px 20px 5px 20px">SISTEM INFORMASI PUBLIK</label></div>
        </div>
      </div>
      <!-- Begin page content -->
      <div class="container">
      <!--  <div class="page-header" align="center"><h3>USERNAME</h3></div>  -->
            <div style="margin-top:60px">
               <?php include("detail_stiker.php"); ?>
            </div>
            <div id="panel"></div>
      </div>
    </div>    
    <MARQUEE bgcolor="yellow" style="font-family: impact; font-size:20px; color:#0000FF" align="center" direction="left" height="30" scrollamount="10" width="100%"> <strong> Pastikan kendaraan anda pada kondisi laik jalan, keselamatan adalah tanggung jawab kita bersama. </strong></marquee>
    <div id="footer">
      <div class="container">
        <p class="text-muted">&copy; Dinas Perhubungan Kota Balikpapan</p>
      </div>
    </div>
</body>
</html>