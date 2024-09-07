<?php
// Koneksi ke database
$servername = "localhost"; // Sesuaikan dengan detail server Anda
$username = "root"; // Sesuaikan dengan username database Anda
$password = ""; // Sesuaikan dengan password database Anda
$dbname = "lokasi"; // Sesuaikan dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $address = $_POST['address'];

    // Query untuk menyimpan data lokasi
    $sql = "INSERT INTO lokasi (latitude, longitude, address) VALUES ('$latitude', '$longitude', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Lokasi berhasil disimpan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
