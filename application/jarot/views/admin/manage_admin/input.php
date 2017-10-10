<?php
$mode = $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
    $act = "act_edt";
    $id_user = $datpil->user_name;
    $username = $datpil->user_name;
    $password = $datpil->user_pass;
    $nama = '';
    $nip = '';
    $level = $datpil->otoritas;
} else {
    $act = "act_add";
    $id_user = "";
    $username = "";
    $password = "";
    $nama = "";
    $nip = "";
    $level = "";
}
?>
<div class="navbar navbar-inverse">
    <div class="container" style="z-index: 0">
        <div class="navbar-header">
            <span class="navbar-brand" href="#">Manage Admin</span>
        </div>
    </div><!-- /.container -->
</div><!-- /.navbar -->

<form action="<?php echo site_url("admin/manage_admin/".$act); ?>" method="post" accept-charset="utf-8">

    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">

    <div class="row-fluid well" style="overflow: hidden">
        <div class="row">
        <div class="col-lg-6">
            <table width="100%" class="table-form">
                <tr><td width="20%">Username</td><td><b><input type="text" name="username" required value="<?php echo $username; ?>" style="width: 300px" class="form-control"></b></td></tr>
                 <tr><td width="20%">Password</td><td><b><input type="password" name="password" required value="<?php echo $password; ?>" id="dari" style="width: 300px" class="form-control"></b></td></tr>
                 <input type="hidden" name='aa'/>
            </table>
        </div>

        <div class="col-lg-6">	
            <table width="100%" class="table-form">
                <tr><td width="20%">Level</td><td><b>
                            <select name="level" class="form-control" style="width: 200px" required><option value=""> - Level - </option>
                                <?php
                                $l_sifat = array('Super Admin', 'Admin', 'Pimpinan');

                                for ($i = 0; $i < sizeof($l_sifat); $i++) {
                                    if ($l_sifat[$i] == $level) {
                                        echo "<option selected value='" . $l_sifat[$i] . "'>" . $l_sifat[$i] . "</option>";
                                    } else {
                                        echo "<option value='" . $l_sifat[$i] . "'>" . $l_sifat[$i] . "</option>";
                                    }
                                }
                                ?>			
                            </select>
                        </b></td></tr>

            </table>
        </div>
        </div>
        <div class="row" style="margin-top: 20px; margin: auto; ">
            <div class="col-lg-12">
                <table class="table-form">
                    <tr style="width: 100%">
                        <td style="width: 22%"><input type="checkbox" name="kendaraan" value="1" ><b>  Kendaraan</td>
                        <td style="width: 22%"><input type="checkbox" name="perusahaan" value="1"><b>  Perusahaan</td>
                        <td style="width: 22%"><input type="checkbox" name="trayek" value="1"><b>  Trayek</td>
                        <td style="width: 20%" colspan="2"><input type="checkbox" name="ijin_trayek_operasi" value="1"><b>  Ijin Trayek & Operasi</td>
                    </tr>
                    <tr style="width: 100%;">
                        <td style="width: 20%"><input type="checkbox" name="kp_trayek_operasi" value="1"><b>  KP Trayek & Operasi</td>
                        <td style="width: 20%"><input type="checkbox" name="pengemudi" value="1"><b>  Pengemudi</td>
                        <td style="width: 20%"><input type="checkbox" name="verifikasi" value="1"><b>  Verifikasi</td>
                        <td style="width: 20%"><input type="checkbox" name="rubah_sifat" value="1"><b>  Rubah Sifat</td>
                        <td style="width: 20%"><input type="checkbox" name="checklist" value="1"><b>  Checklist Kendaraan</td>
                    </tr>
                    <tr><td colspan="5">
                        <br><button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo base_URL() ?>index.php/admin/manage_admin" class="btn btn-success">Kembali</a>
                    </td></tr>
                </table>
            </div>
    </div>
    </div>
    

</form>