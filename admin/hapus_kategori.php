<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KategoriID = $_POST["KategoriID"];

    $query = "DELETE FROM kategoribuku WHERE KategoriID = '$KategoriID'";

    if (mysqli_query($koneksi, $query)) {
        echo "Data berhasil dihapus dari database.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    mysqli_close($koneksi); // Menggunakan $koneksi, bukan $koneksi2
}
?>
