<?php
// script untuk memanggil fungsi php pg_connect untuk koneksi ke postgresql
$conn = pg_connect("host=localhost port=5432 dbname=simau user='postgres' 
password='1234567'");
//disini nama database saya adalah nama_database
$result = pg_prepare($conn, "my_query", 'SELECT * FROM tbl_user');
// disini saya membuat table dengan nama mahasiswa
$result = pg_execute($conn, "my_query",array());
echo "<table border='1px'>
<tr><td> nama</td>
";
// kolom yang ada di table mahasiswa saya hanya ada 2 yaitu nim dan nama
while ($row = pg_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['user_name']."</td>"; 
echo "</tr>";
}
echo "</table>";
?>