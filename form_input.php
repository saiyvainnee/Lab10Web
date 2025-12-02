<?php
/**
 * Program memanfaatkan Form class untuk membuat form inputan sederhana.
 */

include "form.php";

echo "<html><head><title>Mahasiswa</title></head><body>";

$form = new Form("", "Input Form");
$form->addField("txtnim", "Nim");
$form->addField("txtnama", "Nama");
$form->addField("txtalamat", "Alamat");

echo "<h3>Silahkan isi form berikut ini :</h3>";
$form->displayForm();

// jika disubmit, tampilkan data yang dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Data yang dikirim:</h3>";
    echo "NIM: " . htmlspecialchars($_POST['txtnim'] ?? '') . "<br>";
    echo "Nama: " . htmlspecialchars($_POST['txtnama'] ?? '') . "<br>";
    echo "Alamat: " . nl2br(htmlspecialchars($_POST['txtalamat'] ?? '')) . "<br>";
}

echo "</body></html>";
?>
