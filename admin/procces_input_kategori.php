<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $KategoriID = $_POST["KategoriID"];
    $NamaKategori = $_POST["NamaKategori"];

    $stmt = $conn->prepare("INSERT INTO kategoribuku (KategoriID, NamaKategori) VALUES (?, ?)");
    $stmt->bindParam(1, $KategoriID);
    $stmt->bindParam(2, $NamaKategori);

    try {
        $stmt->execute();
        header("Location: input_kategori.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
