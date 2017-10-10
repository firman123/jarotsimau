<table>
    <tr>
        <td>
            <table style="width: 90%; margin-top: -20px" align="center">
                <tr>
                    <td style="text-align: center; width: 100%; font-size: 20px;"><u><b>IZIN USAHA ANGKUTAN UMUM</b></u></td>
    </tr>
    <tr>
        <td style="text-align: center; padding-top: 0px; margin-top: 0px;">Nomor : 551.207/<?php echo $datpil->nomor_surat; ?>/<?php echo date("Y"); ?></td>
    </tr>
</table>
</td>
</tr>

<tr>
    <td>
        <?php include 'body_memperhatikan.php' ?>
    </td>
</tr>
<tr>
    <td>
        <?php include 'body_mengingat.php' ?>
    </td>
</tr>
<tr>
    <td style="width: 90%" align="center">
        <?php include 'body_memberikan.php' ?>
    </td>
</tr>
<tr>
    <td>
        <br>
        <table style="width: 90%; vertical-align: top;" align="center">
            <tr>
                <td>4. </td>
                <td>Izin Usaha ini berlaku dari tanggal <?php echo $date_manipulation->get_full_date($datpil->tanggal_berlaku); ?> sampai dengan tanggal <?php echo $date_manipulation->get_full_date($datpil->tanggal_berakhir); ?> <br><br></td>
            </tr>
            <tr>
            <br>
                <td style="width: 5%;">5. </td>
                <td style="width: 95%;">Ketentuan yang harus diperhatikan dan ditaati oleh pemegang izin, adalah sebagaimana tersebut pada <br>halaman belakang Izin Usaha Angkutan Umum ini. <br>
                    <br>Demikian izin usaha ini dikeluarkan untuk dipergunakan sebagaimana mestinya</td>
            </tr>
        </table>

    </td>
</tr>
<tr>
    <td>
        <?php include 'body_tandatangan.php'; ?>
    </td>
</tr>

</table>

<p style="padding-left: 40px">
<u><b>Tembusan</b></u>
<ol>
    <li>
        Dinas Perhubungan Kota Balikpapan
    </li>
    <li>
        Dinas Pendapatan Daerah Kota Balikpapan
    </li>
    <li>
        Kabag. Perekonomian Sekertariat Daerah Kota Balikpapan
    </li>
</ol>
</p>
